@extends('layouts.print')

@section('content')
@if(!empty($srturns_details))

<table  style = 'font-size:10pt;' align= 'center' border = '0' cellpadding = '5px' cellspacing = '0' width = '900px'>
	<tr>
		<td align = center colspan = 2  class =  th><b>RETURN TO STORE REPORT</b><br/><br/>
	</td>
	</tr>
	<td>
		<br/><b>Customer: </b> {{ $srturns_details->customer->title }}<br/><b>Address: </b>{{ $srturns_details->customer->address }}
	</td>
	<td  style = 'text-align:left; width:200px;' >Sr. No {{ $srturns_details->sale_id }}<br/>Date: {{ date_format(date_create($srturns_details->created_at),'d-m-Y') }}<br/>Bill/DC No ------------ <br/>Warhouse: @foreach($srturns_details->salereturndetails as $salerd) @endforeach {{ $salerd->warehouse->title }}
	</td>
	</tr>
</table>
<table style = 'font-size:10pt;' align= center border = '1' cellpadding = '5px' cellspacing = 0 width = 900px>

	<tr >
		<th style = 'text-align:left;'> Sr #</th>
		<th style = 'text-align:left;'> Code No</th>
		<th style = 'text-align:left;'> Item Description</th>
		<th style = 'text-align:left;'> Lot No</th>
		<th style = 'text-align:left;'> Expiry</th>
		<th style = 'text-align:left;'> Qty</th>
	</tr>
	<tr>
		@php
			$counter = 1;
		@endphp
		@foreach($srturns_details->salereturndetails as $srd)
			<td>{{ $counter }}</td>
			<td>{{ $srd->product->code }}</td>
			<td>{{ $srd->product->description }}</td>
			<td>{{ $srd->lotno }}</td>
			<td style = 'text-align:right';>{{ $srd->expiry }}</td>
			<td>{{ $srd->quantity }}</td>
			@php
				$counter++;	
			@endphp
			
		@endforeach
	</tr>
</table>  

    <table style = 'font-size:10pt;' align= center border = 0 cellpadding = 0 cellspacing = 0 width = 800px>
    <tr>
	    <td>
	    	<br/><br/><br/><br/>
	    </td>
	    <td></td>
	    <td colspan = "4" style = 'text-align:right;'><b>Total Carton ____________ </b>
	    </td>
    </tr>
    <tr>
    	<td style = 'text-align:left;'>Remarks </td>
    	<td colspan = "6"><hr align="left" width="500px" size="1px" color="black">
    	</td>
    </tr>
    <tr>
    	<td style = "text-align:left;height:50px;" ></td><td colspan = "6"><hr align="left" width="500px" size="1px" color="black"> </td>
    </tr>
    <tr>
    	<td colspan = 5 style = 'text-align:left;'><br/><br/><br/><br/>Received By:</td><td colspan = 2 style = 'text-align:right;'><br/><br/><br/><br/>Checked By</td>
    </tr>
</table>
@endif
<script type="text/javascript">
    // window.print();
    // setTimeout("window.close()",600000) ;
</script>		
@endsection