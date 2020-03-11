<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Vendor;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        // $this->middleware('auth')->except(['index']);
        $this->middleware('auth');
    }
    public function index()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        // $products = Product::paginate(25);
            $products = Product::all();
        return view('product.list', compact('products'));
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
        $vendors = Vendor::all();
        return view('product.create');
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
            'partno' => 'required',
            'noun' => 'required',
            'ui' => '',
            'picture' => ''            
        ]);

        Product::create($data);
        return redirect('/product');
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
        $product = Product::find($id);
        return view('product.show',compact('product'));
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
        $product = Product::find($id);
        return view('product.edit', compact('product'));
        //

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
            'partno' => 'required',
            'noun' => 'required',
            'ui' => '',
            
        ]);

        $product = Product::find($id);
        $product->update($data);
        return redirect('product/' . $id);
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
        Product::find($id)->delete();
        return redirect ('product');

        //
    }
    public function allproduct()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $products = Product::orderBy('partno')->get();
        return view('product.allproduct', compact('products'));
    }
}
