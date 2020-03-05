@extends('layouts.app');
@section('content')

<form action="{{ url('/reports/warehousewisestock') }}" method="post" target="_blank">
	@csrf
	
<div class="form-group">
<label for="product_id">Warehouse</label>
<select name="warehouse_id" id="warehouseid_id" class="form-control">
	<option value="">Please Select</option>
	@foreach($warehouses as $warehouse)
		<option value="{{ $warehouse->id }}">{{ $warehouse->id }} - {{ $warehouse->title }}</option>
	@endforeach
</select>
</div>

<button class="btn btn-primary" name="submit">Submit</button>
</form>
@endsection