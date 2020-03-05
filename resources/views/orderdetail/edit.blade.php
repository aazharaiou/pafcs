@extends('layouts.app')

@section('content')

<h1>Order Update</h1>

@foreach($errors->all() as $error)

	<li>
		{{ $error }}
	</li>
@endforeach
<form action="{{ url('/orderdetail',$orderdt->id) }}" method="post">
	@csrf
	@method('PATCH')
	
	<div class="form-group">
		<label for="vendorid">Warehouse</label>
		<select name="warehouse_id" id="warehouse_id" class="form-control" autofocus="autofocus">
			@foreach($warehouses as $warehouse)
			<option value="{{ $warehouse->id }}" {{ $warehouse->id == $orderdt->warehouse_id ? 'selected' : ''}}>{{ $warehouse->title }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="vendorid">Product</label>
		<select name="product_id" id="productid_id" class="form-control">
			@foreach($products as $product)
			<option value="{{ $product->id }}" {{ $product->id == $orderdt->product_id ? 'selected' : '' }}>{{ $product->code }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
	<label for="title">Lot No</label>
	<input type="text" name="lotno" value="{{ $orderdt->lotno }}" class="form-control">
	</div>
	
	

	<div class="form-group">
	<label for="title">Expiry</label>
	<input type="date" name="expiry" value="{{ date_format(date_create($orderdt->expirydate),'Y-m-d') }}" class="form-control">
	</div>
	
	<div class="form-group">
	<label for="title">Quantity</label>
	<input type="text" name="quantity" value="{{ $orderdt->quantity }}" class="form-control">
	</div>
	
	<div class="form-group">
	<label for="title">Purchase Price</label>
	<input type="text" name="unit_price" value="{{ $orderdt->unit_price }}" class="form-control">
	</div>

	<div class="form-group">
	<label for="title">Remarks</label>
	<input type="text" name="remarks" value="{{ $orderdt->remarks }}" class="form-control">
	</div>
	
	<input type="hidden" name="">

	<input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>

@endsection