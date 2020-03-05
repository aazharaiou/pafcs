@extends('layouts.app')

@section('content')

<h1>Invoice Update</h1>
<div class="text-danger">* Mandatory Fields</div>

<form action="{{ url('/invoice',$invoice->id) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PATCH')

	<span class="text-danger">{{ $errors->first('podate') }}</span>
	
	<div class="form-group">
	<label for="pono">PO No</label><span class="text-danger">*</span>
	<input type="text" name="pono" value="{{ $invoice->pono }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('pono') }}</span>

	<div class="form-group">
		<label for="customer_id">Customer</label><span class="text-danger">*</span>
		<select name="customer_id" id="customer_id" class="form-control">
			<option value="">select customer</option>
			@foreach($customers as $customer)
			<option value="{{ $customer->id }}" {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
			@endforeach()
		</select>
	</div>

	<div class="form-group">
		<label for="remarks">Remarks</label>
		<input type="text" name="remarks" class="form-control" value="{{ $invoice->remarks }}">
	<span class="text-danger">{{ $errors->first('remarks') }}</span>
	</div>


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