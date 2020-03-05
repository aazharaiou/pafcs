@extends('layouts.app')

@section('content')

<h1>Post Sale Return</h1>
<div class="text-danger">* Mandatory Fields</div>

<form action="{{ url('/salereturn') }}" method="post">
	@csrf
	{{-- @method('POST') --}}
	<input type="hidden" name="sale_id" value="{{ $sale->id }}">
	<div class="form-group">
	<label for="title">PO Date</label><span class="text-danger">*</span>
	<input type="date" name="podate" value="{{ $sale->podate }}" class="form-control" readonly="readonly">
	</div>
	<span class="text-danger">{{ $errors->first('podate') }}</span>
	
	<div class="form-group">
	<label for="pono">PO No</label><span class="text-danger">*</span>
	<input type="text" name="pono" value="{{ $sale->pono }}" class="form-control" readonly="readonly">
	</div>
	<span class="text-danger">{{ $errors->first('pono') }}</span>

	<div class="form-group">
		<label for="customer_id">Customer</label>
		<select name="customer_id" id="customer_id" class="form-control" readonly="readonly">
			<option value="">select customer</option>
			@foreach($customers as $customer)
			<option value="{{ $customer->id }}" {{ $sale->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
			@endforeach()
		</select>
	</div>



	
	<table class="form-group table table-hover">
		<tr>
			<th>Serial No</th>
			<th>Product Code</th>
			<th>Description</th>
			<th>Lot No</th>
			<th>Expiry</th>
			<th>Unit Price</th>
			<th>Warehouse</th>

			<th>Sale Quantity</th>
			<th>Return Quantity</th>
		</tr>

		@foreach($sale->saledetails as $sd)
					@php
						$qty = $sd->quantity;
					@endphp
					
					@foreach($salereturn as $sr)
						@foreach($sr->salereturndetails as $srd)
							@if($srd->product_id == $sd->product->id && $srd->lotno == $sd->lotno)
								@php
									$qty = $qty - $srd->quantity
								@endphp
							@endif
						@endforeach
					@endforeach
					<tr>
					<td>{{ @$loop->iteration }}</td>
					
					<td><input type="text" name="code[]" class="form-control" value="{{ $sd->product->id }}" readonly="readonly"></td>

					<td><input type="text" name="description" class="form-control" value="{{ $sd->product->description }}" readonly="readonly">	</td>

					<td><input type="text" name="lotno[]" class="form-control" value="{{ $sd->lotno }}" readonly="readonly"></td>

					<td><input type="text" name="expiry[]" class="form-control" value="{{ $sd->expiry }}" readonly="readonly"></td>

					<td><input type="text" name="unit_price[]" class="form-control" value="{{ $sd->unit_price }}" readonly="readonly"></td>

					<td><input type="text" name="warehouse_id[]" class="form-control" value="{{ $sd->warehouse_id }}" readonly="readonly"></td>
					<td>{{ $qty }}</td>
					<td><input type="number" name="quantity[]" class="form-control" value="0" autofocus="autofocus" min="0" max="{{ $qty }}"></td>
					
					</tr>
		@endforeach
	</table>
	<input type="hidden" name="order_id" value="{{ $sale->order_id }}">
	<input type="submit" name="submit" value="Post Sale Return" class="btn btn-primary btn-lg">
	
</form>
@endsection