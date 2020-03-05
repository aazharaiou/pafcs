@extends('layouts.app')
@section('content')


	<h1>Date Wise Product Sale </h1>


@if(count($sales) > 0)	
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
			    <th>Date</th>
			    <th>Customer</th>
			    <th>Product Code</th>
			    <th>Quantity</th>
			    <th>Sale Price</th>
			    <th>Value (SP)</th>
			</tr>
		</thead>
		<tbody>
			@php
				$stotal = 0;
			@endphp
			@foreach($sales as $sale)
			    @foreach($sale->saledetails as $sd)
					<tr>
					    <td width="120px">{{ date_format(date_create($sale->created_at),'d-m-Y') }}</td>
					    <td>{{ $sale->customer->title }}</td>
						<td>{{ $sd->product->code }}</td>
						<td align="right">{{ $sd->quantity }} </td>
						<td align="right">{{ number_format($sd->unit_price,2) }}</td>
						<td align="right">{{ number_format($sd->quantity * $sd->unit_price,2) }}</td>
						@php
							$stotal += $sd->quantity * $sd->unit_price;
						@endphp
					</tr>
			    @endforeach
			@endforeach
		</tbody>
		<tr>
			<td colspan="5" align="right"><b>Total</b></td>
			<td align="right"><b>{{ number_format($stotal,2) }}</b></td>
		</tr>
	</table>
	@else
		<div class="text-danger text-center"><h1>{{ "No record found" }}</h1></div>
	@endif
@endsection