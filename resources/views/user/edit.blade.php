@extends('layouts.app')

@section('content')

<h1>User Update</h1>


<form action="{{ url('/user',$user->id) }}" method="post">
	@csrf
	@method('PATCH')
	<div class="form-group">
	<label for="title">User Name</label>
	<input type="text" name="name" value="{{ $user->name }}" class="form-control" autofocus="autofocus">
	</div>
	
	<div class="form-group">
	<label for="title">E-mail</label>
	<input type="text" name="email" value="{{ $user->email }}" class="form-control" autofocus="autofocus">
	</div>
	<div class="form-group">
	<label for="title">Role</label>
	
	<select name="role" id="role" class="form-control" required>
         <option value="Sale">Sale</option>
         <option value="Admin">Admin</option>
         <option value="Account">Account</option>
         <option value="WH_Manager">Warehouse Manager</option>
         <option value="Marketing">Marketing</option>
    </select>
	</div>


	

	<input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>

@endsection