@extends('layouts.print')

@section('content')

<table border="0px" cellpadding="5px" cellspacing="5px" width="800px" align="center">
	<tr><td colspan="2" class="text-center "><b>STOCK RECEIVING REPORT</b></td></tr>
	<tr>
		<td style="width: 600px;">{{ $purchase->vendor->title }} <br> {{ $purchase->vendor->address }}

	
		</td>
		<td style="width: 200px;">
			Sr No. {{ $purchase->id }}
			<br>
			Date: {{ date_format(date_create($purchase->created_at),'d-m-Y') }}
			<br>
			Bill/DC No ------------
			<br>
			@foreach($purchase->purchasedetails as $wid)
			
			@endforeach
			Warehouse: {{ $wid->warehouse->title }}
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>Items Details</b></td>
	</tr>
	<tr>
		<td colspan="2">
			<table border="1px" cellpadding="5px" cellspacing="5px" width="1000px" align="center">
				<tr>
					<th>Sr No.</th>
					<th>Code</th>
					<th>Description</th>
					<th>Lotno</th>
					<th>Expiry</th>
					<th>Quantity</th>
					<th>Carton</th>					
				</tr>

					@foreach($purchase->purchasedetails as $pd)
					
					<tr>
					<td style="width: 50px;">{{ @$loop->iteration }}</td>
					<td style="width: 150px;">{{ $pd->product->code }}</td>
					<td style="width: 400px;">{{ $pd->product->description }}</td>
					<td style="width: 100px;">{{ $pd->lotno }}</td>
					<td style="width: 100px;">{{ date_format(date_create($pd->expiry),'d-m-Y') }}</td>
					<td style="width: 100px; text-align: right;">{{ $pd->quantity }}</td>
					<td style="width: 100px;"></td>
					
					</tr>

					@endforeach

			</table>
		</td>
	</tr>
</table>
<table border="0px" width="800px" align="center">
	<tr>
		<td style="text-align: right; line-height: 100px;" colspan="2">
			Total Carton ____________
		</td>
	</tr>
	<tr>
		<td style="line-height: 50px; width: 125px; vertical-align: top;">
			Remarks
		</td>
		<td>
			<hr style="border-width:1px; border-color: black;">
			<br>
			<hr style="border-width:1px; border-color: black;">
		</td>
	</tr>
	<tr>
		<td><span style="text-decoration-line: overline;">Received By:</span></td>
		<td style="text-align: right; line-height: 100px;"><span style="text-decoration-line: overline;">Checked By:</span></td>
	</tr>
</table>
<script type="text/javascript">
    window.print();
    setTimeout("window.close()",900000) ;
</script>
@endsection