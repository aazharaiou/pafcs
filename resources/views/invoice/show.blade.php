@extends('layouts.app')

@section('content')
<h1>Invoice Detail</h1>
<table class="table table-bordered">
	<tr>
		<td><b>Invoice Number</b></td>
		<td>{{ $invoice->id }} </td>
	</tr>
	<tr>
		<td>Customer:</td>
		<td>{{ $invoice->customer->title }} </td>
	</tr>

	<tr>
		<td>Remarks:</td>
		<td>{{ $invoice->remarks }} </td>
	</tr>
	<tr>
		<td>Action</td>
		<td>
			<a href="{{ url('invoice', $invoice->id) }}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a>
			{{-- <form action="{{ url('invoice',$invoice->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger" onclick="return tocheckdelete() ">Delete</button>

			</form> --}}

		</td>
	</tr>
	<tr>
		<td colspan="2">Invoice Detail</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-striped">
				<tr>
					<td>Code</td>
					<td>Description</td>
					<td>Quantity</td>
					<td>Price</td>
					<td>Action</td>
					<td></td>
					
				</tr>
	
					@foreach($invoice->invoicedetails as $inv_d)
					<tr>
					<td>{{ $inv_d->product->code }}</td>
					<td>
						@foreach($inv_d->product->customers as $cust_d)
							@if($cust_d->pivot->customer_id == $invoice->customer_id)
							{{ $cust_d->pivot->description }}
							@endif
						@endforeach

					</td>
					<td>{{ $inv_d->quantity }}</td>
					<td>{{ number_format($inv_d->unit_price,2) }}</td>
					
					<td><a href=" {{ url('invoicedetail', $inv_d->id ) }}/edit" class="btn btn-primary"> <span class="fa fa-pencil"></span> Edit</a></td>
					<td>
						<form action="{{ url('/invoicedetail',$inv_d->id) }}" method="post">
							@csrf
							@method('DELETE')

							<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> Delete</button>
						</form>
					</td>
					</tr>
					@endforeach

			</table>
		</td>
	</tr>
</table>

@endsection

<script type="text/javascript">
	function tocheckdelete(){
		if(!confirm('are you sure to delete this item?') == true)
		{
			return false;
		}
	}
</script>