@extends('layouts.app')

@section('content')

<h1>Customer Product</h1>
<div class="text-danger">* Mandatory</div>
<form action="{{ url('/customerproduct', $customerproduct->id) }}" method="post">
	@csrf
	@method('PATCH')
	<div class="form-group">
		<label for="customer_id">Customer</label><span class="text-danger">*</span>
		<select name="customer_id" id="customer_id" class="form-control" autofocus="autofocus">
		<option value="">select customer</option>
		@foreach ($customers as $customer)
			<option value="{{ $customer->id }}" {{ $customer->id == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
		@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('customer_id') }}</span>
	
	<div class="form-group">
		<label for="product_id">Product</label><span class="text-danger">*</span>
		<select name="product_id" id="product_id" class="form-control" autofocus="autofocus">
		<option value="">select product</option>
		@foreach ($products as $product)
			<option value="{{ $product->id }}" {{ $product->id == $customerproduct->product_id ? 'selected' : '' }}>{{ $product->code }}</option>
		@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('product_id') }}</span>
	
	<div class="form-group">
	<label for="description">Product Description</label><span class="text-danger">*</span>
	<input type="text" name="description" class="form-control " value="{{ $customerproduct->description }}">
	</div>
	<span class="text-danger">{{ $errors->first('description') }}</span>

	<div class="form-group">
	<label for="saleprice">Sale Price</label><span class="text-danger">*</span>
	<input type="number" name="saleprice" step=".01" class="form-control " value="{{ $customerproduct->saleprice }}">
	</div>
	<span class="text-danger">{{ $errors->first('saleprice') }}</span>

	<input type="hidden" name="">
	<button class="btn btn-primary">Update</button>
</form>

@endsection