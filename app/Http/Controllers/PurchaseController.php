<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\PurchaseDetail;
use App\Warehouse;
use App\Vendor;
use App\Product;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PurchaseController extends Controller
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

        // DB::enableQueryLog();
        $purchases = Purchase::all();
        // dd(DB::getQueryLog());
        return view('purchase.list',compact('purchases'));
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
        $warehouses = Warehouse::all();
        $vendors = Vendor::all();
        $products = Product::all();
        return view('purchase.create', compact('warehouses','vendors','products'));
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
        $purchase = Validator::make($request->only(['invoiceno','purchasedate','vendor_id','user_id','warehouse_id']), [
                'invoiceno' => 'required',
                'purchasedate' => 'required',
                'vendor_id' => 'required',
                'user_id'=>'required',
                'warehouse_id' => 'required'
        ]);

        if ($purchase->fails()) 
        {
            DB::rollBack();
            return redirect('purchase/create')
                        ->withErrors($purchase)
                        ->withInput();
        }
        $purchase_arr = $purchase->validate();
        $warehouse_id = array_pop($purchase_arr);
 
        $id = Purchase::create($purchase_arr);

        $purchasedetail = Validator::make($request->except(['invoiceno','purchasedate','vendor_id','user_id','warehouse_id']), [
                'product_id.*' => 'required',
                'lotno.*' => 'required',
                'expiry.*' => 'required',
                'quantity.*' => 'required',
                'purchaseprice.*' => 'required',
                'carton.*' => '',
                'remarks.*' => ''
        ]);

        if ($purchasedetail->fails()) {
            DB::rollBack();
            return redirect('purchase/create')
                        ->withErrors($purchasedetail)
                        ->withInput();
        }
        
        $i = 0;
        $purchasedetail_arr = $purchasedetail->validate();

        while($v = array_column($purchasedetail_arr, $i++))
        {
            $pd = [
                'purchase_id'=>$id->id,
                'product_id'=>$v[0],
                'warehouse_id'=>$warehouse_id,
                'lotno'=>$v[1],
                'expiry'=>$v[2],
                'quantity'=>$v[3],
                'purchase_price'=>$v[4]
            ];
            PurchaseDetail::create($pd);
        }
        DB::commit();
        return redirect('purchase');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $purchase = Purchase::find($id);
        return view('purchase.show',compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $vendors = Vendor::all();
        $purchase = Purchase::find($id);
        return view('purchase.edit', compact('purchase','vendors'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $data = $request->validate([
            'invoiceno' => 'required',
            'vendor_id' => 'required',
            'purchasedate' => 'required',
        ]);
        $purchase = Purchase::find($id);
        // DB::enableQueryLog(); // Enable query log

        $purchase->update($data);
        // dd(DB::getQueryLog());
        return redirect('purchase');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        Purchase::find($id)->delete();
        return redirect('purchase');
        //
    }

    public function print($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $purchase = Purchase::find($id);
        return view('purchase.print',compact('purchase'));
    }
}
