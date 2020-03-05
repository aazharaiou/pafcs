@extends('layouts.print')

@section('content')

<table class="table table-bordered">
	<tr><td colspan="2" class="text-center "><b>Invoice</b></td></tr>
		<tr>
		<td><b>Order Number</b></td> <td>{{ $sales->id }} </td>
		<td><b>PO Number</b></td> <td>{{ $sales->pono }} </td>
	</tr>
	<tr>
		<td>Customer:</td>
		
		
		{{-- <td>{{ $sales->saledetails->customer->title }}  --}}
			{{-- <br> {{ $sales->customer->address }}</td> --}}
	</tr>
		
	<tr>
		<td colspan="4"><h1>Items Details</h1></td>
	</tr>
	<tr>
		<td colspan="4">
			<table class="table table-bordered table-striped">
				<tr>
					<td>Sr No.</td>
					<td>Code</td>
					<td>Description</td>
					<td>Lotno</td>
					<td>Expiry</td>
					<td>Quantity</td>
					<td>Unit_Price</td>
					<td>Amount</td>
					
				</tr>

					@foreach($sales->saledetails as $sd)
					
					<tr>
					<td>{{ @$loop->iteration }}</td>
					<td>{{ $sd->product->code }}</td>
					<td>{{ $sd->product->description }}</td>
					<td>{{ $sd->lotno }}</td>
					<td>{{ date_format(date_create($sd->expiry),'d-m-Y') }}</td>
					<td>{{ $sd->quantity }}</td>

					{{-- <td>
						@php
							$qty = 0;
						@endphp
						@foreach($sd->order->saledetails as $s)
							@foreach ($s->saledetails as $sd)
								@if($sd->product_id == $sd->product_id)
									@php
										$qty += $sd->quantity;
									@endphp 
								@endif
							@endforeach
						@endforeach
						{{ $qty }}
					</td> --}}
					<td>{{ number_format($sd->unit_price, 2) }}</td>
					<td>{{ $sd->unit_price * $sd->quantity }}</td>
					{{-- <td>{{ $sd->warehouse->title }}</td> --}}
					</tr>
					@endforeach

			</table>
		</td>
	</tr>
</table>

@endsection

