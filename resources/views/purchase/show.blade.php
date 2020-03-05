@extends('layouts.app')

@section('content')
<h1>Purchase Detail</h1>
<table class="table table-bordered">
	<tr>
		<td><b>Invoice Number</b></td>
		<td>{{ $purchase->invoiceno }} </td>
	</tr>
	<tr>
		<td>Business Line:</td>
		<td>{{ $purchase->vendor->title }} </td>
	</tr>
	<tr>
		<td>Action</td>
		<td>
			<a href="{{ url('purchase', $purchase->id) }}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a>
			{{-- <form action="{{ url('purchase',$purchase->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger" onclick="return tocheckdelete() ">Delete</button>

			</form> --}}

		</td>
	</tr>
	<tr>
		<td colspan="2">Products</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-striped">
				<tr>
					<td>Code</td>
					<td>Description</td>
					<td>Quantity</td>
					<td>Price</td>
					<td>Warehouse</td>
					<td colspan="3">Action</td>
					
				</tr>

					@foreach($purchase->purchasedetails as $pd)
					<tr>
					<td>{{ $pd->product->code }}</td>
					<td>{{ $pd->product->description }}</td>
					<td>{{ $pd->quantity }}</td>
					<td>{{ number_format($pd->purchase_price,2) }}</td>
					<td>{{ $pd->warehouse->title }}</td>
					<td><a href=" {{ url('purchasedetail', $pd->id ) }}/edit" class="btn btn-primary"> <span class="fa fa-pencil"></span> Edit</a></td>
					<td>
						<form action="{{ url('/purchasedetail',$pd->id) }}" method="post">
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