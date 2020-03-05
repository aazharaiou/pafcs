@extends('layouts.app')

@section('content')

	{{-- @can('create', App\customerproduct::class) --}}
		<a href="{{ url('/customerproduct/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Customerproduct </a>
	{{-- @endcan --}}
	

<div class="col-6">&nbsp;</div>

<h1>Customer Products</h1>

@if(count($customerproducts) > 0)
<table class = 'table' id='dtable'>
	<thead>
		<tr>
			<th>Customer</th>
			<th>Product</th>
			<th>Description</th>
			<th>Sale Price</th>
			<th>Action</th>
			{{-- <th></th> --}}
			{{-- <th></th> --}}
			
		</tr>	
	</thead>
<tbody>

@foreach($customerproducts  as $customerproduct)
<tr>
	<td> {{ $customerproduct->customer->title }} </td>
	<td> {{ $customerproduct->product->code }} </td>
	<td> {{ $customerproduct->description }} </td>
	<td> {{ number_format($customerproduct->saleprice,2) }} </td>
	{{-- <td> <a  href ="{{ url('/customerproduct', $customerproduct->id )}}" class="btn btn-primary"><span class="fa fa-eye"></span> View</a> </td> --}}
	<td> <a  href ="{{ url('/customerproduct', $customerproduct->id )}}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a> </td>
	{{-- <td>
		<form action="{{ url('/customerproduct',$customerproduct->id) }}" method="post">
			@csrf
			@method('DELETE')

			<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> Delete</button>
		</form>
	</td> --}}
	
	
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