@extends('layouts.app')

@section('content')

<h1>Purchase</h1>
<div class="text-danger">* Mandatory Fields</div>


<form action="{{ url('/purchase') }}" method="post" autocomplete="off">
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
	<div class="col-md-3">
		<div class="form-group">
			<label for="purchasedate">Date</label>
			<input type="date" name="purchasedate" value="{{ date("Y-m-d") }}" class="form-control">
			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
		</div>
	</div>
<div class="col-md-3">
	<div class="form-group">
		<label for="purchaseno">Invoice Number (PO)</label>
		<input type="text" name="invoiceno" class="form-control" autofocus="autofocus" value="{{ old('invoiceno') }}">
	</div>
	<span class="text-danger">{{ $errors->first('invoiceno') }}</span>
</div>
<div class="col-md-3">
	<div class="form-group">
		<label for="vendorid">Vendor</label><span class="text-danger">*</span>
		<select name="vendor_id" id="vendorid" class="form-control">
			<option value="">select vendor</option>
			@foreach($vendors as $vendor)
				<option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->title }}</option>
			@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('vendor_id') }}</span>
</div>
<div class="col-md-3">
	<div class="form-group">
		<label for="warehouse">Warehouse</label><span class="text-danger">*</span>
		<select name="warehouse_id" id="warehouse_id" class="form-control" >
			<option value="">select warehouse</option>
			@foreach($warehouses as $warehouse)
				<option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->title }}</option>
			@endforeach
		</select>
	</div> 
</div>
	<span class="text-danger">{{ $errors->first('warehouse_id') }}</span>
</div>

</div>
 	
<div id="products">
<div class="form-group p-3" style="border-width: 5px; border-color:grey; border-style: solid" id="item1">
<div class="row">
<div class="col-md-4">
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
	<div class="form-group col-md-4">
		<label for="lotno">Lot No</label><span class="text-danger">*</span>
		<input type="text" name="lotno[]" id="lotno" class="form-control" >
	</div>
	<span class="text-danger">{{ $errors->first('lotno') }}</span>
	<div class="form-group col-md-4">
		<label for="expiry">Expiry Date</label><span class="text-danger">*</span>
		<input type="date" name="expiry[]" id="expiry" class="form-control" >
	</div>
	<span class="text-danger">{{ $errors->first('expiry') }}</span>
</div>

<div class="row">
	
	<div class="form-group col-md-4">
		<label for="quantity">Quantity</label><span class="text-danger">*</span>
		<input type="number" name="quantity[]" id="quantity" class="form-control" >
	</div>
	<span class="text-danger">{{ $errors->first('quantity') }}</span>

	<div class="form-group col-md-4">
		<label for="purchaseprice">Purchase Unit Price</label><span class="text-danger">*</span>
		<input type="number" step="any" name="purchaseprice[]" id="purchaseprice" class="form-control" >
	</div>
	<span class="text-danger">{{ $errors->first('purchaseprice') }}</span>
	<div class="form-group col-md-4">
		<label for="carton">Carton</label>
		<input type="text" name="carton[]" id="carton" class="form-control" >
	</div>

</div>

<div class="row">
	
	<div class="form-group col-md-12">
		<label for="remarks">Remarks</label>
		<input type="text" name="remarks[]" id="remarks" class="form-control">
	</div>
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
	<button class="btn btn-primary"><span class="fa fa-plus"></span> Create Purchase</button>
</div>
</form>


<script type="text/javascript">
	$(document).ready(function(){
		$("#btnadd").click(function(){
			var cl = $("#item1").clone();
			         $(cl).find("#lotno").val("");
			         $(cl).find("#expiry").val("");
			         $(cl).find("#quantity").val("");
			         $(cl).find("#purchaseprice").val("");
			         $(cl).find("#carton").val("");
			         $(cl).find("#remarks").val("");
			$("#products").append(cl);
		});
	});

function remove(item)
{
	item.parentNode.parentNode.remove();
}

</script>
@endsection