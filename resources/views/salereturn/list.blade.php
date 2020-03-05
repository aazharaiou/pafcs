@extends('layouts.app')

@section('content')
	
<div class="row">
	{{-- <div class="col-md-6">
		<a href="{{ url('/purchase/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Purchase</a>
	
	</div> --}}
</div>
<h1>Sales List </h1>

@if(count($sales) > 0)
<table class = 'table' id='dtable'>
	<thead>
	<tr>
		<th>SHC Order No</th>
		<th>P/O Number</th>
		<th>Customer</th>
		<th>Date</th>
		<th>Action</th>
		{{-- <th>Action</th> --}}
	</tr>
</thead><tbody>
@foreach($sales  as $sale)
<tr>
	<td> {{ $sale->id }} </td>
	<td> {{ $sale->pono }} </td>
	<td> {{ $sale->customer->title }} </td>
	<td> {{ date_format(date_create($sale->created_at),'d-m-Y') }}</td>
	{{-- <td> {{ $sale->user->name }}</td> --}}
	<td> <a  href ="{{ url('/salereturn', $sale->id )}}/return_post" class="btn btn-primary"> Sale Return</a> 
	{{-- <a  href ="{{ url('/order', $order->id )}}/print" class="btn btn-primary" target="_blank"><span class="fa fa-print"></span> Print</a>  --}}
	</td>

	
</tr>
@endforeach
</tbody></table>
@else
	{{ "No record found!" }}
@endif
<script type="text/javascript">
	$(document).ready(function(){
		$('#dtable').DataTable({
			'order':[[0, "DESC"]],
		});
	});
</script>
@endsection()