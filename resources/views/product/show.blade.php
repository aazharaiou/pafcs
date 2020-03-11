@extends('layouts.app')

@section('content')

<h1>Product Detail</h1>


<table class = 'table'>

<tr>
	<td>Part No</td> <td>{{ $product->partno }}</td>
</tr>
<tr>
	<td>Noun</td> <td>{{ $product->noun }}</td>
</tr>
<tr>
	<td>UI</td> <td>{{ $product->ui }}</td>
</tr>

</table>

@endsection