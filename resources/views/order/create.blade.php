@extends('layouts.app')

@section('content')

	<h1>Order</h1>
	<div class="text-danger">* Mandatory Fields</div>
	<form action="{{ url('/order') }}" method="post"  enctype="multipart/form-data">
		@csrf

<div class="form-group p-3" style="border-width: 5px; border-color: green; border-style: solid;">
		<div class="row">

		<div class="form-group col-md-4">
			<label for="customer_id">Customer</label><span class="text-danger">*</span><br>
			<select id="customer_id" class="form-control" autofocus="autofocus">
				<option value="">select customer</option>
				@foreach($customers as $customer)
					<option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>

				@endforeach()
			</select>
			<input type="hidden" name="customer_id" id="hid_customer_id">
			<span class="text-danger">{{ $errors->first('customer_id') }}</span>
		</div>
		
		<div class="form-group col-md-4">
			<label for="warehouse_id">Warehouse</label><span class="text-danger">*</span><br>
			<select id="warehouse_id" class="form-control" autofocus="autofocus">
				<option value="">Select Warehouse</option>
				@foreach($warehouses as $warehouse)
					<option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->title }}</option>

				@endforeach()
			</select>
			<input type="hidden" name="warehouse_id" id="hid_warehouse_id">
			<span class="text-danger">{{ $errors->first('warehouse_id') }}</span>
		</div>


		<div class="form-group col-md-4">
			<label for="podate">PO Date</label><span class="text-danger">*</span>
			<input type="date" name="podate" class="form-control" value="{{ old('podate') }}" >
			<span class="text-danger">{{ $errors->first('podate') }}</span>
		</div>
		</div>
	<div class="row">
		<div class="form-group col-md-6">
		<label for="pono">PO No</label><span class="text-danger">*</span>
		<input type="text" name="pono" class="form-control "  value="{{ old('pono') }}">
			<span class="text-danger">{{ $errors->first('pono') }}</span>
		</div>
		
		
		<div class="form-group col-md-6">
		<label for="image">PO Image</label><span class="text-danger">*</span>
		<input type="file" name="poimage" value="{{ old('poimage') }}" class="form-control">
		<span class="text-danger">{{ $errors->first('poimage') }}</span>
		</div>			
	</div>
</div>
<div id="products" style="display: none">
<div class="form-group p-3" style="border-width: 5px; border-color:grey; border-style: solid" id="item1">
	<div class="row">
<div class="col-md-6">
	<div class="form-group">
		<label for="productid">Product</label><span class="text-danger">*</span>
		<select name="product_id[]" class="form-control product_id" onchange="procid(this)">
			<option value="">select product</option>	
		</select>
		
	</div>
</div>
	<span class="text-danger">{{ $errors->first('product_id') }}</span>
<div class="col-md-6">
	<div class="form-group">
		<label for="warehouse">Warehouse</label><span class="text-danger">*</span>
		<select name="warehouse_id[]" onchange="wid(this)" class="form-control">
			<option value="">select warehouse</option>
			{{-- @foreach($warehouses as $warehouse)
				<option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->title }}</option>
			@endforeach --}}
		</select>
	</div> 
</div>
</div>
	<span class="text-danger">{{ $errors->first('warehouse_id') }}</span>
<div class="row">
	<div class="form-group col-md-6">
		<label for="lotno">Lot No</label><span class="text-danger">*</span>
		<input type="text" name="lotno[]" class="form-control" readonly="readonly">
	</div>
	<span class="text-danger">{{ $errors->first('lotno') }}</span>

	<div class="form-group col-md-6">
		<label for="expiry">Expiry Date</label><span class="text-danger">*</span>
		<input type="date" name="expiry[]" class="form-control" readonly="readonly">
	</div>
	<span class="text-danger">{{ $errors->first('expiry') }}</span>
</div>

<div class="row">
	<div class="form-group col-md-6">
		<label for="quantity">Quantity</label><span class="text-danger">*</span>
		<input type="number" name="quantity[]" class="form-control" id="quantity" min="0" max="stock">
	</div>
	<span class="text-danger">{{ $errors->first('quantity') }}</span>
	
	<div class="form-group col-md-6">
		<label for="unit_price">Sale Unit Price</label><span class="text-danger">*</span>
		<input type="number" step="any" name="unit_price[]" class="form-control unit_price" readonly="readonly">
	</div>
	<span class="text-danger">{{ $errors->first('unit_price') }}</span>
