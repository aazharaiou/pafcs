@extends('layouts.app')

@section('content')

<h1>Customer Wise Products List</h1>
@if(!empty($products))
<table class = 'table table-bordered table-hover'>
	<caption style="caption-side:top">{{ $customer->title }}</caption>
	<thead>
	<tr>
		<th>Prouct Code</th>
		<th>Description</th>
		<th>Sale Price</th>
	</tr>
	</thead>
	<tbody>
@foreach($products as $product)
	
	<tr>
		<td>{{ $product->product->code }}</td>
		<td>{{ $product->description }}</td>
		<td align="right">{{ $product->saleprice }}</td>
	</tr>
@endforeach()
</tbody>
</table>
@else

	<div class ='text-center text-danger'>{{ "No record found" }}</div>

@endif
@endsection