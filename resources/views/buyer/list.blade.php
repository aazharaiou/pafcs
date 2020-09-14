@extends('layouts.app')

@section('content')

	{{-- @can('create', App\vendor::class) --}}
		<a href="{{ url('/buyer/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Buyer </a>
	{{-- @endcan --}}
	

<div class="col-6">&nbsp;</div>

<h1>Registered Buyers</h1>

@if(count($buyers) > 0)
<table class = 'table' id='dtable'>
	<thead>
	<tr>
		<th>Id</th>
		<th>Vendor Tiltle</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
	</thead><tbody>
@foreach($buyers  as $buyer)
<tr>
	<td> {{ $buyer->id }} </td>
	<td> {{ $buyer->title }} </td>
	<td> <a  href ="{{ url('/buyer', $buyer->id )}}" class="btn btn-primary"> <span class="fa fa-eye"></span> View </a> </td>
	<td> <a  href ="{{ url('/buyer', $buyer->id )}}/edit" class="btn btn-primary"> <span class="fa fa-pencil"></span> Edit </a> </td>
	<td>
		<form action="{{ url('/buyer',$buyer->id) }}" method="post">
			@csrf
			@method('DELETE')

			<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> 	Delete</button>
		</form>
	</td>
	
</tr>
@endforeach
</table>
</tbody>@else
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
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#dtable').DataTable();
	});
</script>
@endsection