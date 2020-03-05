@extends('layouts.print')
@section('content')

@php
	$products = App\Product::all();
@endphp
<h1> Near to Expiry Report </h1>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Product Code</th>
			<th>Product Description</th>
			<th>Detail (Red=Expired, Green=OK, Yellow=Near to Expiry)</th>
	</tr>
	</thead>
<tbody>
	@foreach ($products as $product)
		@php
			$pds = DB::table('purchase_details')
                            ->select(DB::raw('product_id as id, sum(quantity) as quantity, lotno, expiry'))
                            ->groupBy('product_id', 'lotno', 'expiry')
                            ->where('product_id',$product->id)
                            ->get();                      
		@endphp
		
		@if(count($pds) > 0)
	<tr>
		<td>
		{{ $product->code }}	
		</td>
		<td width="600px">
		{{ $product->description }}
		</td>
		<td>

		
			<table class="table table-bordered table-hover" width = "600px">
				<thead>
					<tr>
						<th>
							Lotno
						</th>
						<th>
							Expiry
						</th>
						<th>
							Quantity
						</th>
					</tr>
				</thead>

				<tbody>

			@foreach ($pds as $pd)
			@php
			$sd = DB::table('sale_details')
        ->select(DB::raw('sum(quantity) as quantity'))
        ->where('product_id',$pd->id)
        ->where('lotno',$pd->lotno)
        ->where('expiry',$pd->expiry)
        ->first(); 

        	$srd = DB::table('sale_return_details')
        ->select(DB::raw('sum(quantity) as quantity'))
        ->where('product_id',$pd->id)
        ->where('lotno',$pd->lotno)
        ->where('expiry',$pd->expiry)
        ->first(); 

        $tqty = $pd->quantity - $sd->quantity + $srd->quantity;
        $todate = new DateTime();
        $expdate = new DateTime($pd->expiry);

        $datediff = $todate->diff($expdate );
        $datediff = $datediff->format("%a");
        
        if($todate > $expdate)
        	$color = "bg-danger";
        elseif ($datediff < $product->graceperiod)
        	$color = "bg-warning";
        else
         $color = "bg-success";

		@endphp
		@if($tqty > 0)
			<tr class="{{ $color }}">
				<td>
					{{ $pd->lotno}}
				</td>
				<td align="right">
					{{ date_format(date_create($pd->expiry),'d-m-Y') }}
				</td>
				<td align="right">
					{{ $tqty }}
				</td>
			</tr>
			@endif
			@endforeach
			</tbody>
		</table>
		
		</td>
	</tr>
	@endif
	@endforeach
</tbody>
</table>
@endsection