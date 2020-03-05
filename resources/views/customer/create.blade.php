@extends('layouts.app')

@section('content')

<h1>Customer</h1>
<div class="text-danger">* Mandatory</div>
<form action="{{ url('/customer') }}" method="post">
	@csrf
	
	<div class="form-group">
		<label for="territoryid">Territory</label><span class="text-danger">*</span>
		<select name="territory_id" id="territory_id" class="form-control" autofocus="autofocus">
		<option value="">select territory</option>
		@foreach ($territories as $territory)
			<option value="{{ $territory->id }}" {{ old('territory_id') == $territory->id ? 'selected' : '' }}>{{ $territory->title }}</option>
		@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('territory_id') }}</span>
	
	<div class="form-group">
	<label for="title">Title</label><span class="text-danger">*</span>
	<input type="text" name="title" class="form-control " value="{{ old('title') }}">
	</div>
	<span class="text-danger">{{ $errors->first('title') }}</span>

	<div class="form-group">
	<label for="address">Address</label><span class="text-danger">*</span>
	<input type="text" name="address" class="form-control " value="{{ old('address') }}">
	</div>
	<span class="text-danger">{{ $errors->first('address') }}</span>

	<div class="form-group">
	<label for="cellno">Cellno</label><span class="text-danger">*</span>
	<input type="text" name="cellno" class="form-control " value="{{ old('cellno') }}">
	</div>
	<span class="text-danger">{{ $errors->first('cellno') }}</span>

	<div class="form-group">
	<label for="officeno">Office No</label>
	<input type="text" name="officeno" class="form-control " value="{{ old('officeno') }}">
	</div>
	
	<div class="form-group">
	<label for="faxno">Fax No</label>
	<input type="text" name="faxno" class="form-control " value="{{ old('faxno') }}">
	</div>
	
	<div class="form-group">
	<label for="email">E-Mail</label>
	<input type="text" name="email" class="form-control " value="{{ old('email') }}">
	</div>
	<span class="text-danger">{{ $errors->first('email') }}</span>
	
	<div class="form-group">
	<label for="ntn">NTN No</label>
	<input type="text" name="ntn" class="form-control " value="{{ old('ntn') }}">
	</div>
	<span class="text-danger">{{ $errors->first('ntn') }}</span>

	


	<button class="btn btn-primary">Submit</button>
</form>

@endsection