@extends('layouts.app')

@section('content')

<h1>Payment Update</h1>
<div class="text-danger">* Mandatory</div>
@foreach($errors->all() as $error)
	<li>{{ $error }}</li>
@endforeach
<form action="{{ url('/payment',$payment->id) }}" method="post" autocomplete="off">
	@csrf
	@method('PATCH')

	<div class="form-group">
		<label for="customerid">Customer</label><span class="text-danger">*</span>
		<select name="customer_id" id="customer_id" class="form-control" autofocus="autofocus">
		<option value="">select customer</option>
		@foreach ($customers as $customer)
			<option value="{{ $customer->id }}" {{ $customer->id == $payment->customer_id ? 'selected' : '' }}>{{ $customer->title }}</option>
		@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('customer_id') }}</span>
	
	<div class="form-group">
	<label for="order_no">Order No</label>
	<input type="text" name="order_no" class="form-control text-uppercase" value="{{ $payment->order_no }}">
	</div>
	<span class="text-danger">{{ $errors->first('order_no') }}</span>

	<div class="form-group">
	<label for="invoice_no">Invoice No</label>
	<input type="text" name="invoice_no" class="form-control text-uppercase" value="{{ $payment->invoice_no }}">
	</div>
	<span class="text-danger">{{ $errors->first('invoice_no') }}</span>

	<div class="form-group">
	<label for="amount">Amount</label>
	<input type="text" name="amount" class="form-control text-uppercase" value="{{ $payment->amount }}">
	</div>
	
	<div class="form-group">
	<label for="Remarks">Remarks</label>
	<input type="text" name="remarks" class="form-control text-uppercase" value="{{ $payment->remarks }}">
	</div>
	<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


	<button class="btn btn-primary">Update</button>
</form>

@endsection