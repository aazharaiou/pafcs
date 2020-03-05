@extends('layouts.app')

@section('content')

<h1>Shipper Update</h1>
<div class="text-danger">* Mandatory Fields</div>

<form action="{{ url('/shipper',$shipper->id) }}" method="post">
	@csrf
	@method('PATCH')

	<div class="form-group">
	<label for="title">Title</label><span class="text-danger">*</span>
	<input type="text" name="title" value="{{ $shipper->title }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('title') }}</span>
	
	<div class="form-group">
	<label for="phne">Contact No</label><span class="text-danger">*</span>
	<input type="text" name="phone" value="{{ $shipper->phone }}" class="form-control" autofocus="autofocus">
	</div>

	<span class="text-danger">{{ $errors->first('phone') }}</span>

	
	<input type="hidden" name="">

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