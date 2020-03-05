@extends('layouts.app')
@section('content')

<h1>Customer Wise Ledger</h1>
	
	<table class="table table-hover table-bordered">
		<caption style="caption-side: top; text-align: center; font-size:25pt;"> {{ $customertitle->title	 }} </caption>
		<thead>
			<tr>
				<th>View</th>
				<th>Order Date</th>
				<th>Order No</th>
				<th>Order Amount</th>
				<th>Amount Paid</th>
				<th>Sale Return</th>
				<th>Receiveable</th>
			</tr>
		</thead>
		<tbody>

			{{-- <tr>
				<td colspan="3" align="right">Previous</td>
				<td align="right">{{ $previousorderamount->previousamount }}</td>
				<td colspan="3">&nbsp;</td>
			</tr> --}}
			@php
				$returntotal = 0;
				// $ordertotal = $previousorderamount->previousamount;
				$ordertotal = 0;
				$paidtotal = 0;
				$receiveabletotal = 0;
				
			@endphp
			@foreach($orders as $d)
					<tr>
						<td> <a  href ="{{ url('/order', $d->id )}}/print" class="btn btn-primary" target="_blank"><span class="fa fa-eye fa-1x"></span></a></td>

						<td>{{ date_format(date_create($d->created_at),'d-m-Y') }}</td>
						<td>{{ $d->id }} </td>
						<td align="right">{{ $d->ordertotal }}</td>
			@php
				$ordertotal += $d->ordertotal;
			@endphp
						<td align="right">
							@php
								$pamount = 0;
							@endphp
							@foreach($payments as $payment)
								@if ($d->id == $payment->order_no)
									@php
										$pamount = $payment->amount;
									@endphp
								@endif
							@endforeach
							{{ $pamount }}
							@php
							$paidtotal += $pamount;
							@endphp
						</td>
						<td align="right">

							@php
							$rtotal = 0;
							@endphp
							@foreach($returns as $r)

								@if($d->id == $r->order_id)
									@php
									$rtotal += $r->returntotal;
									@endphp
								@endif
							@endforeach
							{{ $rtotal }}
							@php
							$returntotal += $rtotal;
							@endphp
						</td>
						<td align="right">
							@php 
								$receieable = $d->ordertotal - $rtotal - $pamount;
								$receiveabletotal += $receieable;
							@endphp
									{{ $receieable }}
						</td>						

						
					</tr>
			@endforeach
		</tbody>
		<tr>
			<td colspan="3" align="right">Total</td>
			<td align="right">{{ $ordertotal }}</td>
			<td align="right">{{ $paidtotal }}</td>
			<td align="right">{{ $returntotal }}</td>
			<td align="right">{{ $receiveabletotal }}</td>
			
		</tr>
	</table>


@endsection