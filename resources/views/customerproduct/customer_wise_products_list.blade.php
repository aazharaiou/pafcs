@extends('layouts.app')

@section('content')

<h1>Customer Wise Products List</h1>

@if(count($products) > 0)
<table class = 'table table-bordered table-hover'>
	<caption style="caption-side:top">{{ $customer->title }}</caption>
	<thead>
	<tr>
		<th>Prouct Code</th>
		<th>Description</th>
		<th>Sale Price</th>
		<th>Edit</th>
	</tr>
	</thead>
	<tbody>
@foreach($products as $product)
	
	<tr>
		<td>{{ $product->product->code }}</td>
		<td>{{ $product->description }}</td>
		<td>{{ $product->saleprice }}</td>
		<td> <a  href ="{{ url('/customerproduct', $product->id )}}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a> </td>
	</tr>
@endforeach()
</tbody>
</table>
@else

	<div class ='text-center text-danger'>{{ "No record found" }}</div>

@endif

@endsection