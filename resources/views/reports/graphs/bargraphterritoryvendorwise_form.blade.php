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
@endsection