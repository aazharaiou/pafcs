@extends('layouts.print')

@section('content')

<table border="0px" cellpadding="5px" width="800px" align="center">
	<tr><td colspan="4" class="text-center"><b><u>ORDER FORM</u></b></td></tr>
	<tr>
		<td colspan="2" style="width:500px;"><b><u>Order Reference Hospital</u></b></td>
		<td colspan="2" style="width:200px; text-align: right;"><b><u>Order Reference SHC</u></b></td>
		
	</tr>
	<tr>
		<td style="width:100px">Date:</td>
		<td style="width:400px">{{ date_format(date_create($order->podate),'d-m-Y') }}</td>
		<td>Date:</td><td>{{ date_format(date_create($order->created_at),'d-m-Y') }}</td>
	</tr>
	<tr>
		<td>PO Number:</td><td>{{ $order->pono }} </td><td>Order No:</td><td>{{ sprintf('%03d', $order->id) }}</td>
	</tr>
	<tr>
		<td >Dispatch To:</td><td>{{ $order->customer->title }} <br> {{ $order->customer->address }}</td>
		<td>Warehouse:</td>
		
		<td>
			@php 
				$warehouseid = "";
					foreach($order->orderdetails as $wid)
			            $warehouseid = $wid->warehouse->title ;
			@endphp
				{{ $warehouseid }}
		</td>
	</tr>
		
	<tr>
		<td colspan="6"><b>Items Details</b></td>
	</tr>
	<tr>
		<td colspan="11">
			<table border="1px" cellpadding="5px" width="800px" align="center">
				<tr>
					<th>Sr No.</th>
					<th>Code</th>
					<th>Description</th>
					<th>Quantity</th>
					<th>Desp Qty</th>
					<th>Rate</th>
					<th>Amount</th>
				</tr>
				@if(count($order->orderdetails) > 0)
				@php
				$total = 0;
				@endphp
					@foreach($order->orderdetails as $od)
					
					<tr>
					<td>{{ @$loop->iteration }}</td>
					<td>{{ $od->product->code }}</td>
					<td>{{ $od->product->description }}</td>
					<td>{{ $od->quantity }}</td>

					
						@php
							$qty = 0;
							$amount = 0;
							
						@endphp

						@foreach($od->order->sales as $s)
							@foreach ($s->saledetails as $sd)

								@if($sd->product_id == $od->product_id and $sd->lotno == $od->lotno )
									@php
										$qty += $sd->quantity;
										$amount += $sd->quantity * $sd->unit_price;
									    $total += $amount;
									@endphp 
								@endif

							@endforeach
						@endforeach
					<td>{{ $qty }}</td>
					<td>{{ number_format($od->unit_price, 2) }}</td>
					
					<td align="right">{{ number_format($amount, 2) }}  </td>
	
					</tr>
					
					@endforeach
					<tr>
					<td colspan="6" align="right" style="border-right-style:hidden;border-left-style:hidden;border-bottom-style:hidden;"><b>Total</b></td>
					<td align="right" style="border-right-style:hidden;border-left-style:hidden;border-bottom-style:hidden;"><b>{{ number_format($total,2) }}</b></td>
				</tr>
				@endif
				
			</table>
		</td>
	</tr>
</table>
		<table border="0px" width="800px" align="center">
				<tr><td>&nbsp;</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td>&nbsp;</td></tr>

				<tr>
					<td style="text-align:left; width:200px; text-align: center;"><span style="text-decoration-line: overline;">Prepare By</span></td>
					<td style="text-align:center; width:200px; text-align: center;"><span style="text-decoration-line: overline">Checked By</span></td>
					<td style="text-align:center; width:200px; text-align: center;"><span style="text-decoration-line: overline;">Checked By</span></td>
					<td style="text-align:right; width:200px; text-align: center;"><span style="text-decoration-line: overline;">Dispatch By</span></td>
				</tr>
		</table>	
		<table border="0px" width="800px" align="center">
			<tr><td></td></tr>
			<tr><td>Through</td></tr>
			<tr>
				<td>Truck</td>
				<td>Leopard</td>
				<td>Daewoo</td>
				<td>By Air</td>
				<td>Care Cargo</td>
				<td>New Flying Coach</td>
				<td>TCS Overland</td>
				<td>Local</td>
			</tr>
		</table>	
		<table border="0px" width="800px" align="center">
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td style="width:150px;"><b>Key Notes</b></td><td><hr style="border-width:1px; border-color: black;"></td>
			</tr>
			<tr>
				<td></td><td><hr style="border-width:1px; border-color: black;"></td>
			</tr>
			<tr>
				<td></td><td><hr style="border-width:1px; border-color: black;"></td>
			</tr>
		</table>

		<table border="0px" width="800px" align="center">
			<tr>
				<td style="width: 267px;">Checklist for supporting</td>
				<td style="width: 267px;">
					<span style="font-size: 30px;">&#9633;</span> Order Reference <span style="font-size: 30px;">&#9633;</span> Delivery Challan
				</td>
				<td style="width: 267px; text-align: center;">
					<span style="font-size: 30px;">&#9633;</span> TR Slip<span style="font-size: 30px;">&#9633;</span> Invoice
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: center;"><span>&lt;<span>&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;</span>&gt;</span></td>
				<td style="text-align: center;"><span>&lt;<span>&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;</span>&gt;</span></td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: center;">Supply Chain</td>
				<td style="text-align: center;">Accounts</td>
			</tr>
		</table>

		<table border="0px" width="800px" align="center">
			<tr>
				<td style="width: 200px;">TR No / Receipt No</td>
				<td style></td>
				<td style="width: 200px;">Date</td>
				<td style="width: 200px;">Freight</td>
			</tr>
		</table>

		<table border="1px" width="800px" align="center">
			<tr>
				<td style="width: 200px; height: 75px;"></td>
				<td style="width: 200px;"></td>
				<td style="width: 200px;"></td>
				<td style="width: 200px;">Paid by Comapny</td>
			</tr>
		</table>
<script type="text/javascript">
    window.print();
    setTimeout("window.close()",600000) ;
</script>		
@endsection