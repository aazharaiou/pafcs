@extends('layouts.app')
@section('content')

<h1>Warehouse Wise DC List</h1>
@if(count($sales) > 0)	
<table class="table table-hover table-bordered">
		<caption style="caption-side: top; text-align: center; font-size:25pt;"> {{ $wtitle->title }} </caption>
		<thead>
			<tr>
				<th>DC No</th>
				<th>Customer</th>
				
			</tr>
		</thead>
		<tbody>
			
			@foreach($sales as $sale)
				<tr>
					<td>{{ $sale->id }}</td>
					<td>{{ $sale->customer->title }}</td>
				</tr>
				@endforeach()

		</tbody>
	</table>
@else
	<div class="text-danger text-center">{{ "No record found" }}</div>
@endif
@endsection