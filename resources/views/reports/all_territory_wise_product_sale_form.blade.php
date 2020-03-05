@extends('layouts.app')
@section('content')

<h1>Territory Wise Product Sale</h1>
<form action="{{ url('reports/all_territory_wise_p_sale') }}" method="post" target="_blank">
	@csrf
	
	@include('layouts/partials/datefrom_dateto')
	
	<div class="form-group col-md-6">
		<label for="territory">Territory</label>
		<select name="territory" id="territory" class="form-control">
			<option value="all">All</option>
			@foreach($territories as $territory)
				<option value="{{ $territory->id }}">{{ $territory->title }}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group col-md-6">
		
	<button class="btn btn-primary">Submit</button>
	</div>
	
</form>
@endsection