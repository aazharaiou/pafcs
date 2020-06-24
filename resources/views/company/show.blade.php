@extends('layouts.app')

@section('content')

<h1>Customer Detail</h1>


<table class = 'table table-bordered'>
<tr>
	<td>Title</td> <td>{{ strtoupper($customer->title) }}</td>
</tr>
<tr>
	<td>Territory</td> <td>{{ $customer->territory->title }}</td>
</tr>
<tr>
	<td>Address</td> <td>{{ $customer->address }}</td>
</tr>
<tr>
	<td>Cell No</td> <td>{{ $customer->cellno }}</td>
</tr>
<tr>
	<td>Office No</td> <td>{{ $customer->officeno }}</td>
</tr>
<tr>
	<td>Fax No</td> <td>{{ $customer->faxno }}</td>
</tr>
<tr>
	<td>E-mail</td> <td>{{ $customer->email }}</td>
</tr>
<tr>
	<td>NTN No</td> <td>{{ $customer->ntn }}</td>
</tr>
</table>

@endsection