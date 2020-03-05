@extends('layouts.app')

@section('content')

<h1>Shipper Detail</h1>


<table class = 'table table-bordered'>
<tr>
	<td>Title</td> <td>{{ $shipper->title }}</td>
</tr>
<tr>
	<td>Contact No</td> <td>{{ $shipper->phone }}</td>
</tr>

</table>

@endsection