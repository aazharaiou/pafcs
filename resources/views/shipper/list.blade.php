@extends('layouts.app')


@section('content')	
<a href="{{ url('/shipper/create') }}" class="btn btn-primary btn-lg text-uppercase"><span class="fa fa-plus"></span> Create Shipper </a>
<div class="col-6">&nbsp;</div>

<h1>Shipper List</h1>
@if(count($shippers) >0)
<table class = 'table' id='dtable'>
	<thead>
	<tr>
		<th>Shipper</th>
		<th>Phone</th>
		<th>Action</th>
		<th></th>
		<th></th>
	</tr>
	</thead><tbody>
	@foreach( $shippers as $shipper)
		<tr>
			
			<td>{{ $shipper->title }}</td>
			<td>{{ $shipper->phone }}</td>
			<td><a href="{{ url('/shipper',$shipper->id) }}" class="btn btn-primary"><span class="fa fa-eye"></span> View</a></td>
			<td><a href="{{ url('/shipper',$shipper->id) }}/edit" class="btn btn-primary"><span class="fa fa-pencil"></span> Edit</a></td>
			<td>
				<form action="{{ url('/shipper', $shipper->id) }}" method="post">
					@csrf
					@method('DELETE')

					<button class="btn btn-danger" onclick="return tocheck()"><span class="fa fa-trash"></span> Delete</button>
				</form>
			</td>
		</tr>
	@endforeach
	
</tbody></table>
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

<script type="text/javascript">
	$(document).ready(function(){
		$('#dtable').DataTable();
	});
</script>
@endsection




