@extends('layouts.app')
@section('content')
<h1>Warehouse Wise Orders</h1>
{{-- <form action="{{ url('reports/c_wise_p_sale') }}" method="post" target="_blank"> --}}
	<form method="post" target="_blank">
	@csrf
	@include('layouts/partials/datefrom_dateto')
	<div class="form-group col-md-6">
		<label for="warehouse">Warehouse</label>
		<select name="warehouse_id" id="warehouse_id" required="required" class="form-control">
			<option value="">select</option>
			@foreach($warehouses as $warehouse)
				<option value="{{ $warehouse->id }}">{{ $warehouse->title }}</option>
			@endforeach()
		</select>
		
	</div>
	<button class="btn btn-primary">Submit</button>
		
	
</form>
@endsection