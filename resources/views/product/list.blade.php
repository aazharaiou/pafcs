@extends('layouts.app')

@section('content')

	{{-- @can('create', App\product::class) --}}
		<a href="{{ url('/product/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus" ></span> Create product </a>
	{{-- @endcan --}}
	<a href="{{ url('/allproduct') }}" class="btn btn-primary btn-lg text-uppercase pull-right" target = "_blank"><span class="fa fa-list"></span> All Product List</a>

<div class="col-6">&nbsp;</div>

<h1>Registered Products</h1>

@if(count($products) > 0)
<table class = 'table hover' id='dtable'>
	<thead>
	<tr>
		<th>Part No</th>
		<th>Noun</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
</thead>
<tbody>
@foreach($products  as $product)
<tr>
	<td> {{ $product->partno }} </td>
	<td> {{ $product->noun }} </td>
	<td> <a  href ="{{ url('/product', $product->id )}}" class="btn btn-primary"><span class="fa fa-eye"></span> View </a> </td>
	<td> <a  href ="{{ url('/product', $product->id )}}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit </a> </td>
	<td>
		<form action="{{ url('/product',$product->id) }}" method="post">
			@csrf
			@method('DELETE')

			<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> Delete</button>
		</form>
	</td>
	
</tr>
@endforeach
</tbody>
</table>
{{-- <div class="row">
	<div class="col-md-12 text-center pb-25">
		{{ $products->links() }}
	</div>
</div> --}}
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
$(document).ready(function(){
	$("#dtable").DataTable();
});
</script>
@endsection