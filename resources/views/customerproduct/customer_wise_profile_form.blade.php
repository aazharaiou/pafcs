@extends('layouts.app')

@section('content')

<h1>Customer Wise Products Profile</h1>


<form action="{{ url('/cppf') }}" method= "post" target="_blank">
	@csrf

		<div class="form-group">
			<label for="customer">Customer</label>
			<select name="customer_id" id="customer_id" class="form-control">
				@foreach($customers as $customer)
					<option value="{{ $customer->id }}">{{ $customer->title }}</option>
				@endforeach
			</select>
		</div>
		<button class="btn btn-lg btn-primary">Submit</button>

</form>

@endsection