@extends('layouts.app')
@section('content')

<h1>Bar Graph Quarterly Wise Products Sale</h1>
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
@endsection