@extends('layouts.app')


@section('content')

		<a href="{{ url('/territory/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Territory</a>

<div class="col-6">&nbsp;</div>
<h1>Territory List</h1>

@if(count($territories) > 0)
	<table class = 'table' id='dtable'>
		<thead>
		<tr>
			<th>Title</th>
			<th>Action</th>
			<th></th>
			<th></th>
		</tr>
	</thead><tbody>
	@foreach($territories as $territory)
		<tr>
			<td>{{ $territory->title }}</td>
			<td><a href="{{ url('/territory',$territory->id) }}" class="btn btn-primary"><span class="fa fa-eye"></span> View</a></td>
			<td><a href="{{ url('/territory', $territory->id) }}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a></td>
			<td>
				<form action="{{ url('/territory', $territory->id) }}" method="post">
					@csrf
					@method('DELETE')

					<button class="btn btn-danger" onclick="return tocheckdelete()"><span class="fa fa-trash"></span> Delete</button>
				</form>
			</td>
			
		</tr>

	@endforeach
	</tbody></table>
@else
<div class="text-danger">
	{{ "No record Found!" }}	

@endif
</div>

<script type="text/javascript">
	function tocheckdelete(){
		if(!confirm("Are you want to delete this record") == true)
			return false;
	}


</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#dtable').DataTable();
	});
</script>
@endsection