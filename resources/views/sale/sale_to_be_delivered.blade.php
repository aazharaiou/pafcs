@extends('layouts.app')

@section('content')
	
<div class="row">
	{{-- <div class="col-md-6">
		<a href="{{ url('/purchase/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Purchase</a>
	
	</div> --}}
</div>
<h1>Sales To Be Delivered</h1>

@if(count($sales) > 0)
<table class = 'table' id='dtable'>
	<thead>
	<tr>
		<th>Sale Id</th>
		<th>P/O Number</th>
		<th>Customer</th>
		<th>Date</th>
		<th>Action</th>
		<th></th>
	</tr>
</thead><tbody>
@foreach($sales  as $sale)
<tr>
	<td>{{ $sale->id }}</td>
	<td> {{ $sale->pono }} </td>
	<td> {{ $sale->customer->title }} </td>
	<td> {{ date_format(date_create($sale->podate),'d-m-Y') }}</td>
	
	<td>
	<a  href ="{{ url('/sale', $sale->id )}}/saledeliver" class="btn btn-primary" target="_blank"><span class="fa fa-truck"></span> Click to Deliver</a> 
	</td>
	<td>
	<a  href ="{{ url('/sale', $sale->id )}}/print" class="btn btn-primary" target="_blank"><span class="fa fa-print"></span> Print DC</a> 
	</td>

	
</tr>
@endforeach
</tbody></table>
@else
	{{ "No record found!" }}
@endif
<script type="text/javascript">
	$(document).ready(function(){
		$('#dtable').DataTable();
	});
</script>
@endsection()