</div>

	
	<div class="form-group" >
		<label for="remarks">Remarks</label>
		<input type="text" name="remarks[]" class="form-control">
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
			<span class="btn btn-success add-more" id="btnadd"> <span class="fa fa-plus"></span> ADD ANOTHER ITEM</span>
		</div>
	</div>		

		<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">	
		<input type="submit" name="submit" class="btn btn-primary btn-lg">
	
	</form>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btnadd").click(function(){
			var cl = $("#item1").clone();
				$(cl).find("#quantity").val("");
			$("#products").append(cl);
		});

		$("#customer_id").change(function(){
			//alert($("#customer_id").val());
			var cust = $("#customer_id").val();
			$.ajax({
				dataType: 'json',
				type: "POST",
				url: "{{ url("/filler/getproductsbycustomer") }}",
				data: {cust},
				success: function (data)
				{
					for(var i=0; i<data.length; i++)
					{
						var pname = JSON.parse(JSON.stringify(data[i]));
						$("#products select").eq(0).append(new Option(pname.code+" - " + pname.description,pname.id));
					}
					
				}
			});
			$("#products").show();
			$("#hid_customer_id").val($("#customer_id").val());
			$("#customer_id").attr('disabled','disabled');
		});

		$("#warehouse_id").change(function(){

			// alert('Warehouse Changed');
			$("#warehouse_id").attr('disabled', 'disabled');
			$("#hid_warehouse_id").val($("#warehouse_id").val());
		});

	});

function remove(item)
{
item.parentNode.parentNode.remove();
}

function procid(item)
{
	//alert($("#hid_customer_id").val() + "  " + item.value);
	// alert(item.value);
	var wid = $("#hid_warehouse_id").val();
	var cid = $("#hid_customer_id").val();
	var pid = item.value;
	// $("#products select").eq(1).empty();
	$.ajax({
  		type: "POST",
  		url: "{{ url("/filler/getpricebypid") }}",
		data: {wid,pid,cid},
  		// data: "cid="+cid+"&pid="+pid,
  		success: function(data)
  		{
  				var pdiv = item.parentNode.parentNode.parentNode.parentNode.childNodes;
  				// console.log(pdiv);
  				var psdiv = pdiv[6].childNodes;
  				// console.log(psdiv);
  				var pdiv = psdiv[4].childNodes;
  				// console.log(pdiv[3].value);
  				pdiv[3].value = data[0].saleprice;
  				// $('.unit_price').val(data[0].saleprice);		
  		},
	});

	$.ajax({
		type: "POST",
		url: "{{ url('/filler/getstockbyproductid') }}",
		data: {wid,pid},
		dataType: 'json',
		success: function(data)
		{
			var pdiv = item.parentNode.parentNode.parentNode.parentNode.childNodes;
			var abc = pdiv[0].childNodes;
			var abc2 = abc[4].childNodes;
			// var abc3 = abc2[0].childNodes;

			// console.log($(abc2).find("select"));

					
			// alert(JSON.stringify(data));
			// $('#products select').eq(1).children('option').remove();
			// $('#products select').eq(1).empty();
			$(abc2).find("select").empty();
			$(abc2).find("select").append(new Option("Select Warehouse","-1000"));
			for(var i=0; i<data.length; i++)
					{
						var wname = JSON.parse(JSON.stringify(data[i]));
						// abc2[0].value = $("#products select").eq(1).empty();

						$(abc2).find("select").append(new Option("Stock :" + wname.stock+"; Lot No :" + wname.lotno + "; W_Id - " + wname.warehouse_id + " Exp :" + wname.expiry, wname.warehouse_id ));
						// $("#products select").eq(1).append(new Option("Stock :" + wname.stock+"; Lot No :" + wname.lotno + "; W_Id - " + wname.warehouse_id + "Exp :" + wname.expiry, wname.warehouse_id ));

					}
		},
	});
}

	function wid(warehid)
	{
		var widtext = $(warehid).find(":selected").text();
		 
		var stock = widtext.split(':')[1].split(';')[0];
		var lotno = widtext.split(':')[2].split(';')[0];
		var expiry = widtext.split(':')[3].split(';')[0];

		// var a = document.getElementById("item1").children;
		// var a2 = a[2].children;
		// var a3 = a2[0].children;
		
		// a3[0].value = lotno;
		// console.log(a2);
		// console.log(a.children);
	var a = warehid.parentNode.parentNode.parentNode.parentNode.childNodes;

	var lotno_child = a[4].childNodes;
	var lotno_input = lotno_child[0].childNodes;

	var expiry_child = a[4].childNodes;
	var expiry_input = expiry_child[4].childNodes;

	var stock_child = a[6].childNodes;
	var stock_input = stock_child[0].childNodes;

	

	lotno_input[3].value = lotno;
	expiry_input[3].value = expiry;
	stock_input[3].value = stock;
	stock_input[3].setAttribute("max", stock) ;
	


	console.log(expiry_input); 

	// console.log(stock);
	// console.log(lotno);
	// console.log(expiry);


}
</script>
@endsection()