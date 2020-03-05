@extends('layouts.app')


@section('content')

		<a href="{{ url('/user/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create User</a>

<div class="col-6">&nbsp;</div>
<h1>Users List</h1>

@if(count($users) > 0)
	<table class = 'table' id='dtable'>
		<thead>
		<tr>
			<th>Id</th>
			<th>User Name</th>
			<th>Action</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead><tbody>
	@foreach($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->name }}</td>
			<td><a href="{{ url('/user',$user->id) }}" class="btn btn-primary"><span class="fa fa-eye"></span> View</a></td>
			<td><a href="{{ url('/user', $user->id) }}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a></td><td><a href="{{ url('/puser', $user->id) }}/pedit" class="btn btn-primary"><span class="fa fa-pencil"></span> Change Password</a></td>

			<td>
				<form action="{{ url('/user', $user->id) }}" method="post">
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