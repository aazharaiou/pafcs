@extends('layouts.app')
@section('content')

<h1>Pie Graph Month Wise Products Sale</h1>
<form action="" method="post">
	@csrf
	<div class="row">
@include('layouts.partials.month_year')
	<div class="form-group col-md-4" >
		<label for="">Topx</label>
		<input type="number" name="topx" class="form-control" required="required" min="1" value="10">
	</div>
		</div>
	<button class="btn btn-primary">Submit</button>
</form>
@endsection