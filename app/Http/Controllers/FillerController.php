<?php

namespace App\Http\Controllers;
// use Illuminate/Http/Request;
// use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\CustomerProduct;
use App\PurchaseDetail;
use DB;
use Auth;
class FillerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getPriceByProductID()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
    	$productid = request()->get('pid');
    	$customerid = request()->get('cid');
   		
    	// echo "The product id is =" . $pid . "</br>";
    	 // DB::enableQueryLog();
    	 return CustomerProduct::select('saleprice')->where('product_id', $productid)->where('customer_id', $customerid)->get();
    	 // dd(DB::getQueryLog());
    	 // dd($data);
    	 
    	
    }

    public function getProductsByCustomer()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

    	$customerid = request()->post('cust');
    	return DB::table('products')->join('customer_products','products.id', '=','customer_products.product_id')->select('products.id','code','products.description')->where('customer_products.customer_id',$customerid)->get();
    }

    public function getStockByProductId()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

    	$productid = request()->post('pid');
        $warehouseid = request()->post('wid');
    	// DB::enableQueryLog();
    	$p_d = DB::table('purchase_details')->select('product_id', 'lotno', 'warehouse_id','expiry', DB::raw('sum(quantity) as stock'))->where('product_id',$productid)->where('warehouse_id',$warehouseid)->groupBy('product_id','lotno', 'warehouse_id','expiry')->orderBy('expiry')->get();

        $s_d = DB::table('sale_details')->select('product_id', 'lotno', 'warehouse_id','expiry', DB::raw('sum(quantity) as stock'))->where('product_id',$productid)->where('warehouse_id',$warehouseid)->groupBy('product_id','lotno', 'warehouse_id','expiry')->orderBy('expiry')->get();

        $sr_d = DB::table('sale_return_details')->select('product_id', 'lotno', 'warehouse_id','expiry', DB::raw('sum(quantity) as stock'))->where('product_id',$productid)->where('warehouse_id',$warehouseid)->groupBy('product_id','lotno', 'warehouse_id','expiry')->orderBy('expiry')->get();
        
        $r_d = array();
        
        foreach($p_d as $p)
        {

            foreach($s_d as $s)
            {
                if($s->product_id == $p->product_id && $s->lotno == $p->lotno && $s->warehouse_id == $p->warehouse_id && $s->expiry == $p->expiry)
                    $p->stock -= $s->stock;
            }

            foreach($sr_d as $sr)
            {
                if($sr->product_id == $p->product_id && $sr->lotno == $p->lotno && $sr->warehouse_id == $p->warehouse_id && $sr->expiry == $p->expiry)
                    $p->stock += $sr->stock;
            }
 
            if($p->stock > 0)
                $r_d[]=$p;            
        }

        return $r_d;

    	dd(DB::getQueryLog());
       
    }

    public function getMaxInvoiceNo()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
            
        $taxtype = request()->post('v_taxtypeid');
        $invoice_no  = DB::table('invoices')->select('invoice_no')->where('taxtype',$taxtype)->max('invoice_no');
        $invno = $invoice_no+1;

        return $invno;
    }

   
}
