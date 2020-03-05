@extends('layouts.app')
@section('content')

<h1>Warehouse Wise Order List</h1>
@if(count($orders) > 0)	
<table class="table table-hover table-bordered">
		<caption style="caption-side: top; text-align: center; font-size:25pt;"> {{ $wtitle->title }} </caption>
		<thead>
			<tr>
				<th>Order No</th>
				<th>Customer</th>
				
			</tr>
		</thead>
		<tbody>
			
			@foreach($orders as $order)

				<tr>
					<td>{{ $order->order_id }}</td>
					<td>{{ $order->order->customer->title }}</td>
				</tr>
				@endforeach()
			
		</tbody>
	</table>
@else
	<div class="text-danger text-center">{{ "No record found" }}</div>
@endif
@endsection