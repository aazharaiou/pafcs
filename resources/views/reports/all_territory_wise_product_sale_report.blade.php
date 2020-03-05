@extends('layouts.app')
@section('content')

@if(!empty($territorytitle))
	<h1>Product Sale of {{ $territorytitle->title }} Territory </h1>
@else
	<h1>Product Sale of All Territory </h1>
@endif

@if(count($sales) > 0)	
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Product Id</th>
				<th>Product Code</th>
				<th>Lot No</th>
				<th>Expiry</th>
				<th>Quantity</th>
				<th>Purchase Price</th>
				<th>Sale Price</th>
				<th>Value (PP)</th>
				<th>Value (SP)</th>
				<th>Difference</th>
				
			</tr>
		</thead>
		<tbody>
			@php
				$ptotal = 0;
				$sptotal = 0;
			@endphp
			@foreach($sales as $d)
					<tr>
						<td>{{ $d->product_id }}</td>
						<td>{{ $d->code }}</td>
						<td>{{ $d->lotno }} </td>
						<td width="120px">{{ date_format(date_create($d->expiry),'d-m-Y') }}</td>
						<td align="right">{{ $d->quantity }}</td>
						<td align="right">{{ number_format($d->purchase_price,2) }} </td>
						<td align="right">{{ number_format($d->sale_price,2) }}</td>
						<td align="right">{{ number_format($d->quantity * $d->purchase_price,2) }}</td>
						<td align="right">{{ number_format($d->quantity * $d->sale_price,2) }}</td>
						<td align="right">{{ number_format($d->quantity * $d->sale_price - $d->quantity * $d->purchase_price,2) }}</td>
						@php
							$ptotal += $d->quantity * $d->purchase_price;
							$sptotal += $d->quantity * $d->sale_price;
						@endphp
					</tr>
			@endforeach
		</tbody>
		<tr>
			<td colspan="7" align="right"><b>Total</b></td>
			<td align="right"><b>{{ number_format($ptotal,2) }}</b></td>
			<td align="right"><b>{{ number_format($sptotal,2) }}</b></td>
			<td align="right"><b>{{ number_format($sptotal -  $ptotal,2) }}</b></td>
		</tr>
	</table>
	@else
		<div class="text-danger text-center"><h1>{{ "No record found" }}</h1></div>
	@endif
@endsection