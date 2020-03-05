@extends('layouts.app')

@section('content')

<h1>Vendor Detail</h1>


<table class = 'table table-bordered'>
<tr>
	<td>Title</td> <td>{{ $vendor->title }}</td>
</tr>
<tr>
	<td>Contact Person</td>
	<td>{{ $vendor->contact_person }}</td>
</tr>
<tr>
	<td>Address</td> <td>{{ $vendor->address }}</td>
</tr>
<tr>
	<td>E-mail</td>
	<td>{{ $vendor->email }}</td>
</tr>
<tr>
	<td>Contact No</td>
	<td>{{ $vendor->phone }}</td>
</tr>
<tr>
	<td>Fax No</td>
	<td>{{ $vendor->fax }}</td>
</tr>
</table>

@endsection