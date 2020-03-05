@extends('layouts.app')

@section('content')

<h1>Post Order</h1>
<div class="text-danger">* Mandatory Fields</div>

@php
	$sales = App\Sale::select('id')->where('order_id',$order->id)->get();
	$has_sales = count($sales) > 0 ? True: False;

@endphp

<form action="{{ url('/sale') }}" method="post" enctype="multipart/form-data">
	@csrf
	{{-- @method('POST') --}}
	<input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
	<input type="hidden" name="order_id" value="{{ $order->id }}">
	
	<div class="form-group">
	<label for="title">PO Date</label><span class="text-danger">*</span>
	<input type="date" name="podate" value="{{ $order->podate }}" class="form-control" readonly="readonly">
	</div>
	<span class="text-danger">{{ $errors->first('podate') }}</span>
	
	<div class="form-group">
	<label for="pono">PO No</label><span class="text-danger">*</span>
	<input type="text" name="pono" value="{{ $order->pono }}" class="form-control" readonly="readonly">
	</div>
	<span class="text-danger">{{ $errors->first('pono') }}</span>

	<div class="form-group">
		<label for="customer_id">Customer</label>
		<select name="customer_id" id="customer_id" class="form-control" readonly="readonly">
			<option value="">select customer</option>
			@foreach($customers as $customer)
			<option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
			@endforeach()
		</select>
	</div>

	
	<table>
		<tr>
			<th>Serial No</th>
			<th>Product Code</th>
			{{-- <th>Description</th> --}}
			<th>Lot No</th>
			<th>Expiry</th>
			<th>Unit Price</th>
			<th>Warehouse</th>
			<th>Order Quantity</th>
			<th>Posted Quantity</th>
			<th>Remaining Quantity</th>
			<th>Stock Quantity</th>
			<th>Sale Quantity</th>
		</tr>
		@foreach($order->orderdetails as $od)
					
					<tr>
					<td>{{ @$loop->iteration }}</td>
					
					<td><input type="hidden" name="code[]" class="form-control" value="{{ $od->product->id }}" readonly="readonly">{{ $od->product->code }}</td>

					{{-- <td><input type="text" name="description" class="form-control" value="{{ $od->product->description }}" readonly="readonly"></td> --}}

					<td><input type="text" name="lotno[]" class="form-control" value="{{ $od->lotno }}" readonly="readonly"></td>

					<td><input type="text" name="expiry[]" class="form-control" value="{{ $od->expiry }}" readonly="readonly"></td>

					<td><input type="text" name="unit_price[]" class="form-control" value="{{ number_format($od->unit_price, 2) }}" readonly="readonly"></td>

					<td><input type="text" name="warehouse_id[]" class="form-control" value="{{ $od->warehouse_id }}" readonly="readonly"></td>
					@php
						$stock = $od->product->purchasedetails->where('warehouse_id',$od->warehouse_id)->where('lotno',$od->lotno)->where('expiry',$od->expiry)->sum('quantity') + $od->product->salereturndetails->where('warehouse_id',$od->warehouse_id)->where('lotno',$od->lotno)->where('expiry',$od->expiry)->sum('quantity') - $od->product->saledetails->where('warehouse_id',$od->warehouse_id)->where('lotno',$od->lotno)->where('expiry',$od->expiry)->sum('quantity');
						// $min = $stock < $od->quantity ? $stock : $od->quantity; 
					@endphp
					<td><input type="number" name="oquantity[]" class="form-control" value="{{ $od->quantity }}" readonly="readonly">
					@php
						$pq = 0;
						if($has_sales)
						{	
							foreach($sales as $sale)
							{
								$tq = App\SaleDetail::where('product_id',$od->product_id)->where('sale_id',$sale->id)->get()->sum('quantity');
								$pq += $tq;
							}
						}
						$rq = $od->quantity - $pq;
						$min =  $stock > $rq ? $rq : $stock;
					@endphp
					</td>
					<td>{{ $pq }}</td>

					<td><input type="text" class="form-control" readonly="readonly" name="pquantity[]" value="{{ $rq }}"></td>

					<td>{{ $stock }}</td>

					<td><input type="number" name="quantity[]" class="form-control" value="{{ $min }}" max="{{ $min }}" min="0" style="width:75px;"> </td>

					{{-- <td><input type="number" name="quantity[]" class="form-control" value="{{ $od->quantity - $pq }}" max="{{ $od->quantity - $pq }}" min="0" style="width:100px;">  --}}

					</td>
					
					</tr>
		@endforeach
	</table>
	<input type="submit" name="submit" value="Post Order" class="btn btn-primary btn-lg">
</form>

@endsection