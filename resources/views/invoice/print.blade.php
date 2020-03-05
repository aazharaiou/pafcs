{{-- @extends('layouts.print') --}}
<style type="text/css">

	@page{margin:0px auto;}

		.trborder
		{
			border-top-style: none;
			border-bottom-style: none;
		}
		.trborder_first
		{
			border-bottom-style: none;
		}
		.trborder_last
		{
				border-top-style: none;
		}
</style>
@section('content')

	@if(!is_null($invoice))
	<div style = "width:800px; text-align:right; margin-bottom: 20px;margin-top:75px;">
	<h1>
				@if($invoice['taxtype'] == '1')

		            @php
		             $pretext = "STI-";
		            @endphp
		
	            @elseif($invoice['taxtype'] == '2')
		            @php
		             $pretext = "INV-";
		            @endphp
		
		        @elseif($invoice['taxtype'] == '3')
		            @php
		                $pretext = "SYSTEMINVOICE-";
		            @endphp

	            @endif
				

			@if($invoice['taxtype'] == 1 ) 
				@php
				echo 'Invoice';
				@endphp
			@else
				@php
				echo 'Invoice';
				@endphp

			@endif
	</h1>
</div>

<div style = "width:800px;">
	<div style = "width:380px;  border:1px solid; float:left;margin-top:20px; padding:5px; margin-bottom:105px;">
		<b>SOLD TO</b><br><br><b>{{ $invoice->customer->title }}</b>
	</div>

@if($invoice->taxtype == 1 |  $invoice->taxtype == 2)
		@php
		echo '<div style = "width:380px; height:100px; border:1px solid; float: right; padding:5px; margin-bottom: 5px;">Bank Details<br>Title: Sadqain Health Care PVT LTD<br>Account No: 120067589<br>Allied Bank, Br Code 0339<br>Trunk Bazar, Rawalpindi</div>';


		echo '<div style = "width:380px; height:75px; border:1px  solid; float: right; padding:5px; margin-bottom: 5px;">Sadqain Health Care PVT LTD<br>GST No, 2300300001555<br>NTN# 3324051-5</div>';
		@endphp
@endif
	<table border = "1px" width = "800px" cellpadding="5px" cellspacing="0px" align="center">
			<tr>
				<th>Invoice No</th>
				<th>Date</th>
				<th>P.O. No.</th>
				<th>Customer NTN</th>
			</tr>

			<tr> 
				<td> {{ $pretext. $invoice->id }} </td>
				<td> {{ date_format(date_create($invoice->created_at),'d-M-Y')}} </td>
				<td> {{ $invoice->pono }}</td>
				<td> {{ $invoice->customer->ntn }}</td>
			</tr>

	</table>
	
	<br>

	<table border = "1px" width = "800px" cellpadding="5px" cellspacing="0px" align="center">
			<tr>
				<th>Item</th>
				<th>Description</th>
				<th>Qty</th>
				<th>Unit Price</th>
				<th>Amount</th>
			</tr>
				@php
				$subtotal = 0;
				$lines = 0;
				@endphp
		@foreach($invoice->invoicedetails as $sd)
					@php
						$lines++;
					@endphp
					<tr>
						<td width = '10%'>{{ $sd->product->code }}</td>
						<td>
							@foreach($sd->product->customers as $cust_d)
								@if($cust_d->pivot->customer_id == $invoice->customer_id)
								{{ $cust_d->pivot->description }}
								@endif
							@endforeach
							{{-- {{ $sd->product->description }} --}}
						</td>
						<td width = '10%' style="text-align: right;">{{ $sd->quantity }}</td>
						<td width = '10%' style="text-align: right;">{{ number_format($sd->unit_price, 2) }}</td>
							@php
								$amount = $sd->unit_price * $sd->quantity;
							@endphp
								<td width = '10%' style="text-align: right;">{{ number_format( $amount, 2)}}</td>
					</tr>
						@php
						$subtotal += $amount;
						@endphp
		@endforeach
@if($lines < 15)
	@php
		for($i=$lines; $i<15; $i++)
		{
			echo "<tr><td>&nbsp;</td><td></td><td></td><td></td><td></td></tr>";
		}
	@endphp
@endif
	</table>

<br>

<table border = "0px" cellpadding = "5px" cellspacing="0px" width = "100%">
	<tr>
	
		<td width = "60%">

			@if($invoice['taxtype'] == 1 | $invoice['taxtype'] == 2 ) 
				@php
				echo "On Behalf of SADQAIN HEALTH CARE PVT LTD";
				@endphp
			@else
			@php
				echo " ";
				@endphp
			@endif
		</td>

		<td width = "18%" style = "border:1px solid;">Subtotal:</td>
		<td width = '12%' style = "border:1px solid;" align ='right'>
			<?php echo number_format($subtotal,2); ?>
		</td>

	</tr>

	<tr>
	<td>
		
			
			@if($invoice['taxtype']==1 | $invoice['taxtype'] == 2)

			@php
		echo 	"<td style = 'border:1px solid;'> Sales Tax (" . $invoice['taxrate'] . "%)";
		@endphp
		@else
		@php
			echo " ";
			
			@endphp
		@endif

		</td>
			@php
				$salestax = 0;
			@endphp
		@if ($invoice['taxtype'] == 1)
			@php
				echo '<td style = "border:1px solid;" align ="right">';
				$salestax = $subtotal * $invoice['taxrate'] / 100; 
				echo number_format($salestax,2);
				echo "</td>";
			@endphp
		@endif
	@if($invoice['taxtype'] == 2)
		@php
		echo '<td style = "border:1px solid;" align ="right">';
		$exempt = "Exempt";
		echo $exempt;
		@endphp
	@endif
	</td>

	</tr>

	<tr>
		<td></td><td style = "border:1px solid;">Total:</td><td style = "border:1px solid;" align ='right'>
			@php
			$total = $subtotal + $salestax; 
			echo number_format($total,2);
			@endphp
				
			</td>
	</tr>
</table>

</div>

@endif
{{-- <script type="text/javascript">
	
	window.print();
 setTimeout("window.close()", 10000);
</script> --}}
{{-- @endsection --}}