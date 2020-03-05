@extends('layouts.app')


@section('content')
<a href="{{ url('/order/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Order </a>
<div class="col-6">&nbsp;</div>

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible"> {{ Session::get('success') }}</div>
  @endif

<h1>Orders List</h1>
@if(count($orders) >0)
<table class = 'table' id='dtable'>
	<thead>
	<tr>
		<th>Order No</th>
		<th>Create Date</th>
		<th>Customer</th>
		<th>PO No</th>
		<th>Image</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
	</thead><tbody>
	@foreach( $orders as $order)
		<tr>
			<td>{{ $order->id }}</td>
			<td width="100px">{{ date_format(date_create($order->created_at),'d-m-Y') }}</td>
			<td>{{ $order->customer->title }}</td>
			<td>{{ $order->pono }}</td>
			<td> <a href="{{ url('/upload',$order->poimage) }}" target="_blank" class="btn btn-primary"> <span class="fa fa-eye fa-1x"></span></a></td>
			<td><a href="{{ url('/order',$order->id) }}" class="btn btn-primary"><span class="fa fa-eye"></span> View Details</a></td>
		    <td><a  href ="{{ url('/order', $order->id )}}/print" class="btn btn-primary" target="_blank"><span class="fa fa-print"></span> Print</a></td>
			<td>{{ $order->order_post }}</td>


			
			<!--</td>-->


		</tr>
	@endforeach

</tbody></table>
@else


<div class="text-danger">
	{{ "No record found" }}
</div>
@endif
<script type="text/javascript">

	$(document).ready(function() {
    $('#dtable').DataTable({
        "order": [[ 0, "DESC" ]],
    });
} );
</script>
@endsection