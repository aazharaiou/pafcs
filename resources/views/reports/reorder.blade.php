@extends('layouts.print')
@section('content')

<h1> Reorder Report </h1>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Product Code</th>
			<th>Product Description</th>
			<th style="text-align: right;">Reorder Level</th>
			<th style="text-align: right;">Stock</th>
	</tr>
	</thead>
<tbody>
	@foreach ($products as $product)
	<tr>
		<td>{{ $product->code }} </td>
		<td>
			 {{ $product->description }}
		</td>
		{{-- <td>
			{{ $product->purchasedetails->sum('quantity') }}
		</td>
		<td>
			{{ $product->salereturndetails->sum('quantity') }}
		</td>
		<td>
			{{ $product->saledetails->sum('quantity') }}
		</td> --}}
		
		{{-- <td>
			{{ $product->purchasedetails->sum('quantity') + $product->salereturndetails->sum('quantity') - $product->saledetails->sum('quantity')}}
		</td> --}}
		<td style="text-align: right;">{{ $product->reorderlevel }}</td>


		@if($product->purchasedetails->sum('quantity') + $product->salereturndetails->sum('quantity') - $product->saledetails->sum('quantity') <= $product->reorderlevel) 

			<td style="background-color: red; color: white; text-align: right;">
			{{ $product->purchasedetails->sum('quantity') + $product->salereturndetails->sum('quantity') - $product->saledetails->sum('quantity') }}
			</td>

			@else

			<td style="background-color: green; color: white; text-align: right;">
				{{ $product->purchasedetails->sum('quantity') + $product->salereturndetails->sum('quantity') - $product->saledetails->sum('quantity') }}
			</td>
			@endif
		
	</tr>
	@endforeach
</tbody>
</table>
@endsection