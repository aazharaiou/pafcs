<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PendingOrder;
use App\Customer;
use App\Product;
use App\PendingOrderDetail;
use Auth;
use DB;
use Illuminate\Support\Facades\Validator;

class PendingOrderController extends Controller
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
        $porders = PendingOrder::all();
        return view('pendingorder.list',compact('porders'));
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
        $customers = Customer::all()->sortBy('title');
        $products = Product::all();
        return view('pendingorder.create',compact('customers','products'));
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
        $pendingorder = Validator::make($request->only(['pono','podate','customer_id']), [
                'pono' => 'required',
                'podate' => 'required',
                'customer_id' => 'required'
                
        ]);

        if ($pendingorder->fails()) 
        {
            DB::rollBack();
            return redirect('pendingorder/create')
                        ->withErrors($pendingorder)
                        ->withInput();
        }
        $pendingorder_arr = $pendingorder->validate();
        $id = PendingOrder::create($pendingorder_arr);
        
        $pendingorderdetail = Validator::make($request->except(['pono','podate','customer_id']), [
                'product_id.*' => 'required',
                'quantity.*' => 'required',
                'remarks.*' => ''
        ]);

        if ($pendingorderdetail->fails()) {
            DB::rollBack();
            return redirect('pendingorder/create')
                        ->withErrors($pendingorderdetail)
                        ->withInput();
        }
        
        $i = 0;
        $pendingorderdetail_arr = $pendingorderdetail->validate();

        while($v = array_column($pendingorderdetail_arr, $i++))
        {
            // dd($v);
            $pd = [
                'pending_order_id'=>$id->id,
                'product_id'=>$v[0],
                'quantity'=>$v[1],

            ];
            PendingOrderDetail::create($pd);
        }
        DB::commit();
        return redirect('pendingorder');
        //
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
        $pendingorder = PendingOrder::find($id);
        return view('pendingorder.show',compact('pendingorder'));
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
        $pendingorder = PendingOrder::find($id);
        return view('pendingorder.edit', compact('customers','pendingorder'));

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
        //
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
        $pendingorder = PendingOrder::find($id);
        $pendingorder->delete($pendingorder);
        return redirect ('pendingorder');
        //
    }
}
