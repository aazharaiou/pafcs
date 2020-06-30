@extends('layouts.app')

@section('content')

<h1>Company</h1>
<div class="text-danger">* Mandatory</div>
	<form action="{{ url('/company') }}" method="post" enctype="multipart/form-data">
	@csrf


	<div class="form-group">
	<label for="title">Title</label><span class="text-danger">*</span>
	<input type="text" name="title" class="form-control " value="{{ old('title') }}">
	</div>
	<span class="text-danger">{{ $errors->first('title') }}</span>

	<div class="form-group">
	<label for="logo">Logo</label><span class="text-danger">*</span>
	<input type="file" name="logo" class="form-control " value="{{ old('logo') }}">
	</div>
	<span class="text-danger">{{ $errors->first('logo') }}</span>

	<div class="form-group">
	<label for="header">Header</label><span class="text-danger">*</span>
	<input type="file" name="header" class="form-control " value="{{ old('header') }}">
	</div>
	<span class="text-danger">{{ $errors->first('header') }}</span>

	<div class="form-group">
	<label for="footer">Footer</label>
	<input type="file" name="footer" class="form-control " value="{{ old('footer') }}">
	</div>
	
	

	<button class="btn btn-primary">Submit</button>
</form>

@endsection