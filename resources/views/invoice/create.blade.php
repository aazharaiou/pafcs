@extends('layouts.app')
@section('content')
	<h1>Invoice</h1>

	<div class="text-danger">* Mandatory Fields</div>
	<form action="{{ url('/invoice') }}" method="post" autocomplete="off" id="myform">
	@csrf
	<div class="row">
		<div class="form-group col-md-4">
			<label for="taxtype">Tax Type</label><br>
			<input type="radio"  name="taxtype" class="taxtype" id="taxtype" value="1" {{ (old('taxtype') == '1') ? 'checked' : '' }} required="required">Tax
			<input type="radio"  name="taxtype" class="taxtype" id="taxtype" value="2" {{ (old('taxtype') == '2') ? 'checked' : '' }}> Exempt
			<input type="radio"  name="taxtype" class="taxtype" id="taxtype" value="3" {{ (old('taxtype') == '3') ? 'checked' : '' }}> N/A
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label for="invoiceno">Invoice No</label>
			<input type="number" name="invoice_no" id="invoice_no" class="form-control"  readonly="">
		</div>

		<div class="form-group col-md-6">
		<label for="customer_id">Customer</label><span class="text-danger">*</span>
		<select name="customer_id" id="customer_id" class="form-control" autofocus="autofocus" required="required">
		<option value="">select customer</option>
		@foreach ($customers as $customer)
			<option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
		@endforeach
		</select>
		</div>
		<input type="hidden" name="customer_id" id="hid_customer_id">
		<span class="text-danger">{{ $errors->first('customer_id') }}</span>
	</div>
	<div class="row">	
		<div class="form-group col-md-6">
				<label for="pono">PO No</label>
				<input type="text" name="pono" class="form-control" value="{{ old('pono') }}" required="required">
			<span class="text-danger">{{ $errors->first('pono') }}</span>
		</div>
		
		

		<div class="form-group col-md-6">
				<label for="taxrate">Tax Rate</label>
				<input type="number" name="taxrate" class="form-control" id="gst">
		</div>
	</div>
		<span class="text-danger">{{ $errors->first('taxrate') }}</span>
		
		<div class="form-group">
				<label for="remarks">Remarks</label>
				<input type="text" name="remarks" class="form-control" id="gst">
		</div>
		<span class="text-danger">{{ $errors->first('remarks') }}</span>
		
		<div class="form-group">
	<input type="hidden" name="user_id" class="form-control " value="{{ Auth::user()->id }}">
	</div>

<div id="products" style="display: none">
<div class="form-group p-3" style="border-width: 5px; border-color:grey; border-style: solid" id="item1">

<div class="row">
<div class="col-md-6">
	<div class="form-group">
		<label for="productid">Product</label><span class="text-danger">*</span>
		<select name="product_id[]" class="form-control product_id" >
			<option value="">select product</option>	
		</select>
		
	</div>
</div>
	<span class="text-danger">{{ $errors->first('product_id') }}</span>
	<div class="form-group col-md-6">
		<label for="quantity">Quantity</label><span class="text-danger">*</span>
		<input type="number" name="quantity[]" class="form-control" id="quantity" min="0" max="stock">
	</div>
	<span class="text-danger">{{ $errors->first('quantity') }}</span>
</div>

<div class="row">
	
	
	<div class="form-group col-md-2">
		<label for="unit_price">Sale Unit Price</label><span class="text-danger">*</span>
		<input type="number" step="any" name="unit_price[]" class="form-control unit_price">
	</div>
	<span class="text-danger">{{ $errors->first('unit_price') }}</span>
	<div class="form-group col-md-10">
		<label for="remarks">Remarks</label>
		<input type="text" name="remarks2[]" class="form-control">
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

			<span class="btn btn-success add-more" style="display:none" id="btnadd"> <span class="fa fa-plus"></span> ADD ANOTHER ITEM</span>
		</div>
	</div>

		<button class="btn btn-primary">Submit</button>

		</form>
		
<script type="text/javascript">

$(document).ready(function(){
	$("#btnadd").click(function(){
			var cl = $("#item1").clone();
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
			$("#btnadd").show();
			$("#hid_customer_id").val($("#customer_id").val());
			$("#customer_id").attr('disabled','disabled');
		});


    $('#myform input').on('change', function()
    {
        var v_taxtypeid = $('input[name=taxtype]:checked', '#myform').val(); 
        
        $.ajax({
        
        url: "{{ url("/filler/getMaxInvoiceNo") }}", 
            type: "POST",
            // dataType: 'json',
            data: {v_taxtypeid, "_token": "{{ csrf_token() }}"},
            success:function(data){
            	var invno = JSON.parse(data);
            	$('#invoice_no').val(invno);		
             }
            
        });
    });

		$(function(){

		    var taxr = $('#gst');
		    taxr.attr('disabled','disabled');
		        $('input[name=taxtype]').change(function(e){
		            if($(this).val() == '1') {
		                taxr.removeAttr('disabled');
		            }
		            else{
		                taxr.attr('disabled','disabled');
		            }
		    
		    });
		});
});
	function remove(item)
	{
		item.parentNode.parentNode.remove();
	}
</script>
@endsection