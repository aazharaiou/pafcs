@extends('layouts.print')
@section('content')

<h1> Stock Report </h1>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Product Code</th>
			<th>Product Description</th>
			<th>Total Purchases</th>
			<th>Total Returns</th>
			<th>Total Sales</th>
			<th>Stock</th>
	</tr>
	</thead>
<tbody>
	@foreach ($products as $product)
	<tr>
		<td>{{ $product->code }} </td>
		<td>
			 {{ $product->description }}
		</td>
		<td>
			{{ $product->purchasedetails->sum('quantity') }}
		</td>
		<td>
			{{ $product->salereturndetails->sum('quantity') }}
		</td>
		<td>
			{{ $product->saledetails->sum('quantity') }}
		</td>
		
		<td>
			{{ $product->purchasedetails->sum('quantity') + $product->salereturndetails->sum('quantity') - $product->saledetails->sum('quantity')}}
		</td>
	</tr>
	@endforeach
</tbody>
</table>
@endsection