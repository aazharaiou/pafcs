@extends('layouts.app')

@section('content')
<div class="col-md-12 text-right">
	<a href="{{ url('/territory') }}" class="btn btn-primary text-uppercase">Territory List </a>
</div>
<h1>Territory Detail</h1>

<table class="table table-bordered">
	<tr>
		<td>Title</td>
		<td>{{ $territory->title }}</td>
	</tr>
</table>
@endsection