@extends('layouts.app')

@section('content')

<h1>Buyer Detail</h1>


<table class = 'table table-bordered'>
<tr>
	<td>Title</td> <td>{{ $buyer->title }}</td>
</tr>
<tr>
	<td>Contact Person</td>
	<td>{{ $buyer->contact_person }}</td>
</tr>
<tr>
	<td>Address</td> <td>{{ $buyer->address }}</td>
</tr>
<tr>
	<td>E-mail</td>
	<td>{{ $buyer->email }}</td>
</tr>
<tr>
	<td>Contact No</td>
	<td>{{ $buyer->phone }}</td>
</tr>
<tr>
	<td>Fax No</td>
	<td>{{ $buyer->fax }}</td>
</tr>
<tr>
	<td>Parent</td>
	<td>{{ $buyer->parent_company->title ?? ' ' }}</td>
</tr>
</table>

@endsection