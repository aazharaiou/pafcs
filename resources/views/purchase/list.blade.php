@extends('layouts.app')

@section('content')
	
<div class="row">
	<div class="col-md-6">
		<a href="{{ url('/purchase/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Purchase</a>
	
	</div>
</div>
<h1>Purchase List</h1>

@if(count($purchases) > 0)
<table class = 'table' id='dtable'>
	<thead>
	<tr>
		<th>SRR No</th>
		<th>Inoive Number</th>
		<th>Business Line</th>
		<th>Date</th>
		{{-- <th>Enter By</th> --}}
		<th>Action</th>
	</tr>
</thead><tbody>
@foreach($purchases  as $purchase)
<tr>
	<td> {{ $purchase->id }} </td>
	<td> {{ $purchase->invoiceno }} </td>
	<td> {{ $purchase->vendor->title }} </td>
	<td> {{ date_format(date_create($purchase->purchasedate),'d-m-Y') }}</td>
	{{-- <td> {{ $purchase->user->name }}</td> --}}
	<td> <a  href ="{{ url('/purchase', $purchase->id )}}" class="btn btn-primary"><span class="fa fa-eye"></span> View Detail</a> 
	<a  href ="{{ url('/purchase', $purchase->id )}}/print" class="btn btn-primary" target="_blank"><span class="fa fa-print"></span> Print</a> 
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
			'order': [[0,'desc']],
		});
	});
</script>
@endsection()