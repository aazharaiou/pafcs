@extends('layouts.app')

@section('content')

<h1>Payment Detail</h1>


<table class = 'table'>
<tr>
	<td>Date</td><td>{{ date_format(date_create($payment->created_at),'d-m-Y H:i:s A') }}</td>
</tr>
<tr>
	<td>Customer</td> <td>{{ $payment->customer->title }}</td>
</tr>
<tr>
	<td>Order No</td> <td>{{ $payment->order_no }}</td>
</tr>
<tr>
	<td>Ivoice No</td> <td>{{ $payment->invoice_no }}</td>
</tr>
<tr>
	<td>Amount</td> <td>{{ $payment->amount }}</td>
</tr>
<tr>
	<td>Remarks</td><td>{{ $payment->remarks }}</td>
</tr>
<tr>
	<td>Created By</td> <td>{{ $payment->user->name }}</td>
</tr>

</table>

@endsection