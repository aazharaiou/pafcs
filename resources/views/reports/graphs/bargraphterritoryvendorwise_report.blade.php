@extends('layouts.app')
@section('content')


<h1>Bar Graph Territory/Vendor Wise Products Sale</h1>
<form action="" method="post">
	@csrf
	@include('layouts.partials.datefrom_dateto')
<div class="row">
		<div class="form-group col-md-4">
			<label for="">Territory</label>
				@php
						$territories = \App\Territory::all();
				@endphp

				<select name="territory" id="territory" class="form-control">
					<option value="all">All</option>
					@foreach($territories as $territory)
					<option value="{{ $territory->id }}">{{ $territory->title }}</option>
					@endforeach
				</select>
		</div>

		<div class="form-group col-md-4">
			<label for="">Vendor</label>
				@php
						$vendors = \App\Vendor::all();
				@endphp

				<select name="vendor" id="vendor" class="form-control">
					<option value="all">All</option>
					@foreach($vendors as $vendor)
					<option value="{{ $vendor->id }}">{{ $vendor->title }}</option>
					@endforeach
				</select>
		</div>

		<div class="form-group col-md-4" >
				<label for="">Topx</label>
				<input type="number" name="topx" class="form-control" required="required" min="1" value="10">
		</div>
	</div>	

	<button class="btn btn-primary">Submit</button>
</form>
@if(!empty($sales))

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Bar Graph Territory/Vendor Wise Products Sale"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",
		dataPoints: [

					@foreach($sales  as $sale)
						{label:"{{ $sale->code }}",  y:{{ $sale->quantity }} },
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
			<td>{{ $sale->quantity }}</td>
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