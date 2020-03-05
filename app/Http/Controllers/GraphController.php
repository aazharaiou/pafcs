<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use DB;
use Auth;
use Carbon\Carbon;
use App\SaleDetail;

class GraphController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
	//Bar Graphs
	public function BarGraphMonthWiseForm()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		return view('reports.graphs.bargraphmwise_form');
	}

	public function BarGraphMonthWiseReport()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$m = request('month');
		$y = request('year');
		$topx = request('topx');

		$sales = DB::table('sale_details')
    			->select('quantity','sale_details.created_at','code', DB::raw('SUM(quantity) AS sumquantity'))
    			->join('products','products.id','=','sale_details.product_id')
				->whereMonth('sale_details.created_at', $m)
				->whereYear('sale_details.created_at', $y)
				->groupBy('product_id')
				->orderBy('sumquantity','DESC')
				->limit($topx)
    			->get();

		return view('reports.graphs.bargraphmwise_report',compact('sales'));
	}

	public function BarGraphQuarterWiseForm()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		return view('reports.graphs.bargraphqwise_form');
	}

	public function BarGraphQuarterWiseReport()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$y = request('year');
		$q = request('quarter');
		$topx = request('topx');
		// DB::enableQueryLog();
		$sales = DB::table('sale_details')
    			->select('quantity','sale_details.created_at','code', DB::raw('SUM(quantity) AS sumquantity'))
    			->join('products','products.id','=','sale_details.product_id')
				->whereYear('sale_details.created_at', $y)
				->where(DB::raw('QUARTER(sale_details.created_at)'), $q)
				->groupBy('product_id')
				->orderBy('sumquantity','DESC')
				->limit($topx)
    			->get();
    	// dd(DB::getQueryLog());
		return view('reports.graphs.bargraphquarterwise_report',compact('sales'));
	}
	

	public function BarGraphYearWiseForm()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		return view('reports.graphs.bargraphyearwise_form');
	}

	public function BarGraphYearWiseReport()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$y = request('year');
		$topx = request('topx');

		$sales = DB::table('sale_details')
    			->select('quantity','sale_details.created_at','code', DB::raw('SUM(quantity) AS sumquantity'))
    			->join('products','products.id','=','sale_details.product_id')
				->whereYear('sale_details.created_at', $y)
				->groupBy('product_id')
				->orderBy('sumquantity','DESC')
				->limit($topx)
    			->get();

		return view('reports.graphs.bargraphyearwise_report',compact('sales'));
	}

	//Pie Graphs
	public function PieGraphMonthWiseForm()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		return view('reports.graphs.piegraphmwise_form');
	}

	public function PieGraphMonthWiseReport()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$m = request('month');
		$y = request('year');
		$topx = request('topx');

		$sales = DB::table('sale_details')
    			->select('quantity','sale_details.created_at','code', DB::raw('SUM(quantity) AS sumquantity'))
    			->join('products','products.id','=','sale_details.product_id')
				->whereMonth('sale_details.created_at', $m)
				->whereYear('sale_details.created_at', $y)
				->groupBy('product_id')
				->orderBy('sumquantity','DESC')
				->limit($topx)
    			->get();

		return view('reports.graphs.piegraphmwise_report',compact('sales'));
	}

	public function PieGraphQuarterWiseForm()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		return view('reports.graphs.piegraphqwise_form');
	}

	public function PieGraphQuarterWiseReport()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$y = request('year');
		$q = request('quarter');
		$topx = request('topx');
		// DB::enableQueryLog();
		$sales = DB::table('sale_details')
    			->select('quantity','sale_details.created_at','code', DB::raw('SUM(quantity) AS sumquantity'))
    			->join('products','products.id','=','sale_details.product_id')
				->whereYear('sale_details.created_at', $y)
				->where(DB::raw('QUARTER(sale_details.created_at)'), $q)
				->groupBy('product_id')
				->orderBy('sumquantity','DESC')
				->limit($topx)
    			->get();
    	// dd(DB::getQueryLog());
		return view('reports.graphs.piegraphquarterwise_report',compact('sales'));
	}
	

	public function PieGraphYearWiseForm()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		return view('reports.graphs.piegraphyearwise_form');
	}

	public function PieGraphYearWiseReport()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
		$y = request('year');
		$topx = request('topx');

		$sales = DB::table('sale_details')
    			->select('quantity','sale_details.created_at','code', DB::raw('SUM(quantity) AS sumquantity'))
    			->join('products','products.id','=','sale_details.product_id')
				->whereYear('sale_details.created_at', $y)
				->groupBy('product_id')
				->orderBy('sumquantity','DESC')
				->limit($topx)
    			->get();

		return view('reports.graphs.piegraphyearwise_report',compact('sales'));
	}
	
	public function BarGraphtTerritoryAndVendorWise_Form()
	{
		if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
         return view('reports.graphs.bargraphterritoryvendorwise_form');
	}

	public function BarGraphtTerritoryAndVendorWise_Report()
	{
	    if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
            
		$dfrom = request()->post('datefrom');
		$dto = request()->post('dateto');
		$territory = request()->post('territory');
		$vendor = request()->post('vendor');
		$topx = request()->post('topx');

	if($territory != 'all' && $vendor != 'all')		
	{
		
		$sales = SaleDetail::select('quantity','sale_details.created_at','code','sale_details.product_id',DB::raw('sum(quantity) as quantity'))
    			->join('products','products.id','=','sale_details.product_id')
    			->join('sales','sales.id','=','sale_details.sale_id')
    			->join('customers','customers.id','=','sales.customer_id')
    			->join('vendors', 'vendors.id','=' , 'products.vendor_id')
				->whereDate('sale_details.created_at','>=',$dfrom)
                ->whereDate('sale_details.created_at','<=',$dto)
				->where('territory_id',$territory)
				->where('vendor_id',$vendor)
				->groupBy('product_id')
				->orderBy('quantity','DESC')
				->limit($topx)
    			->get();
    }
    elseif ($territory == 'all' && $vendor != 'all') {
    		$sales = SaleDetail::select('quantity','sale_details.created_at','code','sale_details.product_id',DB::raw('sum(quantity) as quantity'))
    			->join('products','products.id','=','sale_details.product_id')
    			->join('sales','sales.id','=','sale_details.sale_id')
    			->join('customers','customers.id','=','sales.customer_id')
    			->join('vendors', 'vendors.id','=' , 'products.vendor_id')
				->whereDate('sale_details.created_at','>=',$dfrom)
                ->whereDate('sale_details.created_at','<=',$dto)
				->where('vendor_id',$vendor)
				->groupBy('product_id')
				->orderBy('quantity','DESC')
				->limit($topx)
    			->get();
    	}
    elseif ($territory != 'all' && $vendor == 'all') {
    		$sales = SaleDetail::select('quantity','sale_details.created_at','code','sale_details.product_id',DB::raw('sum(quantity) as quantity'))
    			->join('products','products.id','=','sale_details.product_id')
    			->join('sales','sales.id','=','sale_details.sale_id')
    			->join('customers','customers.id','=','sales.customer_id')
    			->join('vendors', 'vendors.id','=' , 'products.vendor_id')
				->whereDate('sale_details.created_at','>=',$dfrom)
                ->whereDate('sale_details.created_at','<=',$dto)
				->where('territory_id',$territory)
				->groupBy('product_id')
				->orderBy('quantity','DESC')
				->limit($topx)
    			->get();
    	}
    	elseif ($territory != 'all' or  $vendor != 'all') {
    		$sales = SaleDetail::select('quantity','sale_details.created_at','code','sale_details.product_id',DB::raw('sum(quantity) as quantity'))
                ->join('products','products.id','=','sale_details.product_id')
    			->join('sales','sales.id','=','sale_details.sale_id')
    			->join('customers','customers.id','=','sales.customer_id')
    			->join('vendors', 'vendors.id','=' , 'products.vendor_id')
				->whereDate('sale_details.created_at','>=',$dfrom)
                ->whereDate('sale_details.created_at','<=',$dto)
                ->orWhere('territory_id',$territory)
                ->orWhere('vendor_id',$vendor)
				->groupBy('product_id')
				->orderBy('quantity','DESC')
				->limit($topx)
    			->get();
    	}
    	else
    	{
    	    $sales = SaleDetail::select('quantity','sale_details.created_at','code','sale_details.product_id',DB::raw('sum(quantity) as quantity'))
                ->join('products','products.id','=','sale_details.product_id')
    			->join('sales','sales.id','=','sale_details.sale_id')
    			->join('customers','customers.id','=','sales.customer_id')
    			->join('vendors', 'vendors.id','=' , 'products.vendor_id')
				->whereDate('sale_details.created_at','>=',$dfrom)
                ->whereDate('sale_details.created_at','<=',$dto)
				->groupBy('product_id')
				->orderBy('quantity','DESC')
				->limit($topx)
    			->get();
    	}
		return view('reports.graphs.bargraphterritoryvendorwise_report', compact('sales'));
	}
}