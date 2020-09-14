@extends('layouts.app')

@section('content')

<h1>Buyer</h1>
<div class="text-danger">* Mandatory Filelds</div>
	<form action="{{ url('/buyer') }}" method="post" autocomplete="off">
		@csrf
		<div class="form-group">
			<label for="">Title</label><span class="text-danger">*</span>
			<input type="text" name="title" id="title" class="form-control " autofocus="autofocus" value="{{ old('title') }}">
		</div>

		<span class="text-danger">{{ $errors->first('title') }}</span>

		<div class="form-group">
			<label for="contact_person">Contact Person</label><span class="text-danger">*</span>
			<input type="text" name="contact_person" id="contact_person" class="form-control " autofocus="autofocus" value="{{ old('contact_person') }}">
		</div>
		<span class="text-danger">{{ $errors->first('contact_person') }}</span>

		<div class="form-group">
			<label for="">Address</label> 
			<input type="text" name="address" id="address" class="form-control " value ="{{ old('address') }}">
		</div>
		<span class="text-danger">{{ $errors->first('address') }}</span>

		<div class="form-group">
			<label for="phone">Contact No</label>
			<input type="text" name="phone" id="phone" class="form-control " autofocus="autofocus" value="{{ old('phone') }}">
		</div>
		<span class="text-danger">{{ $errors->first('phone') }}</span>

		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="text" name="email" id="email" class="form-control " autofocus="autofocus" value="{{ old('email') }}">
		</div>
		<span class="text-danger">{{ $errors->first('email') }}</span>

		

		<div class="form-group">
			<label for="fax">Fax No</label>
			<input type="text" name="fax" id="fax" class="form-control " value="{{ old('fax') }}">
		</div>
		<span class="text-danger">{{ $errors->first('fax') }}</span>

		<div class="form-group">
			<label for="Perent">Parent</label>
			
			<select name="parent" id="parent" class="form-control ">	
					<option value="">Please select</option>
			@foreach ($buyers as $buyer)
				<option value="{{ $buyer->id }}" {{ old('parent') == $buyer->id ? 'selected' : '' }}>{{ $buyer->title }}</option>
		@endforeach
			</select>
		</div>
		<span class="text-danger">{{ $errors->first('parent') }}</span>

		<input type="submit" name="Create" class="btn btn-primary">
	</form>

@endsection()
