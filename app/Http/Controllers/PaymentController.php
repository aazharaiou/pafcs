<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Customer;
use App\Order;
use Auth;
use DB;
class PaymentController extends Controller
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
        $payments = Payment::all();
        return view('payment.list', compact('payments'));
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
        return view('payment.create', compact('customers'));
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
        $data = $request->validate([
            'customer_id' => 'required',
            'order_no' => '',
            'invoice_no' => '',
            'amount' => 'required',
            'remarks' => '',
            'user_id' => 'required'
        ]);

        Payment::create($data);
        return redirect('/payment');
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
        $payment = Payment::find($id);
        return view('payment.show',compact('payment'));
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
        $payment = Payment::find($id);
        return view('payment.edit', compact('payment','customers'));
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
        $data = $request->validate([
            'customer_id' => 'required',
            'order_no' => '',
            'invoice_no' => '',
            'amount' => 'required',
            'remarks' => '',
            'user_id' => 'required'
            
        ]);

        $payment = Payment::find($id);
        $payment->update($data);
        return redirect('payment/' . $id);
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
        Payment::find($id)->delete();
        return redirect ('payment');
        //
    }

    public function GetOrdersAndTotalAmount($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $orders = Order::select(DB::raw('order_id,sum(quantity * unit_price) as amount'))
                        
                        ->join('order_details','order_details.order_id','=','orders.id')
                        ->where('customer_id',$id)
                        ->groupBy('order_id')
                        ->get();
        return json_encode($orders);
    }
}
