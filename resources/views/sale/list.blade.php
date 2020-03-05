@extends('layouts.app')

@section('content')
	
<div class="row">
	{{-- <div class="col-md-6">
		<a href="{{ url('/purchase/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Purchase</a>
	
	</div> --}}
</div>
<h1>Orders List for Posting</h1>

@if(count($orders) > 0)
<table class = 'table' id='dtable'>
	<thead>
	<tr>
		<th>Order Number</th>
		<th>P/O Number</th>
		<th>Customer</th>
		<th>Date</th>
		<th>Enter By</th>
		<th>Action</th>
		<th></th>
	</tr>
</thead><tbody>
@foreach($orders  as $order)
<tr>
	<td>{{ $order->id }}</td>
	<td> {{ $order->pono }} </td>
	<td> {{ $order->customer->title }} </td>
	<td> {{ date_format(date_create($order->created_at),'d-m-Y') }}</td>
	<td> {{ $order->user->name }}</td>
	<td> <a  href ="{{ url('/sale', $order->id )}}/post" class="btn btn-primary"> Post Order</a> 
	<td>{{ $order->order_post }}</td>
	{{-- <a  href ="{{ url('/order', $order->id )}}/print" class="btn btn-primary" target="_blank"><span class="fa fa-print"></span> Print</a>  --}}
	</td>

	
</tr>
@endforeach
</tbody></table>
@else
	{{ "No record found!" }}
@endif
<script type="text/javascript">
	$(document).ready(function(){
		$('#dtable').DataTable({
			'order': [[0, 'DESC']],
		});
	});
</script>
@endsection()