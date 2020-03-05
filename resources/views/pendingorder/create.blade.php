@extends('layouts.app')

@section('content')

	<h1>Pending Order</h1>
	<div class="text-danger">* Mandatory Fields</div>
	<form action="{{ url('/pendingorder') }}" method="post" autocomplete="off">
	@csrf
	<ol>
		@foreach ($errors->all() as $error)
			<li>
			{{ $error }}
			</li>
		@endforeach
		
	</ol>
	
<div class="form-group p-3" style="border-width: 5px; border-color: green; border-style: solid;">
<div class="row">
	<div class="col-md-4">
	<div class="form-group">
		<label for="customer">Customer</label><span class="text-danger">*</span>
		<select name="customer_id" id="customer_id" class="form-control">
			<option value="">select customer</option>
			@foreach($customers as $customer)
				<option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
			@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('customer_id') }}</span>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="pono">PO No</label>
			<input type="text" name="pono" value="{{ old('pono') }}" class="form-control">
		</div>
			<span class="text-danger">{{ $errors->first('pono') }}</span>	
	</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="podate">PO Date</label>
		<input type="date" name="podate" class="form-control" value="{{ old('podate') }}">
	</div>
	<span class="text-danger">{{ $errors->first('podate') }}</span>
</div>

</div>

</div>
 	
<div id="products">
<div class="form-group p-3" style="border-width: 5px; border-color:grey; border-style: solid" id="item1">

<div class="row">
<div class="col-md-6">
	<div class="form-group">
		<label for="productid">Product</label><span class="text-danger">*</span>
		<select name="product_id[]" id="product_id" class="form-control">
			<option value="">select product</option>	
			@foreach ($products as $product)
				<option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : ''}}>{{ $product->code }}</option>
			@endforeach
		</select>
		
	</div>
</div>
	<span class="text-danger">{{ $errors->first('product_id') }}</span>
	
	<div class="form-group col-md-6">
		<label for="quantity">Quantity</label><span class="text-danger">*</span>
		<input type="number" name="quantity[]" id="quantity" class="form-control" min="1">
	</div>
	<span class="text-danger">{{ $errors->first('quantity') }}</span>


</div>
	<div class="form-group">
	 <button class="btn btn-danger" onclick="remove(this)">
	 	<span class="fa fa-trash"></span> REMOVE
	 </button>
	</div>
</div>
</div> {{-- div wrapped --}}

	<div class="row pull-right">
		<div class="form-group">
			<span class="btn btn-success add-more" id="btnadd" > <span class="fa fa-plus"></span> ADD ANOTHER ITEM</span>
		</div>
	</div>

<div class="row form-group">
	<button class="btn btn-primary"><span class="fa fa-plus"></span> Create Pending Order</button>
</div>
</form>


<script type="text/javascript">
	$(document).ready(function(){
		$("#btnadd").click(function(){
			var cl = $("#item1").clone();
			         $(cl).find("#quantity").val("");

			$("#products").append(cl);
		});
	});

function remove(item)
{
	item.parentNode.parentNode.remove();
}

</script>

@endsection()