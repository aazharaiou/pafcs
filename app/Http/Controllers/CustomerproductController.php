<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerProduct;
use App\Product;
use App\Customer;
use Auth;
class CustomerproductController extends Controller
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
        $customerproducts = CustomerProduct::all();
        return view('customerproduct.list' , compact('customerproducts'));
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
        return view('customerproduct.create', compact('customers','products'));
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
            'product_id' => 'required',
            'description' => 'required',
            'saleprice' => 'required',

            // 'customer_id' => 'unique:customerproducts,customer_id,NULL,id,product_id,'.$customerproduct->id

            // 'customer_id' => 'required|unique:customerproducts,customer_id,'.$this>id.'|unique:customerproducts,product_id,'.$this->id
        ]);

        CustomerProduct::create($data);
        return redirect('customerproduct');
        
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
        $customers = Customer::all();
        $customerproduct = CustomerProduct::find($id);
        return view('customerproduct.edit',compact('products','customers','customerproduct'));
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
            'product_id' => 'required',
            'description' => 'required',
            'saleprice' => 'required',
        ]);

        $customerproduct = CustomerProduct::find($id);
        $customerproduct->update($data);
        return redirect('customerproduct');
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
        Customerproduct::find($id)->delete();
        return redirect ('customerproduct');
        

        //
    }

    public function CustomerProductList($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $customer = Customer::select('title')->where('id',$id)->first();
        $products = CustomerProduct::select('id','customer_id','product_id','description','saleprice')->where('customer_id',$id)->get();
        return view('customerproduct.customer_wise_products_list', compact('products','customer'));
    }

        public function CustomerProductProfile_Form()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $customers = Customer::all()->sortBy('title');
        return view('customerproduct.customer_wise_profile_form', compact('customers'));
        
    }

    public function CustomerProductProfile_Report()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $cid = request()->post('customer_id');
        $customer = Customer::find($cid);
        $products = CustomerProduct::where('customer_id', $cid)->get();
        
        return view('customerproduct.customer_wise_profile_report',compact('products','customer'));

    }
}

