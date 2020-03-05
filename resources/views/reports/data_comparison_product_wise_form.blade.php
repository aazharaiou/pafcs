@extends('layouts.app')
@section('content')

<h1>Data Comparision Product Wise</h1>
<form action="{{ url('reports/dcpw') }}" method="post" target="_blank">
	@csrf
	
	<div class="form-group col-md-6">
		<label for="">Year</label>
		<select name="year" id="year" class="form-control" required="required">
			@foreach($years as $year)
				<option value="{{ $year->year }}">{{ $year->year }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group col-md-6">
		<label for="">Quarter</label>
		<select name="quarter" id="quarter" class="form-control" required="required">
			@foreach($quarters as $quarter)
				<option value="{{ $quarter->quarter }}">{{ $quarter->quarter . ' Quarter' }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group col-md-6">
		<label for="">Territory</label>
		<select name="territory" id="territory" class="form-control" required="required">
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