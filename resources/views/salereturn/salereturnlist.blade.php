@extends('layouts.app')

@section('content')
	
<div class="row">

</div>
<h1>Sales List </h1>

@if(count($sreturns) > 0)
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
@foreach($sreturns  as $rsale)

<tr>
	<td> {{ $rsale->id }} </td>
	<td> {{ $rsale->pono }} </td>
	<td> {{ $rsale->customer->title }} </td>
	<td> {{ date_format(date_create($rsale->created_at),'d-m-Y') }}</td>
	<td> <a  href ="{{ url('/srprint', $rsale->id )}}/print" class="btn btn-primary" target="_blank"> <span class="fa fa-print"></span> Pirnt</a> 
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