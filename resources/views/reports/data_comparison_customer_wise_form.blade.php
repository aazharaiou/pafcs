@extends('layouts.app')
@section('content')

<h1>Data Comparision Customer Wise</h1>
<form action="{{ url('reports/dccw') }}" method="post" target="_blank">
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
		<label for="">Customer</label>
		<select name="customer" id="customer" class="form-control" required="required">
			<option value="all">All</option>
			@foreach($customers as $customer)
				<option value="{{ $customer->id }}">{{ $customer->title }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group col-md-6">
		
	<button class="btn btn-primary">Submit</button>
	</div>
	
</form>
@endsection