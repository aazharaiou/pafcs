	
	<div class="form-group col-md-4">
	<label for="">Month</label>
	<select name="month" id="month" required="required" class="form-control">
		<option value=""></option>
		<option value="1">January</option>
		<option value="2">February</option>
		<option value="3">March</option>
		<option value="4">April</option>
		<option value="5">May</option>
		<option value="6">June</option>
		<option value="7">July</option>
		<option value="8">August</option>
		<option value="9">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
	</select>
	</div>
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