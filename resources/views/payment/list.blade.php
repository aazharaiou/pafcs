@extends('layouts.app')

@section('content')
	{{-- @can('create', App\product::class) --}}
		<a href="{{ url('/payment/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus" ></span> Create Payment </a>
	{{-- @endcan --}}
	

<div class="col-6">&nbsp;</div>

<h1>Payments List</h1>

@if(count($payments) > 0)
	<table class="table table-hover table-bordered" id='dtable'>
		<thead>
			<tr>
				<th>Customer</th>
				<th>Order No</th>
				<th>Invoice No</th>
				<th>Amount</th>
				<th>Remarks</th>
				<th>Created By</th>
				<th>Action</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
			<tbody>
				@foreach($payments as $payment)
					<tr>
						<td>{{ $payment->customer->title }}</td>
						<td>{{ $payment->order_no }}</td>
						<td>{{ $payment->invoice_no }}</td>
						<td>{{ $payment->amount }}</td>
						<td>{{ $payment->remarks }}</td>
						<td>{{ $payment->user->name }}</td>
						<td> <a  href ="{{ url('/payment', $payment->id )}}" class="btn btn-primary"><span class="fa fa-eye"></span> View </a> </td>
	<td> <a  href ="{{ url('/payment', $payment->id )}}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit </a> </td>
	<td>
		<form action="{{ url('/payment',$payment->id) }}" method="post">
			@csrf
			@method('DELETE')

			<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> Delete</button>
		</form>
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