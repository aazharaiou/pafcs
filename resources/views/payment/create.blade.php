@extends('layouts.app')

@section('content')

<h1>Payment</h1>
<div class="text-danger">* Mandatory Fields</div>
<form action="{{ url('/payment') }}" method="post" autocomplete="off">
	@csrf
	
	<div class="form-group">
		<label for="customerid">Customer</label><span class="text-danger">*</span>
		<select name="customer_id" id="customer_id" class="form-control" autofocus="autofocus">
		<option value="">select Customer</option>
		@foreach ($customers as $customer)
			<option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
		@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('customer_id') }}</span>
	
	<div class="form-group">
	<label for="order_no">Select Order No</label>
	<select name="order_no" id="order_no" class="form-control ">
		<option value="">SELECT</option>
	</select>
	{{-- <input type="text" name="order_no" class="form-control " value="{{ old('order_no') }}"> --}}
	</div>
	<span class="text-danger">{{ $errors->first('order_no') }}</span>

	<div class="form-group">
	<label for="invoice_no">Invoice No</label>
	<input type="text" name="invoice_no" class="form-control " value="{{ old('invoice_no') }}">
	</div>
	<span class="text-danger">{{ $errors->first('invoice_no') }}</span>

	<div class="form-group">
	<label for="amount">Amount</label>
	<input type="text" name="amount" class="form-control " value="{{ old('amount') }}">
	</div>
	<span class="text-danger">{{ $errors->first('amount') }}</span>
	
	<div class="form-group">
	<label for="remarks">Remarks</label>
	<input type="text" name="remarks" class="form-control " value="{{ old('remarks') }}">
	</div>
	
	<div class="form-group">
	<input type="hidden" name="user_id" class="form-control " value="{{ Auth::user()->id }}">
	</div>
	<button class="btn btn-primary">Submit</button>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#customer_id').on('change', function () {
     		var customer_id = $("#customer_id option:selected").val();
     		$.ajax({

                // url: 'http://localhost/sadq/public/getorder/'+customer_id,
                url: "{{ url('/getorder/') }}" +"/"+customer_id,
                type: 'GET',
                dataType: 'Json',
                success: function(data)
                {
                   $('#order_no').empty();
                   var options = "";
		            for (i=0; i<data.length; i++)
		            {
		                var order_id = data[i]['order_id'];
		                var order_amount = data[i]['amount'];
		                options += "<option value='"+order_id+"'>"+ order_id + " Order  No Amount = " +order_amount+"</option>";
		            }
		            $('#order_no').append(options);
                }
            });
		});
	});
</script>
@endsection