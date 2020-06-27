<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\company;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
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

        $companies = Company::all();
        return view('company.list', compact('companies'));
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
        return view('company.create');
        //
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
        
        $company = Validator::make($request->only(['title','logo','header','footer']), [
            'title' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'header' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'footer' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);
        if ($company->fails())
        {
            DB::rollBack();
            return redirect('company/create')
                        ->withErrors($company)
                        ->withInput();
        }

        $logoname = Storage::disk('orders_uploads')->put($request->originalName, $request->logo);
        $logowithpath = pathinfo($logoname);

        $headername = Storage::disk('orders_uploads')->put($request->originalName, $request->header);
        $headerwithpath = pathinfo($headername);

        $footername = Storage::disk('orders_uploads')->put($request->originalName, $request->footer);
        $footerwithpath = pathinfo($footername);


        $companyarray = $company->validate();

        $companyarray['logo']=$logowithpath['basename'];
        $companyarray['header']=$headerwithpath['basename'];
        $companyarray['footer']=$footerwithpath['basename'];
        //var_dump($companyarray);

        Company::create($companyarray);
        DB::commit();

        return redirect('/company');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $company = Company::find($id);
        return view('company.show',compact('company'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $company = Company::find($id);
        return view('company.edit', compact('company'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $logo_name = $request->logo_image;
        $header_name = $request->header_image;
        $footer_name = $request->footer_image;
        
        $logo_is_uploaded = $request->hasFile('logo');
        $header_is_uploaded = $request->hasFile('header');
        $footer_is_uploaded = $request->hasFile('footer');

        if($logo_is_uploaded && $header_is_uploaded && $footer_is_uploaded)
        {
            $data = $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg|max:2000',
                'header' => 'required|image|mimes:jpeg,png,jpg|max:2000',
                'footer' => 'required|image|mimes:jpeg,png,jpg|max:2000'
            ]);
        
        $logoname = Storage::disk('orders_uploads')->put($request->originalName, $request->logo_image);
        $logowithpath = pathinfo($logoname);

        $headername = Storage::disk('orders_uploads')->put($request->originalName, $request->header);
        $headerwithpath = pathinfo($headername);

        $footername = Storage::disk('orders_uploads')->put($request->originalName, $request->footer);
        $footerwithpath = pathinfo($footername);


        $data = $company->validate();

        $data['logo']=$logowithpath['basename'];
        $data['header']=$headerwithpath['basename'];
        $data['footer']=$footerwithpath['basename'];
        }
        else
        {
              $data = $request->validate([
                'title' => 'required',
            ]);

        }


        $company = Company::find($id);
            if($company->update($data)){
                $request->session()->flash('success','Update succesfully');
                return redirect('company');
            }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');

        $company = Company::find($id);
        $company->delete($company);
        return redirect ('company');
        //
    }

    public function allcompanies()
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $allcompanies = Company::all();

        return view('company.allcompany', compact('allcompanies'));
    }
}
