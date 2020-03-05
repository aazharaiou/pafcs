@extends('layouts.app')

@section('content')
<div class="col-md-12 text-right">
	<a href="{{ url('/user') }}" class="btn btn-primary btn-lg  text-uppercase"><span class="fa fa-list"></span> Users List </a>
</div>
<h1>User Detail</h1>

<table class="table table-bordered">
	<tr>
		<td>User Name</td>
		<td>{{ $user->name }}</td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td>{{ $user->email }}</td>
	</tr>
	<tr>
		<td>Role</td>
		<td>{{ $user->role }}</td>
	</tr>
</table>
@endsection