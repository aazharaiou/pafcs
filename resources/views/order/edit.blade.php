@extends('layouts.app')

@section('content')

<h1>Order Update</h1>
<div class="text-danger">* Mandatory Fields</div>

<form action="{{ url('/order',$order->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PATCH')

	<div class="form-group">
	<label for="title">PO Date</label><span class="text-danger">*</span>
	<input type="date" name="podate" value="{{ $order->podate }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('podate') }}</span>
	
	<div class="form-group">
	<label for="pono">PO No</label><span class="text-danger">*</span>
	<input type="text" name="pono" value="{{ $order->pono }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('pono') }}</span>

	<div class="form-group">
		<label for="customer_id">Customer</label>
		<select name="customer_id" id="customer_id" class="form-control">
			<option value="">select customer</option>
			@foreach($customers as $customer)
			<option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
			@endforeach()
		</select>
	</div>

	<div class="form-group">
		<label for="poimage">PO Image</label>
		<input type="file" name="poimage" class="form-control" value="{{ $order->poimage }}">
	<span class="text-danger">{{ $errors->first('poimage') }}</span>
	</div>


	<input type="hidden" name="hidden_image" value="{{ $order->poimage }}">

	<input type="submit" name="submit" value="Update" class="btn btn-primary btn-lg">
	

	{{-- <div class="text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
	</div> --}}
</form>

@endsection