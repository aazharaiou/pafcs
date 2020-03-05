<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PendingOrderDetail;
use App\Product;
use DB;
use Auth;

class PendingOrderDetailController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $products = Product::all();
        $pendingorderdt= PendingOrderDetail::find($id);
        return view('pendingorderdetail.edit', compact('pendingorderdt','products'));
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
            'product_id' => 'required',
            'quantity' => 'required',
            'remarks' => 'nullable',

        ]);
        $pendingorderdt = PendingOrderDetail::find($id);
        // DB::enableQueryLog(); // Enable query log

        $pendingorderdt->update($data);
        // dd(DB::getQueryLog());
        return redirect('pendingorder');
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
        PendingOrderDetail::find($id)->delete();
        return redirect('pendingorder');
        //
    }
}
