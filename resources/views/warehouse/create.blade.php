@extends('layouts.app')

@section('content')

	<h1>Warehouse</h1>
	<div class="text-danger">* Mandatory Fields</div>
	<form action="{{ url('/warehouse') }}" method="post">
		@csrf
		<div class="form-group">
		<label for="title">Title</label><span class="text-danger">*</span>
		<input type="text" name="title" class="form-control " autofocus="autofocus" value="{{ old('title') }}">
		</div>
		<span class="text-danger">{{ $errors->first('title') }}</span>

		<div class="form-group">
		<label for="manager">Manager</label><span class="text-danger">*</span>
		<input type="text" name="manager" class="form-control " autofocus="autofocus" value="{{ old('manager') }}">
		</div>
		<span class="text-danger">{{ $errors->first('manager') }}</span>

		<div class="form-group">
		<label for="address">Address</label><span class="text-danger">*</span>
		<input type="text" name="address" class="form-control " autofocus="autofocus" value="{{ old('address') }}">
		</div>
		<span class="text-danger">{{ $errors->first('address') }}</span>

				<div class="form-group">
		<label for="phone">Contact No</label><span class="text-danger">*</span>
		<input type="text" name="phone" class="form-control" autofocus="autofocus" value="{{ old('contactno') }}">
		</div>
		<span class="text-danger">{{ $errors->first('phone') }}</span>

				<div class="form-group">
		<label for="email">E-mail</label>
		<input type="text" name="email" class="form-control" autofocus="autofocus" value="{{ old('email') }}">
		</div>
		<span class="text-danger">{{ $errors->first('email') }}</span>
		<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">	
		<input type="submit" name="submit" class="btn btn-primary btn-lg">

	</form>

@endsection()