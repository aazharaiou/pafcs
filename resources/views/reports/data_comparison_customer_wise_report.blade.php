@extends('layouts.app')
@section('content')

@if(count($sales) > 0)
	<h4 class="text-danger text-center">{{ "Data Comparision of Customer wise products sale for the year of ". $year . " and " . $quarter . " quarter " }}</h4>
	
	<table class="table table-bordered table-hover" id="dtable">
		<caption style="caption-side:top" class="text-danger text-center"></caption>
		<thead>
			<tr>
				<th>Customer</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			@foreach($sales as $sale)
			<tr>
				<td>{{ $sale->title }}</td>
				<td align="right">{{ number_format($sale->quantity,2) }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		<div class="text-danger text-center"><h1>{{ "No record found" }}</h1></div>
	@endif

	<script type="text/javascript">
		$(document).ready(function(){
			$("#dtable").DataTable({

				'order': [[1,'DESC']],
				dom: 'Bfrtip',
		buttons: [
        'excel',
        'copy'
        
    ]
			});
		});
	</script>
@endsection