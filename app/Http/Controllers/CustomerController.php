<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Territory;
use Auth;
class CustomerController extends Controller
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
        $customers = Customer::all();
        return view('customer.list', compact('customers'));
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
        $territories = Territory::all();
        return view('customer.create',compact('territories'));
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
            'territory_id' => 'required',
            'title' => 'required',
            'address' => 'required',
            'cellno' =>'required',
            'officeno' => '',
            'faxno' => '',
            'email' => 'nullable|email',
            'ntn' => ''

        ]);

        Customer::create($data);
        return redirect('/customer');
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
        $customer = Customer::find($id);
        return view('customer.show', compact('customer'));
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
        $territories = Territory::all();
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer', 'territories'));
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
            'territory_id'   => 'required',
            'title'         => 'required',
            'address'       => 'required',
            'cellno'        => 'required',
            'officeno'      => '',
            'faxno'         => '',
            'email'         => 'nullable|email',
            'ntn'           => ''
        ]);

        $customer = Customer::find($id);
        $customer->update($data);
        return redirect('customer/' . $id);

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
        Customer::find($id)->delete();
        return redirect ('customer');
        //
    }

    public function allcustomer()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $allcustomer = Customer::all();

        return view('customer.allcustomer', compact('allcustomer'));
    }
}
