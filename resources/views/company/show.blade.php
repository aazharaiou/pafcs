@extends('layouts.app')

@section('content')

<h1>Company Detail</h1>


<table class = 'table table-bordered'>
<tr>
	<td>Title</td> <td>{{ strtoupper($company->title) }}</td>
</tr>

<tr>
	<td>Logo</td> <td><img src="{{ url('/upload/orders',$company->logo) }}" height="200px"></td>
</tr>
<tr>
	<td>Header</td> <td><img src="{{ url('/upload/orders',$company->header) }}" height="200px"> </td>
</tr>
<tr>
	<td>Footer</td> <td><img src="{{ url('/upload/orders',$company->footer) }}" height="200px"></td>
</tr>
</table>

@endsection