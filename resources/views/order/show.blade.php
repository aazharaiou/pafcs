@extends('layouts.app')

@section('content')

<h1>Order Detail</h1>


<table class = 'table table-bordered'>
<tr>
	<td>Customer</td> <td>{{ $order->customer->title }}</td>
</tr>
<tr>
	<td>PO No</td> <td>{{ $order->pono }}</td>
</tr>
<tr>
	<td>Po Date</td> <td>{{ date_format(date_create($order->podate),'d-m-Y') }}</td>
</tr>
<tr>
		<td>Action</td>
		<td>
			<a href="{{ url('order', $order->id) }}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a>
			{{-- <form action="{{ url('order',$order->id) }}" method="post">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger" onclick="return tocheckdelete() ">Delete</button>

			</form> --}}

		</td>
	</tr>
<tr>
	<td colspan="2">Detail</td>
</tr>
<tr>
	<td colspan="2">
		<table class = 'table table-bordered'>
			<tr>
				<th>Product</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Warehouse</th>
				<th colspan="3">Action</th>
			</tr>
			@foreach($order->orderdetails as $od)
				<tr>
					<td>{{ $od->product->code }}</td>
					<td>{{ $od->product->description }}</td>
					<td>{{ $od->quantity }}</td>
					<td>{{ $od->unit_price }}</td>
					<td>{{ $od->warehouse->title }}</td>
					<td><a href=" {{ url('orderdetail', $od->id ) }}/edit" class="btn btn-primary"> <span class="fa fa-pencil"></span> Edit</a></td>
					<td>
				<form action="{{ url('/orderdetail', $od->id) }}" method="post">
					@csrf
					@method('DELETE')

					<button class="btn btn-danger" onclick="return tocheck()"><span class="fa fa-trash"></span> Delete</button>
				</form>
			</td>
				</tr>
			@endforeach
		</table>
	</td>
</tr>
</table>
<script>
	function tocheck(){
		if(! confirm('Are you sure to want to delete') == true){
			return false;
		}
	}
</script>
@endsection