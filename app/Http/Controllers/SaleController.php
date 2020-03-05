<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Sale;
use App\SaleDetail;
use App\Shipper;
use Auth;
use DB;
use App\Territory;
use App\Warehouse;
use App\Product;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$orders = Order::all()->whereIn('order_post', ['new','partial posted']);
        return view('sale.list', compact('orders'));
	}

	public function postOrder($id)
	{
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$customers = Customer::all();
        $order = Order::find($id);
        return view('sale.post', compact('customers','order'));
	}

   public function store(Request $request)
    {
       if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $sale = $request->only(['podate','pono','customer_id','order_id','user_id']);
        // dd($data);
        
         $saleid = Sale::create($sale);
         $order = Order::find($request->order_id);
         // $order->order_post='posted';
         // $order->save();
         $saleDetail = $request->except(['podate','pono','customer_id','order_id','user_id']);

         $i = 0;
         $partial = false;
         // dd($saleDetail);
        while($v = array_column($saleDetail, $i++))
        { 
            // dd($v);
            $pd = [
                'sale_id'=>$saleid->id,
                'product_id'=>$v[0],
                'lotno'=>$v[1],
                'expiry'=>$v[2],
                'unit_price'=>floatval(str_replace(",", "", $v[3])),
                'warehouse_id'=>$v[4],
                'quantity'=>$v[7]
            ];
            // dd($pd);
            if($v[7] < $v[6])
                {
                    $partial = true;
                } 
            if($v[7]>0){
                SaleDetail::create($pd);
            }
               
        }

        if($partial)
        {
            $order->order_post='partial posted';
            $order->save(); 
        }
        else
        {
            $order->order_post='posted';
            $order->save(); 
        }


        return redirect('/sale');
    }

    public function saleList()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $sales = Sale::all();
        return view('sale.salelist', compact('sales'));        
    }

    public function print($id)
    {
        if(!in_array(Auth::user()->role,['Admin','WH_Manager']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $sales = Sale::where('id',$id)->first();
        return view('sale.print', compact('sales'));        
    }

       public function tobedeliver()
    {
        if(Auth::user()->role == 'Admin')
            {
                $sales = Sale::where('sale_status','Not Delivered')->get();
                return view('sale.sale_to_be_delivered',compact('sales'));
            }
        elseif (Auth::user()->role == 'WH_Manager') {
            $myWarehouse = Auth::user()->warehouse_id;
            $sales = Sale::where('sale_status','Not Delivered')->get();
            
            foreach ($sales as $k => $s) {
                
                foreach ($s->saledetails as $sd) {
                  if ($sd->warehouse_id != $myWarehouse)
                  {
                    unset($sales[$k]);        
                    break;
                  }  
                }
            
                
                }
            return view('sale.sale_to_be_delivered',compact('sales'));
            }
        else
            {
            return view('home')->with('message','You are not authorized for the page you tried to visit');
            }

        
    }

    public function saledeliver_form($id)
    {
        if(!in_array(Auth::user()->role,['Admin','WH_Manager']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $saleid = Sale::find($id);
        $shippers = Shipper::all();

        return view('sale.sale_deliver_form',compact('shippers','saleid'));
        // dd($id);
    }

    public function update_delivered_status(Request $request, $id)
    {
        if(!in_array(Auth::user()->role,['Admin','WH_Manager']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        // dd($request);
        $data = $request->validate([
                'shipper_id' => 'required',
                'delivered_date' => 'required',
                'tracking_id' => 'required',
                
            ]);
        // DB::enableQueryLog(); // Enable query log
        $data['sale_status'] = "Delivered";
        $sale = Sale::find($id);
        // DB::enableQueryLog(); // Enable query log
        $sale->update($data);
        // Log::debug(DB::getQueryLog());

        return redirect('sale/tobedeliver');

    }
    
    public function DateWiseSale_Form()
    {
        if(!in_array(Auth::user()->role,['Admin','Marketing']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
            $territories = Territory::all()->sortBy('title');
        return view('sale.date_wise_sales_form', compact('territories'));
        
    }
    
    public function DateWiseSale_Report()
    {
        if(!in_array(Auth::user()->role,['Admin','Marketing']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        
        $dfrom = request()->post('datefrom');
        $dto = request()->post('dateto');
        $territory = request()->post('territory');
        if($territory == 'all')
        {
        $sales = Sale::select('id','order_id','customer_id','created_at')
                ->whereDate('created_at','>=',$dfrom)
                ->whereDate('created_at','<=',$dto)
                ->orderBy('created_at')
                ->get();
        }
        else
        {
            $sales = Sale::select('sales.id','sales.order_id','sales.customer_id','sales.created_at')
                ->join('customers','customers.id','sales.customer_id')
                ->join('territories','territories.id','customers.territory_id')
                ->whereDate('sales.created_at','>=',$dfrom)
                ->whereDate('sales.created_at','<=',$dto)
                ->where('territories.id', $territory)
                ->orderBy('sales.created_at')
                ->get();
        }
        return view('sale.date_wise_sales_report', compact('sales'));
    }
    
    public function DCTrackingWarehouseWise_Form()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $warehouses = Warehouse::all()->sortBy('title');
        return view('sale.dc_warehouse_wise_form', compact('warehouses'));
        
    }
    
    public function DCTrackingWarehouseWise_Report()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
            
                $dfrom = request()->post('datefrom');
                $dto = request()->post('dateto');
                $wid = request()->post('warehouse_id');
                $wtitle = Warehouse::select('title')->where('id',$wid)->first();
        
                $sales = Sale::select('sales.id','sales.customer_id','sales.created_at')
                ->join('customers','customers.id','=','sales.customer_id')
                ->join('sale_details','sale_details.sale_id','=','sales.id')
                ->whereDate('sales.created_at','>=',$dfrom)
                ->whereDate('sales.created_at','<=',$dto)
                ->where('warehouse_id',$wid)
                ->groupBy('sales.id')
                ->orderBy('id')
                ->get();
               return view('sale.dc_warehouse_wise_report',compact('sales','wtitle'));
    }
    
    public function SalePriceProductWise_Form()
    {
       
       if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
            $territories = Territory::all()->sortBy('title');
            $products = Product::all()->sortBy('code');
            
        return view('sale.sale_price_product_wise_form', compact('territories','products'));
    }
    
    public function SalePriceProductWise_Report()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        
        $dfrom = request()->post('datefrom');
        $dto = request()->post('dateto');
        $product = request()->post('product');
        $territory = request()->post('territory');
        $productcode = Product::select('code')->where('id',$product)->first();
        if($territory == 'all')
        {
                $saleprices = SaleDetail::select('product_id','unit_price','quantity','sale_details.created_at')
                
                ->join('sales','sales.id','sale_details.id')
                ->join('customers','customers.id','sales.customer_id')
                ->join('territories','territories.id','customers.territory_id')
                ->whereDate('sale_details.created_at','>=',$dfrom)
                ->whereDate('sale_details.created_at','<=',$dto)
                ->where('product_id',$product)
                ->orderBy('created_at')
                ->get();
        }
        else
        {
            $saleprices = SaleDetail::select('product_id','unit_price','quantity','sale_details.created_at')
                ->join('sales','sales.id','sale_details.id')
                ->join('customers','customers.id','sales.customer_id')
                ->join('territories','territories.id','customers.territory_id')
                ->whereDate('sale_details.created_at','>=',$dfrom)
                ->whereDate('sale_details.created_at','<=',$dto)
                ->where('product_id',$product)
                ->where('territories.id', $territory)
                ->orderBy('sale_details.created_at')
                ->get();
        }
        
        return view('sale.sale_price_product_wise_report', compact('saleprices','productcode'));
    }
    
    
    // public function correct_orders()
    // {
    //     $sales = Sale::all();
    //     foreach ($sales as $sale) {
    //         $customer_id = $sale->customer_id;
    //         $sds = $sale->saledetails;
    //         foreach($sds as $sd)
    //         {
    //             $customer_price = DB::table('customer_products')->where('customer_id',$customer_id)->where('product_id',$sd->product_id)->value('saleprice');
    //             echo $sd->product_id . " > " . $sd->unit_price . " >> " . $customer_price . "<br>";
    //             $sd->unit_price = $customer_price;
    //             $sd->save();

    //         }
    //     }
    // }

}
