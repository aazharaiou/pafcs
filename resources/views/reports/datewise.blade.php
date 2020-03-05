@extends('layouts.app')
@section('content')
<h1>Date Wise</h1>

<table class="table table-hover table-bordered">
	<thead>
		<th>Invoice No</th>
	</thead>
	<tbody>
		@foreach($datas as $data)
		<tr>
			<td>
				{{ $data->invoiceno }}
			</td>
		</tr>
		
	
@endforeach	
	</tbody>

</table>
@endsection