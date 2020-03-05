@extends('layouts.print')
@section('content')


<table align= center border = '0' cellpadding = 0 cellspacing = 0 width = 900px>
					
	<tr>
		<td align = center colspan = 3 width=150>
			<b>DELIVERY CHALLAN</b>
			<br>
			<br>
			<br>
		</td>
	</tr>
	<tr>
		<td width = '400px'>Dispatch to :<br> {{ $sales->customer->title }}<br>{{ $sales->customer->address }}<br>Office No: {{ $sales->customer->officeno }}<br>Cell No: {{ $sales->customer->cellno }}<br><br><br>
		</td>
		<td style='padding-left:250px'>
		    Order No: {{ sprintf('%03d', $sales->order_id) }}
		    <br>
		    
			DC NO: 
				{{ sprintf('%03d',$sales->id) }}
			<br>
			Date: 
				{{ date_format(date_create($sales->created_at),"d-m-Y") }}
				<br>
				Order No {{ $sales->order->pono }} 
				<br>
			
				@php 
				$warehouseid = "";
				
				
					foreach($sales->saledetails as $wid)
			             $warehouseid = $wid->warehouse->title ;
				@endphp
					Warehouse: {{ $warehouseid }}
			 
				<br>
				<br>
				<br>
				<br>
		</td>
	</tr>
</table>
<table align= center border = '1' cellpadding = '10px' cellspacing = 0 width = 900px>
		<tr>
		<th style = text-align:left;> Sr #</th>
		<th style = text-align:left;> Code No</th>
		<th style = text-align:left;> Item Description</th>
		<th style = text-align:left;> Lot No</th>
		<th style = text-align:left;> Expiry</th>
		<th style = text-align:left;> Qty</th>
		
		</tr>
@if (count($sales->saledetails)>0)
		@foreach($sales->saledetails as $sd)
		<tr>
			

					<td>{{ @$loop->iteration }}</td>
					<td>{{ $sd->product->code }}</td>
					<td>{{ $sd->product->description }}</td>
					<td>{{ $sd->lotno }}</td>
					<td width="110px">{{ date_format(date_create($sd->expiry),'d-m-Y') }}</td>
					<td style ='text-align:right;'>
						{{--
						@php
							$qty = 0;
						@endphp
						
						 @foreach($sd->sale->order->orderdetails as $od)
							
								@if($sd->product_id == $od->product_id)
									@php
										$qty += $od->quantity;
									@endphp 
								@endif
							
						@endforeach
						--}}
						{{ $sd->quantity }}
					</td>
					
					
					
			
		</tr>
		@endforeach
		@endif
</table>

					<table align= center border = '0' cellpadding = 0 cellspacing = 0 width = 800px>
						<tr ><td style="line-height: 50px;">&nbsp;</td></tr>
					<tr>
							<td width = '150px'>Dispatch Detail:</td><td><hr align = 'left' width = '250px' size = '1px' color = 'black'></td><td>Packing</td><td align='right'>Bundle:_______________</td>
							</tr>
					<tr>
						<td ></td><td><hr align = 'left' width = '250px' size = '1px' color = 'black'></td><td></td><td align='right'>Carton:_______________</td>
					</tr>
						<tr>
						<td ></td><td></td><td></td><td align='right'>Total Carton:_______________</td>
						</tr>
					</table>
					
					<table align= center border = '0' cellpadding = 0 cellspacing = 0 width = 800px>
						<tr ><td style="line-height: 50px;">&nbsp;</td></tr>
					<tr>
					<td >Issued By</td><td style = 'text-align:right;'>Checked By</td><td style = 'text-align:right;'>Acknowledge Receipt<br>Receiver's Signature</td>
					</tr>
					<tr>
					<td colspan = '3'>Note: Kindly send back signed and stamped copy of DC for our record.</td>
					</tr>
					
					</table>
<script type="text/javascript">
    window.print();
    setTimeout("window.close()",60000) ;
</script>
@endsection