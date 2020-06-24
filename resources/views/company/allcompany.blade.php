@extends('layouts.print')

@section('content')

<h1>All Customer List</h1>


<table class = 'table table-bordered table-hover'>
<thead>
	<th>Customer Title</th>
	<th>Address</th>
	<th>Cell No</th>
	<th>Office No</th>
	<th>Fax No</th>
	<th>Email</th>
	<th>NTN</th>
	<th>Territory</th>
</thead>
<tbody>
	@foreach($allcustomer as $customer)
	<tr>
		<td>{{ $customer->title }}</td>
		<td>{{ $customer->address }}</td>
		<td>{{ $customer->cellno }}</td>
		<td>{{ $customer->officeno }}</td>
		<td>{{ $customer->faxno }}</td>
		<td>{{ $customer->email }}</td>
		<td>{{ $customer->ntn }}</td>
		<td>{{ $customer->territory->title }}</td>
	</tr>
	@endforeach
</tbody>
</table>

@endsection