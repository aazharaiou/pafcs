@extends('layouts.app')
@section('content')

<h1>Customer Wise Product Sale Report</h1>
	
	{{-- {{ dd(<1></1>ctitle) }} --}}
	<table class="table table-hover table-bordered">
		<caption style="caption-side: top; text-align: center; font-size:25pt;"> {{ $ctitle->title }} </caption>
		<thead>
			<tr>
				<th>Date</th>
				<th>Order No</th>
				<th>Product</th>
				<th>Quantity</th>
			</tr>
		</thead>
		<tbody>
			@foreach($sales as $d)
				@foreach($d->saledetails as $pd)
					<tr>
						<td>{{ date_format(date_create($d->created_at),'d-m-Y') }}</td>
						<td>{{ $d->order_id }} </td>
						<td>{{ $pd->product->description }}</td>
						<td>{{ $pd->quantity }} </td>

					</tr>
				@endforeach
			@endforeach
		</tbody>
	</table>


@endsection