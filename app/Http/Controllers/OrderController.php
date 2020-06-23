<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Customer;
use App\Product;
use App\Warehouse;
use App\Sale;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $orders = Order::all();
        return view('order.list', compact('orders'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $products = Product::all();
        $customers = Customer::all()->sortBy('title');
        $warehouses = Warehouse::all();
        return view('order.create',compact('customers','products','warehouses'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        DB::beginTransaction();

        $order = Validator::make($request->only(['podate','pono','poimage','customer_id','user_id']), [
            'podate' => 'required',
            'pono' => 'required',
            'poimage' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'customer_id' => 'required',
            'user_id'=>'required'
        ]);


        if ($order->fails())
        {
            DB::rollBack();
            return redirect('order/create')
                        ->withErrors($order)
                        ->withInput();
        }
        //$fname = $request->poimage->store('public/upload');
       // dd($request->poimage);
        $fname = Storage::disk('orders_uploads')->put($request->originalName, $request->poimage);
        $filewithpath = pathinfo($fname);

        //$request['poimage']=$filewithpath['basename'];
        $orderarray = $order->validate();
        $orderarray['poimage']=$filewithpath['basename'];

        // $id = Order::create($order->validate());

        $id = Order::create($orderarray);
        $orderdetail = Validator::make($request->except(['podate','pono','poimage','customer_id','user_id']), [
                'warehouse_id.*' => 'required',
                'product_id.*' => 'required',
                'lotno.*' => 'required',
                'expiry.*' => 'required',
                'quantity.*' => 'required',
                'unit_price.*' => 'required',
                'remarks.*' => ''
        ]);



        if ($orderdetail->fails())
        {
            DB::rollBack();
            return redirect('order/create')
                        ->withErrors($orderdetail)
                        ->withInput();
        }

        $i = 0;
        while($v = array_column($orderdetail->validate(), $i++))
        {
            $pd = [
                'order_id'=>$id->id,
                'product_id'=>$v[1],
                'warehouse_id'=>$v[0],
                'lotno'=>$v[2],
                'expiry'=>$v[3],
                'quantity'=>$v[4],
                'unit_price'=>$v[5]
            ];

            OrderDetail::create($pd);
        }
        DB::commit();

        return redirect('order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $order = Order::find($id);
        return view('order.show',compact('order'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $customers = Customer::all();
        $order = Order::find($id);
        return view('order.edit', compact('customers','order'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $image_name = $request->hidden_image;
        $image_is_uploaded = $request->hasFile('poimage');

        if($image_is_uploaded)
        {
            $data = $request->validate([
                'podate' => 'required',
                'pono' => 'required',
                'poimage' => 'image|mimes:jpeg,png,jpg|max:500',
                'customer_id' => 'required'
            ]);

            $fname = $request->poimage->store('public/upload');
            $filewithpath = pathinfo($fname);
            $data['poimage']=$filewithpath['basename'];

        }
        else
        {
              $data = $request->validate([
                'podate' => 'required',
                'pono' => 'required',
                'customer_id' => 'required'
            ]);

        }
        // dd($data);
            $order = Order::find($id);
            if($order->update($data)){
                $request->session()->flash('success','Update succesfully');
                return redirect('order');
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $order = Order::find($id);
        $order->delete($order);
        return redirect ('order');
    }


     public function print($id)
    {
        if(!in_array(Auth::user()->role,['Admin','Sale']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $order = Order::find($id);
        return view('order.print',compact('order'));
    }
    
    public function partialorders()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $orders = Order::all()->whereIn('order_post', ['partial posted']);
        return view('order.partial', compact('orders'));
    }
    
    
    public function OrderTrackingWarehouseWise_Form()   
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $warehouses = Warehouse::all();
        return view('order.order_tracking_warehouse_wise_form',compact('warehouses'));
    }

    public function OrderTrackingWarehouseWise_Report()   
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $dfrom = request()->post('datefrom');

        $dto = request()->post('dateto');
        $wid = request()->post('warehouse_id');
        $wtitle = Warehouse::select('title')->where('id',$wid)->first();
        $orders = OrderDetail::select('id','order_id','warehouse_id','created_at')
                ->whereDate('created_at','>=',$dfrom)
                ->whereDate('created_at','<=',$dto)
                ->where('warehouse_id',$wid)
                ->groupBy('order_id')
                ->orderBy('id')
                ->get();
        
        return view('order.warehouse_wise_orders_report',compact('wtitle','orders'));
    }

    public function OrderTrackingDateWise_Form()   
    {
        if(!in_array(Auth::user()->role,['Admin','Sale']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        return view('order.order_tracking_date_wise_form');
    }

    public function OrderTrackingDatwWise_Report()   
    {
        if(Auth::user()->role == 'Admin')
            {
                $dfrom = request()->post('datefrom');
                $dto = request()->post('dateto');
                $orders = Order::select('orders.id','customer_id','orders.created_at','poimage', DB::raw('SUM(quantity * unit_price) AS tamount'))
                ->join('order_details','order_details.order_id','=','orders.id')
                ->whereDate('orders.created_at','>=',$dfrom)
                ->whereDate('orders.created_at','<=',$dto)
                ->groupBy('orders.id')
                ->orderBy('id')
                ->get();
               return view('order.order_tracking_date_wise_report',compact('orders'));
            }
            elseif (Auth::user()->role == 'Sale')
            {
                DB::enableQueryLog();
                $myterritory = Auth::user()->territory_id;
                $dfrom = request()->post('datefrom');
                $dto = request()->post('dateto');
                $orders = Order::select('orders.id','orders.customer_id','orders.created_at','poimage', DB::raw('SUM(quantity * unit_price) AS tamount'))

                ->join('order_details','order_details.order_id','=','orders.id')
                ->join('sales','sales.order_id','order_details.order_id')
                ->join('customers','customers.id','sales.customer_id')
                ->join('territories','territories.id','customers.territory_id')
                ->whereDate('orders.created_at','>=',$dfrom)
                ->whereDate('orders.created_at','<=',$dto)
                ->where('territory_id',$myterritory)
                ->groupBy('orders.id')
                ->orderBy('id')
                ->get();
                // dd(DB::getQueryLog());
               return view('order.order_tracking_date_wise_report',compact('orders'));


            }
            else
            {
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        }
        
    }
}
