@extends('layouts.app')
@section('content')

<h1>Date Wise Order List</h1>
@if(count($orders) > 0)	
	
<table class="table table-hover table-bordered">
		
		<thead>
			<tr>
				<th>View Order</th>
				<th>Order No</th>
				<th>Customer</th>
				<th>Territory</th>
				<th>Ship Date</th>
				<th>Shipper Name</th>
				<th>Tracking No</th>
				<th>Dispatch Status</th>
				<th>Order Total Amount</th>
				
			</tr>
		</thead>
		<tbody>
				@php
					$total = 0;
				@endphp
			@foreach($orders as $order)
				@foreach($order->sales as $s)

				<tr>
					
					<td> <a  href ="{{ url('/order', $order->id )}}/print" class="btn btn-primary" target="_blank"><span class="fa fa-eye fa-1x"></span></a></td>
					<td>{{ $order->id }}</td>
					<td>{{ $order->customer->title }}</td>
					<td>{{ $order->customer->territory->title }}</td>
					<td>
					@if(!empty($s->delivered_date))
						@php
							$ddate = date_format(date_create($s->delivered_date),'d-m-Y');
						@endphp
						
					{{ $ddate }}
					@else
				
						{{ "" }}
					
					@endif
					</td>
					
					<td>
						@if(!empty($s->shipper))
						
						{{ $s->shipper->title }}
						@endif
					</td>
					<td>{{ $s->tracking_id }}</td>
					<td>{{ $s->sale_status }}</td>
					<td align="right">{{ number_format($order->tamount) }}</td>
				@php
						$total += $order->tamount;
					@endphp	
				</tr>
					
				@endforeach()
					
			@endforeach()
		
		</tbody>
		<tr>
			<td colspan="8" align="right"><b>Total</b></td>
			<td align="right"><b>{{ number_format($total) }}</b></td>
		</tr>	
	</table>
@else

	<div class="text-center text-danger"> {{ "No record found" }} </div>

@endif
@endsection