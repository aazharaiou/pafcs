@extends('layouts.app')

@section('content')

<h1>Territory Update</h1>


<form action="{{ url('/territory',$territory->id) }}" method="post">
	@csrf
	@method('PATCH')
	<div class="form-group">
	<label for="title">Title</label>
	<input type="text" name="title" value="{{ $territory->title }}" class="form-control" autofocus="autofocus">
	</div>
	
	<input type="hidden" name="">

	<input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>

@endsection