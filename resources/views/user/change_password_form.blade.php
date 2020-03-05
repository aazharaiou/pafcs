@extends('layouts.app')
@section('content')
<h1>Update Password</h1>
<form action="{{ url('/puser',$user->id) }}" method="post">
	@csrf
	@method('PATCH')
	<div class="form-group">
	<label for="password">Password</label>
	<input type="text" name="password"  value="{{ old('password') }}" class="form-control" autofocus="autofocus" required autofocus >
	<span class="text-danger">{{ $errors->first('password') }}</span>
	</div>
	
	<input type="submit" name="submit" value="Update Password" class="btn btn-primary">
</form>
@endsection