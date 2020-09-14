<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buyer;
use App\Territory;
use DB;
use Auth;

class BuyerController extends Controller
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
        $buyers = Buyer::all();
        return view('buyer.list',compact('buyers'));
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
        $buyers = Buyer::select('id','title')->get();
        return view('buyer.create', compact('buyers'));
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

        // $this->authorize('create', Buyer::class);
        $data = $request->validate([
                'title' => 'required',
                'contact_person' => 'required',
                'address' => '',
                'email' => 'nullable|email',
                'phone' => '',
                'fax' => '',
                'parent' => ''
            ]);

        Buyer::create($data);
        return redirect('/buyer');
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
            
        $buyer = Buyer::find($id);
        return view('buyer.show',compact('buyer'));

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
        $parents = Buyer::select('id','title')->get();
        $buyer = Buyer::find($id);
        return view('buyer.edit',compact('buyer','parents'));

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
        //
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $data = $request->validate([
                'title' => 'required',
                'contact_person' => 'required',
                'address' => '',
                'email' => '',
                'phone' => '',
                'fax' => ''
            ]);
        // dd($data);
        $vendor = Vendor::find($id);
        $vendor->update($data);
        
        return redirect('vendor/'.$id);
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

        Buyer::find($id)->delete();
        return redirect ('buyer');
        //
    }
    public function allvendors()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $vendors = Vendor::all();
        return view('vendor.allvendors', compact('vendors'));
    }
}
