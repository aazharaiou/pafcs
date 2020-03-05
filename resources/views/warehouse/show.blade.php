@extends('layouts.app')

@section('content')

<h1>Warehouse Detail</h1>


<table class = 'table table-bordered'>
<tr>
	<td>Title</td> <td>{{ $warehouse->title }}</td>
</tr>
<tr>
	<td>Manager</td> <td>{{ $warehouse->manager }}</td>
</tr>
<tr>
	<td>Address</td> <td>{{ $warehouse->address }}</td>
</tr>
<tr>
	<td>Contact No</td> <td>{{ $warehouse->phone }}</td>
</tr>
<tr>
	<td>E-mail</td> <td>{{ $warehouse->email }}</td>
</tr>
</table>

@endsection