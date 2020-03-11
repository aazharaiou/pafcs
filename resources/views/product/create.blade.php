@extends('layouts.app')

@section('content')

<h1>Product</h1>
<div class="text-danger">* Mandatory Fields</div>
<form action="{{ url('/product') }}" method="post" autocomplete="off">
	@csrf
		
	<div class="form-group">
	<label for="code">Part No</label><span class="text-danger">*</span>
	<input type="text" name="partno" class="form-control " value="{{ old('partno') }}">
	</div>
	<span class="text-danger">{{ $errors->first('partno') }}</span>

	<div class="form-group">
	<label for="noun">Noun</label><span class="text-danger">*</span>
	<input type="text" name="noun" class="form-control " value="{{ old('noun') }}">
	</div>
	<span class="text-danger">{{ $errors->first('noun') }}</span>

	<div class="form-group">
	<label for="ui">UI</label>
	<input type="text" name="ui" class="form-control " value="{{ old('ui') }}">
	</div>

	<button class="btn btn-primary">Submit</button>
</form>

@endsection