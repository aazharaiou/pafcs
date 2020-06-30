@extends('layouts.app')

@section('content')

		<a href="{{ url('/company/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Company </a>
	<a href="{{ url('/allcompany') }}" class="btn btn-primary btn-lg text-uppercase pull-right" target="_blank"><span class="fa fa-list"></span> All companies List</a>

<div class="col-6">&nbsp;</div>

<h1>Registered Companies</h1>

@if(count($companies) > 0)
<table class = 'table' id='dtable'>
	<thead>
		<tr>
			<th>Id</th>
			<th>Company Tiltle</th>
			<th>Action</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>	
	</thead>
<tbody>

@foreach($companies  as $company)
<tr>
	<td> {{ $company->id }} </td>
	<td> {{ $company->title }} </td>
	<td> <a  href ="{{ url('/company', $company->id )}}" class="btn btn-primary"><span class="fa fa-eye"></span> View</a> </td>
	<td> <a  href ="{{ url('/company', $company->id )}}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a> </td>
	<td>
		<form action="{{ url('/company',$company->id) }}" method="post">
			@csrf
			@method('DELETE')

			<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> Delete</button>
		</form>
	</td>
	<td>
		{{-- <a href="{{ url('/companyproduct/create') }}" class="btn btn-primary">Add company Product</a> --}}
	</td>
	<td>
		{{-- <a href="{{ url('/product_list',$customer->id )}}/list" class="btn btn-primary">Customer Product Profile</a> --}}
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
		if(!confirm('Are you sure to want to delete this record?') == true)
		{
			return false;
		}
	}
	$(document).ready(function() {
    $('#dtable').DataTable();
} );
</script>
@endsection