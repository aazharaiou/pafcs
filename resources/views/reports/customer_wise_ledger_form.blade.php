@extends('layouts.app')
@section('content')

<h1>Customer Wise Ledger</h1>
<form action="{{ url('reports/cwl') }}" method="post" target="_blank">
	@csrf
	
	@include('layouts/partials/datefrom_dateto')
	
	<div class="form-group col-md-6">
		<label for="customers">Customers</label>
		<select name="customer_id" id="customers" class="form-control">
			@foreach($customers as $customers)
				<option value="{{ $customers->id }}">{{ $customers->title }}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group col-md-6">
		
	<button class="btn btn-primary">Submit</button>
	</div>
	
</form>
@endsection