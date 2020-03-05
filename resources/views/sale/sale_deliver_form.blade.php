@extends('layouts.app')

@section('content')
	
<div class="row">

	{{-- <div class="col-md-6">
		<a href="{{ url('/purchase/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Purchase</a>
	
	</div> --}}
</div>
<h1>Sales Delivered</h1>
	<form action="{{ url('/sale/'.$saleid->id) }}/update_delivered_status" method="post">
	@csrf
	<input type="hidden" name="id" value="{{ $saleid->id }}">
		<div class="form-group">
			<label for="shipper">Shipper</label>
			<select name="shipper_id" id="shipper_id" class="form-control" required="required">
				<option value="">please select</option>
				@foreach($shippers as $shipper)
					<option value="{{ $shipper->id }}">{{ $shipper->title }}</option>
				@endforeach

			</select>
		</div>

		<div class="form-group">
			<label for="delivered_date">Delivered Date</label>
			<input type="date" name="delivered_date" class="form-control">
		</div>

		<div class="form-group">
			<label for="tracking_id">Tracking Id</label>
			<input type="text" name="tracking_id" class="form-control">
		</div>
		<input type="hidden" name="sale_status" value="delivered">
		<input type="submit" name="submit" value="Delivered Sale" class="btn btn-primary btn-lg">
	</form>
{{-- @if(count($sales) > 0)
<table class = 'table' id='dtable'>
	<thead>
	<tr>
		<th>P/O Number</th>
		<th>Customer</th>
		<th>Date</th>
		<th>Action</th>
	</tr>
</thead><tbody>
@foreach($sales  as $sale)
<tr>
	<td> {{ $sale->pono }} </td>
	<td> {{ $sale->customer->title }} </td>
	<td> {{ date_format(date_create($sale->podate),'d-m-Y') }}</td> --}}
	{{-- <td> {{ $sale->user->name }}</td> --}}
	{{-- <td>
	<a  href ="{{ url('/sale', $sale->id )}}/saledeliver" class="btn btn-primary" target="_blank"><span class="fa fa-print"></span> Click to Deliver</a> 
	</td>

	
</tr>
@endforeach
</tbody></table>
@else
	{{ "No record found!" }}
@endif --}}

@endsection()