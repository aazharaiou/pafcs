@extends('layouts.app')

@section('content')

<h1>Company</h1>
<div class="text-danger">* Mandatory</div>
<form action="{{ url('/company', $company->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PATCH')
	<div class="form-group">
	<label for="title">Title</label><span class="text-danger">*</span>
	<input type="text" name="title" class="form-control text-uppercase" value="{{ $company->title }}">
	</div>
	<span class="text-danger">{{ $errors->first('title') }}</span>

	<div class="form-group">
	<label for="logo">Logo</label><span class="text-danger">*</span>
	<input type="file" name="logo" class="form-control text-uppercase" value="{{ $company->logo }}">
	</div>
	<span class="text-danger">{{ $errors->first('logo') }}</span>

	<div class="form-group">
	<label for="header">Header</label><span class="text-danger">*</span>
	<input type="file" name="header" class="form-control text-uppercase" value="{{ $company->header }}">
	</div>
	<span class="text-danger">{{ $errors->first('header') }}</span>

	<div class="form-group">
	<label for="footer">Footer</label>
	<input type="file" name="footer" class="form-control text-uppercase" value="{{ $company->footer }}">
	</div>
	
	<input type="hidden" name="logo_image" value="{{ $company->logo }}">
	<input type="hidden" name="header_image" value="{{ $company->header }}">
	<input type="hidden" name="footer_image" value="{{ $company->header }}">

	<button class="btn btn-primary">Submit</button>
</form>
@foreach($errors->all() as $error)

<li>
	{{ $error }}
</li>

@endforeach
@endsection