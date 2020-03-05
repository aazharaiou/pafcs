@extends('layouts.app')

@section('content')

<h1>Pending Order Update</h1>
<div class="text-danger">* Mandatory Fields</div>

<form action="{{ url('/pendingorder',$pendingorder->id) }}" method="post">
	@csrf
	@method('PATCH')

	<div class="form-group">
		<label for="customer">Customer</label><span class="text-danger">*</span>
		<select name="customer_id" id="customer_id" class="form-control" autofocus="autofocus">
			<option value="">select customer</option>
			@foreach($customers as $customer)
				<option value="{{ $customer->id }}" {{ $pendingorder->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->title }}</option>
			@endforeach
		</select>
	</div>
	<span class="text-danger">{{ $errors->first('customer_id') }}</span>
	
	<div class="form-group">
	<label for="pono">PO No</label><span class="text-danger">*</span>
	<input type="text" name="pono" value="{{ $pendingorder->pono }}" class="form-control" >
	</div>
	<span class="text-danger">{{ $errors->first('pono') }}</span>

	<div class="form-group">
	<label for="podate">PO Date</label><span class="text-danger">*</span>
	<input type="date" name="podate" value="{{ $pendingorder->podate }}" class="form-control" autofocus="autofocus">
	</div>
	<span class="text-danger">{{ $errors->first('podate') }}</span>

	
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