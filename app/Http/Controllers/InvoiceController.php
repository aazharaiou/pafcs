<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Customer;
use App\Invoice;
use App\InvoiceDetail;
use DB;
use Auth;
class InvoiceController extends Controller
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
        $invoices = Invoice::all();
        return view('invoice.list', compact('customers','invoices'));

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
        $customers = Customer::all();
        return view('invoice.create',compact('customers'));
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
        // dd($request);
        DB::beginTransaction();
        $invoice = Validator::make($request->only(['customer_id','taxtype','invoice_no','pono','taxrate','remarks','user_id']),[
            'invoice_no' => 'required',
            'customer_id' => 'required',
            'taxtype' => 'required',
            'pono' => 'required',
            'taxrate' => '',
            'remarks' => '',
            'user_id' => 'required'
        ]);

        if ($invoice->fails()) 
        {
            DB::rollBack();
            return redirect('invoice/create')
                        ->withErrors($invoice)
                        ->withInput();
        }

        $invoicearray = $invoice->validate();
        $invno = Invoice::create($invoicearray);

        $invoicedetail = Validator::make($request->except(['customer_id','taxtype','invoice_no','pono','taxrate','remarks','user_id']), [
                'product_id.*' => 'required',
                'quantity.*' => 'required',
                'unit_price.*' => 'required',
                'remarks2.*' => ''
        ]);

        if ($invoicedetail->fails()) 
        {
            DB::rollBack();
            return redirect('invoice/create')
                        ->withErrors($invoicedetail)
                        ->withInput();
        }
        $i = 0;
        while($v = array_column($invoicedetail->validate(), $i++))
        {
            // dd($v);
            $invd = [
                'invoice_id'=>$invno->id,
                'product_id'=>$v[0],
                'quantity'=>$v[1],
                'unit_price'=>$v[2],
                'remarks' =>$v[3]
            ];
            
            InvoiceDetail::create($invd);
        }
         DB::commit();
        return redirect('invoice');
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
        $invoice = Invoice::find($id);
        return view('invoice.show', compact('invoice'));
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
        $invoice = Invoice::find($id);
        return view('invoice.edit', compact('customers','invoice'));
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
                'pono' => 'required',
                'customer_id' => 'required',
                'remarks' => ''
            ]);
        $invoice = Invoice::find($id);
            if($invoice->update($data)){
                $request->session()->flash('success','Update succesfully'); 
                return redirect('invoice');
            }

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
        Invoice::find($id)->delete();
        return redirect ('invoice');
        //
    }

    public function print($id)
    {
        if(!in_array(Auth::user()->role,['Admin']))
            return view('home')->with('message','You are not authorized for the page you tried to visit');
        $invoice = Invoice::find($id);
        return view('invoice.print',compact('invoice'));
    }
}
