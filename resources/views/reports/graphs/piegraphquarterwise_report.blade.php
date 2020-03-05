@extends('layouts.app')
@section('content')


<h1>Pie Graph Quarterly Wise Products Sale</h1>
<form action="" method="post">
	@csrf
	<div class="row">
		<div class="form-group col-md-4">
	<label for="">Year</label>
	@php
			$years = \App\Sale::selectRaw('YEAR(created_at) year')
							->groupBy('year')
							->get();
	@endphp

	<select name="year" id="year" required="required" class="form-control">
		@foreach($years as $year)
		<option value="{{ $year->year }}">{{ $year->year }}</option>
		@endforeach
	</select>
	</div>
		<div class="form-group col-md-4">
			<label for="">Quater</label>
			<select name="quarter" id="quarter" class="form-control" required="required">
				<option value="1">1 Quarter</option>
				<option value="2">2 Quarter</option>
				<option value="3">3 Quarter</option>
				<option value="4">4 Quarter</option>
			</select>
			
		</div>
		<div class="form-group col-md-4" >
			<label for="">Topx</label>
			<input type="number" name="topx" class="form-control" required="required" min="1" value="10">
		</div>
	</div>
	<button class="btn btn-primary">Submit</button>
</form>
@if(count($sales) > 0)

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Pie Graph Quarterly Wise Products Sale"
	},
	data: [{
		type: "pie", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",
		indexLabel: "{label} Qty. {y}      #percent%",
		dataPoints: [

					@foreach($sales  as $sale)
						{label:"{{ $sale->code }}",  y:{{ $sale->sumquantity }} },
					@endforeach
					
					]
		}]
});
chart.render();

}
</script>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<div><br><br></div>
<table class="table" id="dttable">
	<thead>
		<tr>
			<th>Code</th>
			<th>Qty Sales</th>
		</tr>
	</thead>
	<tbody>
		@foreach($sales as $sale)
		<tr>
			<td>{{ $sale->code }}</td>
			<td>{{ $sale->sumquantity }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
	<div class="text-danger text-center">{{ 'No record found' }}</div>
	
@endif

<script type="text/javascript">
	$(document).ready(function(){

	$('#dttable').DataTable({
		dom: 'Bfrtip',
		buttons: [
        'excel',
        'copy'
        
    ]
	});

	});
</script>
@endsection