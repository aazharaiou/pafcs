@extends('layouts.app')


@section('content')	
<a href="{{ url('/pendingorder/create') }}" class="btn btn-primary btn-lg text-uppercase">Create Pending Order </a>
<div class="col-6">&nbsp;</div>

<h1>Pending Orders List</h1>
@if(count($porders) >0)
<table class="table table-bordered table-hover">
	<tr>
		<th>Id</th>
		<th>Customer</th>
		<th>PO No</th>
		<th>PO Date</th>
		<th colspan="3">Action</th>
		
		
	</tr>
	
	@foreach( $porders as $porder)
		<tr>
			<td>{{ $porder->id }}</td>
			<td>{{ $porder->customer->title }}</td>
			<td>{{ $porder->pono }}</td>
			<td>{{ date_format(date_create($porder->podate),'d-m-Y') }}</td>
			
			<td><a href="{{ url('/pendingorder',$porder->id) }}" class="btn btn-primary">View</a></td>
			<td><a href="{{ url('/pendingorder',$porder->id) }}/edit" class="btn btn-primary">Edit</a></td>
			<td>
				<form action="{{ url('/pendingorder', $porder->id) }}" method="post">
					@csrf
					@method('DELETE')

					<button class="btn btn-danger" onclick="return tocheck()">Delete</button>
				</form>
			</td>
		</tr>
	@endforeach
	
</table>
@else
	

<div class="text-danger">
	{{ "No record found" }}
</div>
@endif
<script>
	function tocheck(){
		if(! confirm('Are you sure to want to delete') == true){
			return false;
		}
	}
</script>
@endsection




