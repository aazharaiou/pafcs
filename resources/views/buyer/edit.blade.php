@extends('layouts.app')

@section('content')

<h1>Buyer Update</h1>


<form action="{{ url('/buyer',$buyer->id) }}" method="post">
	@csrf
	@method('PATCH')
	
	<div class="form-group">
	<label for="">Buyer Title</label>
	<input type="text" name="title" value="{{ $buyer->title }}" class="form-control" autofocus="autofocus">
	</div>

	<div class="form-group">
			<label for="contact_person">Contact Person</label><span class="text-danger">*</span>
			<input type="text" name="contact_person" id="contact_person" class="form-control text-uppercase" autofocus="autofocus" value="{{ $buyer->contact_person }}">
		</div>
		<span class="text-danger">{{ $errors->first('contact_person') }}</span>

		<div class="form-group">
			<label for="">Address</label>
			<input type="text" name="address" id="address" class="form-control text-uppercase" value ="{{ $buyer->address }}">
		</div>
		<span class="text-danger">{{ $errors->first('address') }}</span>

		<div class="form-group">
			<label for="contact">Contact No</label>
			<input type="text" name="phone" id="phone" class="form-control text-uppercase" autofocus="autofocus" value="{{ $buyer->phone}}">
		</div>
		<span class="text-danger">{{ $errors->first('phone') }}</span>

		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="text" name="email" id="email" class="form-control text-uppercase" autofocus="autofocus" value="{{ $buyer->email }}">
		</div>
		<span class="text-danger">{{ $errors->first('email') }}</span>

		

		<div class="form-group">
			<label for="fax">Fax No</label>
			<input type="text" name="fax" id="fax" class="form-control text-uppercase" autofocus="autofocus" value="{{ $buyer->fax }}">
		</div>
		<span class="text-danger">{{ $errors->first('fax') }}</span>

		<div class="form-group">
		<label for="parent">Parent</label><span class="text-danger">*</span>
		<select name="parent" id="parent" class="form-control" autofocus="autofocus">
		<option value="">select parent</option>
		@foreach ($parents as $parent)
			<option value="{{ $parent->id }}" {{ $buyer->id == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
		@endforeach
		</select>
	</div>


	<input type="hidden" name="">

	<input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>

@endsection