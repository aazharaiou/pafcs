@extends('layouts.app')

@section('content')

	{{-- @can('create', App\customer::class) --}}
		<a href="{{ url('/customer/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Customer </a>
	{{-- @endcan --}}
	<a href="{{ url('/allcustomer') }}" class="btn btn-primary btn-lg text-uppercase pull-right" target="_blank"><span class="fa fa-list"></span> All Customer List</a>

<div class="col-6">&nbsp;</div>

<h1>Registered Customers</h1>

@if(count($customers) > 0)
<table class = 'table' id='dtable'>
	<thead>
		<tr>
			<th>Id</th>
			<th>customer Tiltle</th>
			<th>Action</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>	
	</thead>
<tbody>

@foreach($customers  as $customer)
<tr>
	<td> {{ $customer->id }} </td>
	<td> {{ $customer->title }} </td>
	<td> <a  href ="{{ url('/customer', $customer->id )}}" class="btn btn-primary"><span class="fa fa-eye"></span> View</a> </td>
	<td> <a  href ="{{ url('/customer', $customer->id )}}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a> </td>
	<td>
		<form action="{{ url('/customer',$customer->id) }}" method="post">
			@csrf
			@method('DELETE')

			<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> Delete</button>
		</form>
	</td>
	<td>
		<a href="{{ url('/customerproduct/create') }}" class="btn btn-primary">Add Customer Product</a>
	</td>
	<td>
		<a href="{{ url('/product_list',$customer->id )}}/list" class="btn btn-primary">Customer Product Profile</a>
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

<script type="text/javascript">
	function tocheckdelete(){
		if(!confirm('Are you sure to want to delete this record>') == true)
		{
			return false;
		}
	}
	$(document).ready(function() {
    $('#dtable').DataTable();
} );
</script>
@endsection