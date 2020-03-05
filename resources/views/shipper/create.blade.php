@extends('layouts.app')

@section('content')

	<h1>Shipper</h1>
	<div class="text-danger">* Mandatory Fields</div>
	<form action="{{ url('/shipper') }}" method="post">
		@csrf
		<div class="form-group">
		<label for="title">Title</label><span class="text-danger">*</span>
		<input type="text" name="title" class="form-control " autofocus="autofocus" value="{{ old('title') }}">
		</div>
		<span class="text-danger">{{ $errors->first('title') }}</span>

		<div class="form-group">
		<label for="phone">Contact No
		</label><span class="text-danger">*</span>
		<input type="text" name="phone" class="form-control " autofocus="autofocus" value="{{ old('phone') }}">
		</div>
		<span class="text-danger">{{ $errors->first('phone') }}</span>

		<input type="submit" name="submit" class="btn btn-primary btn-lg">

	</form>

@endsection()