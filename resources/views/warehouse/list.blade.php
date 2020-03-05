@extends('layouts.app')


@section('content')	
<a href="{{ url('/warehouse/create') }}" class="btn btn-primary btn-lg text-uppercase">Create Warehouse </a>
<div class="col-6">&nbsp;</div>

<h1>Warehouse List</h1>
@if(count($warehouses) >0)
<table class="table table-striped">
	<tr>
		<th>Id</th>
		<th>Warehouse</th>
		<th>Manager</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
	
	@foreach( $warehouses as $warehouse)
		<tr>
			<td>{{ $warehouse->id }}</td>
			<td>{{ $warehouse->title }}</td>
			<td>{{ $warehouse->manager }}</td>
			<td><a href="{{ url('/warehouse',$warehouse->id) }}" class="btn btn-primary">View</a></td>
			<td><a href="{{ url('/warehouse',$warehouse->id) }}/edit" class="btn btn-primary">Edit</a></td>
			<td>
				<form action="{{ url('/warehouse', $warehouse->id) }}" method="post">
					@csrf
					@method('DELETE')

					<button class="btn btn-danger" onclick="return tocheck()">Delete</button>
				</form>
			</td>
		</tr>
	@endforeach
	
</table>
@else
	

<div class="text-danger">
	{{ "No record found" }}
</div>
@endif
<script>
	function tocheck(){
		if(! confirm('Are you sure to want to delete') == true){
			return false;
		}
	}
</script>
@endsection




