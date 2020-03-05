@extends('layouts.app')

@section('content')

<h1>Product Update</h1>
<div class="text-danger">* Mandatory</div>
@foreach($errors->all() as $error)
	<li>{{ $error }}</li>
@endforeach
<form action="{{ url('/product',$product->id) }}" method="post" autocomplete="off">
	@csrf
	@method('PATCH')

	<div class="form-group">
		<label for="vendorid">Vendor</label><span class="text-danger">*</span>
		<select name="vendor_id" id="vendor_id" class="form-control" autofocus="autofocus">
		<option value="">select vendor</option>
		@foreach ($vendors as $vendor)
			<option value="{{ $vendor->id }}" {{ $vendor->id == $product->vendor_id ? 'selected' : '' }}>{{ $vendor->title }}</option>
		@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('vendor_id') }}</span>
	
	<div class="form-group">
	<label for="partno">Part No</label><span class="text-danger">*</span>
	<input type="text" name="partno" class="form-control text-uppercase" value="{{ $product->partno }}">
	</div>
	<span class="text-danger">{{ $errors->first('partno') }}</span>

	<div class="form-group">
	<label for="noun">Noun</label><span class="text-danger">*</span>
	<input type="text" name="noun" class="form-control text-uppercase" value="{{ $product->noun }}">
	</div>
	<span class="text-danger">{{ $errors->first('noun') }}</span>

	<div class="form-group">
	<label for="ui">UI</label>
	<input type="text" name="ui" class="form-control text-uppercase" value="{{ $product->ui }}">
	</div>
	
	<button class="btn btn-primary">Update</button>
</form>

@endsection