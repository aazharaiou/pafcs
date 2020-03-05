@extends('layouts.print')

@section('content')

<h1>All Product List</h1>


<table class = 'table table-hover table-bordered'>
	<thead>
		<th>Product Id</th>
		<th>Part No</th>
		<th>Noun</th>
		<th>Vendor</th>
		<th>UI</th>
	</thead>
	<tbody>
		@foreach($products as $product)
		<tr>
			<td>{{ $product->id }}</td>
			<td>{{ $product->partno }}</td>
			<td>{{ $product->noun }}</td>
			<td>{{ $product->vendor->title }}</td>
			<td>{{ $product->ui }}</td>
			
		</tr>
	</tbody>
	@endforeach		
</table>

@endsection