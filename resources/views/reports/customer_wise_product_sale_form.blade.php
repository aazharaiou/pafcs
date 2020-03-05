@extends('layouts.app')
@section('content')
@php
	 $customers = App\Customer::all()->sortBy('title');
@endphp
<h1>Customer Wise Product Sale</h1>
<form action="{{ url('reports/c_wise_p_sale') }}" method="post" target="_blank">
	@csrf
	
	@include('layouts/partials/datefrom_dateto')
	
	<div class="form-group col-md-6">
		<label for="customer">Customer</label>
			<select name="customer_id" id="customer_id" class="form-group form-control" required="required">
				<option value="">select customer</option>
				@foreach($customers as $customer)
					<option value="{{ $customer->id }}"> {{ $customer->title }}</option>
				@endforeach
			</select>
	<button class="btn btn-primary">Submit</button>
	</div>
	
</form>
@endsection