<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Customer;
use App\SaleReturn;
use App\SaleReturnDetail;
use DB;
use Auth;

class SaleReturnController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

		$sales = Sale::all();
		return view('salereturn.list', compact('sales'));
	}

	public function saleReturnPost($id)
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

		$customers = Customer::all();
        $sale = Sale::find($id);

        $salereturn = SaleReturn::where(['sale_id'=>$id])->get();
        return view('salereturn.edit', compact('customers','sale','salereturn'));
	}

	public function store(Request $request)
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$salereturnDetail = $request->except(['podate','pono','customer_id','sale_id','order_id']);
		
		$i = 0;
		$entryOK = false;
		while($v = array_column($salereturnDetail, $i++))
        {
        	if($v[5] > 0)
        	{
        		$entryOK = true;	
        		break;
        	}
        }
        if($entryOK)
		{
			$salereturn = $request->only(['podate','pono','customer_id','sale_id','order_id']);
		        $salereturnid = SaleReturn::create($salereturn);
	      		
		$i = 0;
        while($v = array_column($salereturnDetail, $i++))
        {
        	 
        	if($v[5] > 0)
        	 {
        	
	            $srd = [
	                'salereturn_id'=>$salereturnid->id,
	                'product_id'=>$v[0],
	                'lotno'=>$v[1],
	                'expiry'=>$v[2],
	                'unit_price'=>$v[3],
	                'warehouse_id'=>$v[4],
					'quantity'=>$v[5]
	            ];
	            // dd($v);
            SaleReturnDetail::create($srd);
        	}
        }

        }
         // $order = Sale::find($request->salereturn_id);
         // $order->order_post='posted';
         // $order->save();
        return redirect('/salereturn'); 

	}

	public function SaleReturnList()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

		$sreturns = SaleReturn::all();
		return view('salereturn.salereturnlist', compact('sreturns'));
	}

	public function SaleReturnPrint($id)
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
            
		$srturns_details = SaleReturn::find($id);
		
		return view('salereturn.salereturn_print', compact('srturns_details'));
	}
    //
}