@extends('layouts.app')

@section('content')

<h1>Pending Order Detail Update</h1>

@foreach($errors->all() as $error)

	<li>
		{{ $error }}
	</li>
@endforeach
<form action="{{ url('/pendingorderdetail',$pendingorderdt->id) }}" method="post">
	@csrf
	@method('PATCH')
	


	<div class="form-group">
		<label for="product">Product</label>
		<select name="product_id" id="productid_id" class="form-control">
			@foreach($products as $product)
			<option value="{{ $product->id }}" {{ $product->id == $pendingorderdt->product_id ? 'selected' : '' }}>{{ $product->code }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
	<label for="podate">PO Date</label>
	<input type="date" name="podate" value="{{ date_format(date_create($pendingorderdt->podate),'Y-m-d') }}" class="form-control">
	</div>
	
	<div class="form-group">
	<label for="quantity">Quantity</label>
	<input type="text" name="quantity" value="{{ $pendingorderdt->quantity }}" class="form-control">
	</div>
	

	<div class="form-group">
	<label for="title">Remarks</label>
	<input type="text" name="remarks" value="{{ $pendingorderdt->remarks }}" class="form-control">
	</div>
	

	<input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>

@endsection