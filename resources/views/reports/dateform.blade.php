@extends('layouts.app')
@section('content')
<form method="post" action="{{ url('/reports/a') }}" target="_blank">
	@csrf
	
	<div class="form-group">
		<label for="datefrom">Date From</label>
		<input type="date" name="datefrom" class="form-control" required >
	</div>
	<div class="form-group">
		<label for="dateto">Date To</label>
		<input type="date" name="dateto" class="form-control" required>	
	</div>
	<button class="btn btn-primary" name="submit">Submit</button>
	
</form>
@endsection