@extends('layouts.app')

@section('content')
	{{-- @can('create', App\product::class) --}}
		<a href="{{ url('/invoice/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus" ></span> Create Invoice </a>
	{{-- @endcan --}}
	

<div class="col-6">&nbsp;</div>

<h1>Invoices List</h1>

@if(count($invoices) > 0)
	<table class="table table-hover table-bordered" id='dtable'>
		<thead>
			<tr>
				<th>Invoice No</th>
				<th>Customer</th>
				<th>PO No</th>
				<th>Action</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
			<tbody>
				@foreach($invoices as $invoice)
					@if($invoice->taxtype == '1')
						@php
						$invoicetype = "Tax";
	    				$pretext = "STI-";
	    				@endphp
					@endif
					
					@if($invoice->taxtype == '2')
						@php
						$invoicetype = "Exempted";
	    				$pretext = "INV-";
	    				@endphp
					@endif

					@if($invoice->taxtype == '3')
						@php
						$invoicetype = "N/A";
	    				$pretext = "SystemInvoice-";
	    				@endphp
					@endif

					<tr>
						<td>{{ $pretext . $invoice->id }}</td>
						<td>{{ $invoice->customer->title }}</td>
						<td>{{ $invoice->pono }}</td>
						<td> <a  href ="{{ url('/invoice', $invoice->id )}}" class="btn btn-primary"><span class="fa fa-eye"></span> View </a> </td>
	<td> <a  href ="{{ url('/invoice', $invoice->id )}}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit </a> </td>
	<td>
		<form action="{{ url('/invoice',$invoice->id) }}" method="post">
			@csrf
			@method('DELETE')

			<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> Delete</button>
		</form>
	</td>
	<td>
		<a  href ="{{ url('/invoice', $invoice->id )}}/print" class="btn btn-primary" target="_blank"><span class="fa fa-print"></span> Print </a>
	</td>
					</tr>
				@endforeach
			</tbody>
	</table>
@else
	<div class="text-danger">{{ "No Record Found" }}</div>
@endif
<script type="text/javascript">
	function tocheckdelete(){
		if(!confirm('Are you sure to want to delete this record>') == true)
		{
			return false;
		}
	}
$(document).ready(function(){
	$("#dtable").DataTable();
});
</script>
@endsection