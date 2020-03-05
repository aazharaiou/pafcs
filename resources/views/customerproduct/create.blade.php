@extends('layouts.app')

@section('content')

<h1>Customer Product Profile</h1>
<div class="text-danger">* Mandatory</div>
<form action="{{ url('/customerproduct') }}" method="post">
	@csrf
	
	<div class="form-group">
		<label for="customerid">Customer</label><span class="text-danger">*</span>
		<select name="customer_id" id="customer_id" class="form-control" autofocus="autofocus">
		<option value="">select customer</option>
		@foreach ($customers as $customer)
			<option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
		@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('customer_id') }}</span>
	
	<div class="form-group">
		<label for="product_id">Product</label><span class="text-danger">*</span>
		<select name="product_id" id="product_id" class="form-control" autofocus="autofocus">
		<option value="">select product</option>
		@foreach ($products as $product)
			<option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->code }}</option>
		@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('product_id') }}</span>
	
	<div class="form-group">
	<label for="description">Product Description</label><span class="text-danger">*</span>
	<input type="text" name="description" class="form-control " value="{{ old('description') }}">
	</div>
	<span class="text-danger">{{ $errors->first('description') }}</span>

	<div class="form-group">
	<label for="saleprice">Sale Price</label><span class="text-danger">*</span>
	<input type="number" name="saleprice" step=".01" class="form-control " value="{{ old('saleprice') }}">
	</div>
	<span class="text-danger">{{ $errors->first('saleprice') }}</span>

	<div class="row">
		<div class="form-group">
			<button class="btn btn-primary">Submit</button>			
		</div>
	
	</div>
	
</form>
@endsection