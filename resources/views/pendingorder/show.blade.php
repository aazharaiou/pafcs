@extends('layouts.app')

@section('content')

<h1>Pending Order Detail</h1>


<table class = 'table table-bordered'>
<tr>
	<td>Customer</td> <td>{{ $pendingorder->customer->title }}</td>
</tr>
<tr>
	<td>Po No</td> <td>{{ $pendingorder->pono }}</td>
</tr>
<tr>
	<td>PO Date</td> <td>{{ $pendingorder->podate }}</td>
</tr>
<tr>
		<td colspan="2">Pending Order Details</td>
</tr>

<tr>
		<td colspan="2">
			<table class="table table-bordered table-striped">
				<tr>
					<td>Product Id</td>
					<td>Description</td>
					<td>Quantity</td>
					<td colspan="3">Action</td>
					
				</tr>
					@foreach($pendingorder->pendingorderdetails as $opd)
					@if(!empty($opd) > 0)
					<tr>

						<td>{{ $opd->product->code }}</td>
						<td>{{ $opd->product->description }}</td>
						<td>{{ $opd->quantity }}</td>
						
						<td><a href=" {{ url('pendingorderdetail', $opd->id ) }}/edit" class="btn btn-primary"> <span class="fa fa-pencil"></span> Edit</a></td>
						<td>
						<form action="{{ url('/pendingorderdetail',$opd->id) }}" method="post">
							@csrf
							@method('DELETE')

							<button class="btn btn-danger" onclick="return tocheckdelete() "><span class="fa fa-trash"></span> Delete</button>
						</form>
					</td>
					</tr>
					@endif
					@endforeach

			</table>
		</td>
	</tr>
</table>
<script>
	function tocheckdelete(){
		if(! confirm('Are you sure to want to delete') == true){
			return false;
		}
	}
</script>
@endsection