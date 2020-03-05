@extends('layouts.print')
@section('content')



@if(count($stocks) > 0)
<h1> {{ $warehouse->title }} Stock</h1>

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
	
	@foreach ($stocks as $stock)
	
	<tr>
		<td>{{ $stock->code }} </td>
		<td>
			{{ $stock->description }}
		</td>
		<td>
			{{ $stock->purchases >0 ?$stock->purchases:0 }}
		</td>
		<td>
			{{ $stock->returns > 0 ? $stock->returns:0 }}
		</td>
		<td>
			{{ $stock->sales >0 ?$stock->sales:0}}
		</td>		
		<td>
			{{ $stock->purchases + $stock->returns - $stock->sales }}
		</td>
	</tr>
	@endforeach
</tbody>
</table>
@else
<div class="text-danger">
	{{ "No record found!" }}
</div>
@endif
@endsection