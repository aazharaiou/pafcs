@extends('layouts.app')

@section('content')

<h1>Warehouse Update</h1>
<div class="text-danger">* Mandatory Fields</div>

<form action="{{ url('/warehouse',$warehouse->id) }}" method="post">
	@csrf
	@method('PATCH')

	<div class="form-group">
	<label for="title">Title</label><span class="text-danger">*</span>
	<input type="text" name="title" value="{{ $warehouse->title }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('title') }}</span>
	
	<div class="form-group">
	<label for="manager">Manager</label><span class="text-danger">*</span>
	<input type="text" name="manager" value="{{ $warehouse->manager }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('title') }}</span>

	<div class="form-group">
	<label for="address">Address</label><span class="text-danger">*</span>
	<input type="text" name="address" value="{{ $warehouse->address }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('address') }}</span>

	<div class="form-group">
	<label for="contactno">Contact No</label><span class="text-danger">*</span>
	<input type="text" name="phone" value="{{ $warehouse->phone }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('phone') }}</span>

	<div class="form-group">
	<label for="email">E-mail</label>
	<input type="text" name="email" value="{{ $warehouse->email }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('email') }}</span>

	
	<input type="hidden" name="">
	<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">	
	<input type="submit" name="submit" value="Update" class="btn btn-success">

	{{-- <div class="text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
	</div> --}}
</form>

@endsection