@extends('layouts.print');
@section('content')
{{-- records calculation starts --}}
@php
	$records = array();
@endphp
@foreach($purchases as $purchase)
	@php
	$record = array();
	$record['date'] = strtotime($purchase->created_at);
	$record['warehouse'] = $purchase->warehouse->title;
	$record['lot'] = $purchase->lotno;
	$record['orderno'] = $purchase->purchase_id;
	$record['purchase'] = $purchase->quantity;
	$record['sale'] = 0;
	$records[]= $record;
	@endphp
@endforeach
@foreach($sales as $sale)
	@php
	$record = array();
	$record['date'] = strtotime($sale->created_at);
	$record['warehouse'] = $sale->warehouse->title;
	$record['lot'] = $sale->lotno;
	$record['orderno'] = $sale->sale_id;
	$record['purchase'] = 0;
	$record['sale'] = $sale->quantity;
	$records[]= $record;
	@endphp
@endforeach
@foreach($returns as $return)
	@php
	$record = array();
	$record['date'] = strtotime($return->created_at);
	$record['warehouse'] = $return->warehouse->title;
	$record['lot'] = $return->lotno;
	$record['orderno'] = $return->salereturn_id;
	$record['purchase'] = $return->quantity;
	$record['sale'] = 0;
	$records[]= $record;
	@endphp
@endforeach

@php
	function sortByDate($a, $b) {
    return $a['date'] - $b['date'];
	}
	usort($records, 'sortByDate');
	$counter=1;
	$balance = 0;
@endphp	

{{-- Records calculation ends --}}
<table class="table table-bordered">

	<thead>
		<tr class="text-center" >
			<td colspan= "8">
				Stock Register </br>Product Code : {{ $product->code }}</br> 
Product Description: {{ $product->description }} 	
			</td>
			
		</tr>
		<tr>
			<th>Serial No</th>
			<th>Date</th>
			<th>Warehouse</th>
			<th>Lotno</th>
			<th>Order No</th>
			<th>Purchase/Sale Return</th>
			<th>Sale</th>
			<th>Balance</th>

		</tr>
	</thead>
		<tbody>
		@foreach($records as $record)
		<tr>
			<td>{{ $counter++ }}</td>
			<td>{{ date("d-m-Y h:m a",$record['date']) }}</td>
			<td>{{ $record['warehouse'] }}</td>
			<td>{{ $record['lot'] }}</td>
			<td>{{ $record['orderno'] }}</td>
			<td>{{ $record['purchase'] }}</td>
			<td>{{ $record['sale'] }}</td>
			@php
				$balance = $balance + $record['purchase'] - $record['sale'];
			@endphp
			<td>{{ $balance }}</td>
		</tr>
		@endforeach
		</tbody>
</table>



@endsection