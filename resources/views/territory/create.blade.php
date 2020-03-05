@extends('layouts.app')


@section('content')

<h1>Territory</h1>
<div class="text-danger">* Mandatory Fields</div>

<form action="{{ url('/territory') }}" method="post" autocomplete="off">
	@csrf

	<div class="form-group">
		<label for="tiltle">Title</label><span class="text-danger">*</span>
		<input type="text" name="title" class="form-control" autofocus="autofocus" value="{{ old('title') }}">
		<span class="text-danger">{{ $errors->first('title') }}</span>
	</div>
	<button class="btn btn-primary">Submit</button>
</form>

@endsection