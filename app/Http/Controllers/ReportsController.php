<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Purchase;
use App\PurchaseDetail;
use App\Sale;
use App\Customer;
use App\SaleDetail;
use App\SaleReturn;
use App\SaleReturnDetail;
use App\Warehouse;
use DB;
use Carbon\Carbon;
use Auth;
use App\Territory;
use App\Order;
use App\Payment;



use Illuminate\Support\Facades\Input;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function index()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
    	return view('reports.dateform');
    	
    }

    public function betweendates()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
    	$inputs = Input::all();
        
    	$datefrom = $inputs['datefrom'];
    	$dateto = $inputs['dateto'];
        DB::enableQueryLog();
    	 $datas = Purchase::whereBetween('purchasedate',[$datefrom, $dateto])->get();
        // $datas = Purchase::where('purchasedate', '>=', $datefrom)->where('purchasedate','<=',$dateto)->get();
        // dd(DB::getQueryLog());
    	
        
    	return view('reports.datewise', compact('datas'));
    }

    public function fullStock()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
    	$products = Product::all();
    	return view('reports.full_stock',compact('products'));
    }

    public function ProductWiseLedger_Form()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $products = Product::all()->sortBy('code');
        return view('reports.product_wise_ledger',compact('products'));
    }

    public function ProductWiseLedger_Report()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        // $inputs = Input::all();
        // $product = $inputs['product_id'];

        $productid = request()->post('product_id');
        $product = Product::find($productid);
        $purchases = PurchaseDetail::where('product_id',$productid)->get();
        $sales = SaleDetail::where('product_id',$productid)->get();
        $returns = SaleReturnDetail::where('product_id',$productid)->get();

        return view('reports.product_wise_ledgerlist', compact('product','purchases','sales','returns'));         
    }

    public function WarehouseWiseStock_Form()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $warehouses = Warehouse::all();
        return view('reports.warehouses',compact('warehouses'));
    }

    public function WarehouseWiseStock_Report()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $warehouseid = request()->post('warehouse_id');
        $warehouse = Warehouse::find($warehouseid);
        $sql = "SELECT p.id, code, description, (select SUM(quantity) from purchase_details where purchase_details.product_id = p.id and warehouse_id = $warehouseid) AS `purchases`, (select SUM(quantity)from sale_details where sale_details.product_id = p.id and warehouse_id = $warehouseid) as `sales`, (select sum(quantity) from sale_return_details where sale_return_details.product_id = p.id and warehouse_id = $warehouseid) as `returns` FROM `products` p";
        $stocks = DB::select($sql);

        return view('reports.warehousewise_stock', compact('stocks','warehouse'));
    }

    public function Reorder()
    {
        if(!in_array(Auth::user()->role,['Admin','Sale']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $products = Product::all();
        return view('reports.reorder',compact('products'));
    }

    public function NearExpiry()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        // $products = DB::table('products')
                            // ->join('purchase_details','products.id','=','purchase_details.product_id')
                            // ->select(DB::raw('description,sum(quantity) as quantity,products.id'))
                            // ->groupBy('products.id')
                            // // ->sum('quantity');
                            // ->get(); //Product::all();
        return view('reports.nearexpiry');
    }

    public function CustomerWiseProductSale_Form()  
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        return view('reports.customer_wise_product_sale_form');
        
    }

    public function CustomerWiseProductSale_Report()  
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
            
        $dfrom = request()->post('datefrom');
        $dto = request()->post('dateto');
        $cid = request()->post('customer_id');
        $ctitle = Customer::select('title')->where('id',$cid)->first();
        $sales = Sale::select('id','order_id','created_at')
                ->whereDate('created_at','>=',$dfrom)
                ->whereDate('created_at','<=',$dto)
                ->where('customer_id',$cid)
                ->orderBy('order_id')
                ->get();
        return view('reports.customer_wise_product_sale_report', compact('sales','ctitle'));
        
    }

    public function AllTerritoryWiseProductSale_Form()  
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $territories = Territory::all()->sortBy('title');
        return view('reports.all_territory_wise_product_sale_form', compact('territories'));
        
    }

    public function AllTerritoryWiseProductSale_Report()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $dfrom = request()->post('datefrom');
        $dto = request()->post('dateto');
        $territory = request()->post('territory');
        // DB::enableQueryLog();
        $territorytitle = Territory::select('title')->where('id',$territory)->first();
        // dd(DB::getQueryLog());
        if($territory != 'all')
        {
$sql = "SELECT
            sd.id,
            code,
            lotno,
            expiry,
            quantity,
            product_id,
            (
            SELECT DISTINCT
                avg(purchase_price)
            FROM
                purchase_details
            WHERE
                purchase_details.product_id = sd.product_id AND purchase_details.lotno = sd.lotno
            ) AS `purchase_price`,
                unit_price AS 'sale_price'
            FROM
            `sale_details` sd
            INNER JOIN products ON products.id = sd.product_id
            INNER JOIN sales on sales.id = sd.sale_id
            INNER JOIN customers on customers.id = sales.customer_id
            INNER JOIN territories on territories.id = customers.territory_id

            WHERE
                date(sd.created_at) >= '$dfrom' AND date(sd.created_at) <= '$dto' AND territories.id = '$territory' AND sd.deleted_at IS NULL";
        }
        else
        {
           $sql = "SELECT
            sd.id,
            code,
            lotno,
            expiry,
            quantity,
            product_id,
            (
            SELECT DISTINCT
                avg(purchase_price)
            FROM
                purchase_details
            WHERE
                purchase_details.product_id = sd.product_id AND purchase_details.lotno = sd.lotno
            ) AS `purchase_price`,
                unit_price AS 'sale_price'
            FROM
            `sale_details` sd
            INNER JOIN products ON products.id = sd.product_id
            INNER JOIN sales on sales.id = sd.sale_id
            INNER JOIN customers on customers.id = sales.customer_id
            INNER JOIN territories on territories.id = customers.territory_id

            WHERE
                date(sd.created_at) >= '$dfrom' AND date(sd.created_at) <= '$dto'  AND sd.deleted_at IS NULL"; 
        }
        //return ($sql);
        $sales = DB::select($sql);
        return view('reports.all_territory_wise_product_sale_report', compact('sales','territorytitle'));
    }

    public function DataComparisonProductWise_Form()
    {   
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $years = Sale::select(DB::raw('YEAR(created_at) as year'))->distinct()->get();
        $quarters = Sale::select(DB::raw('QUARTER(created_at) as quarter'))->distinct()->orderBy('quarter')->get();
        $territories = Territory::all()->sortBy('title');
        return view('reports.data_comparison_product_wise_form',compact('years','quarters','territories'));

    }

    public function DataComparisonProductWise_Report()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $year = request()->post('year');
        $quarter = request()->post('quarter');
        $territory = request()->post('territory');
        if($territory != 'all')
        {
            $sales = SaleDetail::select(DB::raw('product_id,products.code, territory_id, sum(quantity) as quantity'))
                            ->join('products','products.id', 'sale_details.product_id')
                            ->join('sales','sales.id','sale_details.sale_id')
                            ->join('customers','customers.id','sales.customer_id')
                            ->join('territories','territories.id','customers.territory_id')
                            ->where(DB::raw('YEAR(sale_details.created_at)'),$year)
                            ->where(DB::raw('QUARTER(sale_details.created_at)'),$quarter)
                            ->where('territories.id',$territory)
                            ->groupBy('product_id')
                            ->get();
        }
        
        else
        {
            $sales = SaleDetail::select(DB::raw('product_id,products.code,  sum(quantity) as quantity'))
                            ->join('products','products.id', 'sale_details.product_id')
                            // ->join('sales','sales.id','sale_details.sale_id')
                            // ->join('customers','customers.id','sales.customer_id')
                            // ->join('territories','territories.id','customers.territory_id')
                            ->where(DB::raw('YEAR(sale_details.created_at)'),$year)
                            ->where(DB::raw('QUARTER(sale_details.created_at)'),$quarter)
                            // ->where('territories.id',$territory)
                            ->groupBy('product_id')
                            ->get();
        }
        // return $sales;
        return view('reports.data_comparison_product_wise_report', compact('sales','year','quarter'));
    }
    
        public function CutomerWiseLedger_Form()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $customers = Customer::all()->sortBy('title');
        return view('reports.customer_wise_ledger_form',compact('customers'));
    }

    public function CutomerWiseLedger_Report() 
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $datefrom = request()->post('datefrom');
        $dateto = request()->post('dateto');
        $customer = request()->post('customer_id');
        $customertitle = Customer::select('title')->where('id',$customer)->first();

        
        $orders = Order::select('orders.id','orders.customer_id','orders.created_at','poimage', DB::raw('SUM(quantity * unit_price) AS ordertotal'))
                        ->join('order_details','order_details.order_id','=','orders.id')
                        ->whereDate('orders.created_at','>=' ,$datefrom)
                        ->whereDate('orders.created_at','<=' ,$dateto)
                        ->where('customer_id',$customer)
                        ->groupBy('orders.id')
                        ->orderBy('id')
                        ->get();

        $previousorderamount = Order::select('orders.id','quantity','unit_price',  DB::raw('SUM(quantity * unit_price) AS previousamount'))
                        ->join('order_details','order_details.order_id','=','orders.id')
                        ->whereDate('orders.created_at','<' ,$datefrom)
                        ->where('customer_id',$customer)
                        ->first();
        
        $returns = SaleReturn::select('order_id', 'sale_returns.customer_id', 'sale_return_details.quantity','sale_return_details.unit_price',DB::raw('SUM(sale_return_details.quantity * sale_return_details.unit_price) AS returntotal'))  
                          
                        ->join('sale_return_details','sale_return_details.salereturn_id', '=', 'sale_returns.id')
                        ->where('sale_returns.customer_id',$customer)
                        ->groupBy('order_id')
                        ->get();
        $payments = Payment::select('order_no',DB::raw('SUM(amount) as amount'))->where('customer_id',$customer)->groupBy('order_no')->get(); 
        return view('reports.customer_wise_ledger_report', compact('orders','customertitle','previousorderamount','returns','payments'));
    }
    
    public function DataComparisonCustomerWise_Form()
    {   
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $years = Sale::select(DB::raw('YEAR(created_at) as year'))->distinct()->get();
        $quarters = Sale::select(DB::raw('QUARTER(created_at) as quarter'))->distinct()->orderBy('quarter')->get();
        $customers = Customer::all()->sortBy('title');
        return view('reports.data_comparison_customer_wise_form',compact('years','quarters','customers'));

    }

    public function DataComparisonCustomerWise_Report()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $year = request()->post('year');
        $quarter = request()->post('quarter');
        $customer = request()->post('customer');
        if($customer != 'all')
        {
            $sales = SaleDetail::select(DB::raw('sales.customer_id,customers.title, sum(quantity * unit_price) as quantity'))
                            ->join('products','products.id', 'sale_details.product_id')
                            ->join('sales','sales.id','sale_details.sale_id')
                            ->join('customers','customers.id','sales.customer_id')
                            ->where(DB::raw('YEAR(sale_details.created_at)'),$year)
                            ->where(DB::raw('QUARTER(sale_details.created_at)'),$quarter)
                            ->where('sales.customer_id',$customer)
                            ->groupBy('customer_id')
                            ->get();
        }
        
        else
        {
            $sales = SaleDetail::select(DB::raw('sales.customer_id,customers.title, sum(quantity * unit_price) as quantity'))
                            ->join('products','products.id', 'sale_details.product_id')
                            ->join('sales','sales.id','sale_details.sale_id')
                            ->join('customers','customers.id','sales.customer_id')
                            ->where(DB::raw('YEAR(sale_details.created_at)'),$year)
                            ->where(DB::raw('QUARTER(sale_details.created_at)'),$quarter)
                            ->groupBy('customer_id')
                            ->get();
        }
        return view('reports.data_comparison_customer_wise_report', compact('sales','year','quarter'));
    }

}
