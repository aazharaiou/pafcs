<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\PurchaseDetail;
use App\Product;
use DB;
use Auth;

class PurchaseDetailController extends Controller
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

        $warehouses = Warehouse::all();
        $products = Product::all();
        $purchasedt= PurchaseDetail::find($id);
        return view('purchasedetail.edit', compact('purchasedt','warehouses','products'));
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
            'warehouse_id' => 'required',
            'product_id' => 'required',
            'lotno' => 'required',
            'expiry' => 'required',
            'quantity' => 'required',
            'purchase_price' => 'required',
            'remarks' => 'nullable',

        ]);
        $purchasedt = PurchaseDetail::find($id);
        // DB::enableQueryLog(); // Enable query log

        $purchasedt->update($data);
        // dd(DB::getQueryLog());
        return redirect('purchase');
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
        PurchaseDetail::find($id)->delete();
        return redirect('purchase');
        //
    }
}
