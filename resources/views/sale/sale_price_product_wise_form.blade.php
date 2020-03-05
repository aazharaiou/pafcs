@extends('layouts.app')
@section('content')

<h1>Sale Price Product Wise</h1>
<form action="{{ url('sale/spricep') }}" method="post" target="_blank">
	@csrf
	
	@include('layouts/partials/datefrom_dateto')
	
		<div class="form-group col-md-6">
		<label for="product">Product</label>
		<select name="product" id="product" class="form-control" required="required">
			<option value="">Select Product</option>
			@foreach($products as $product)
				<option value="{{ $product->id }}">{{ $product->code }} </option>
			@endforeach
		</select>
	</div>
	
	<div class="form-group col-md-6">
		<label for="territory">Territory</label>
		<select name="territory" id="territory" class="form-control" required="required">
			<option value="all">All</option>
			@foreach($territories as $territory)
				<option value="{{ $territory->id }}">{{ $territory->title }} </option>
			@endforeach
		</select>
	</div>
	
	<div class="form-group col-md-6">
		
	<button class="btn btn-primary">Submit</button>
	</div>
	
</form>
@endsection