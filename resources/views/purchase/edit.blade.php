@extends('layouts.app')

@section('content')

<h1>Purchase Update</h1>


<form action="{{ url('/purchase',$purchase->id) }}" method="post">
	@csrf
	@method('PATCH')
	<div class="form-group">
	<label for="title">Invoice No</label>
	<input type="text" name="invoiceno" value="{{ $purchase->invoiceno }}" class="form-control" autofocus="autofocus">
	</div>
	<div class="form-group">
	<label for="title">Date</label>
	<input type="date" name="purchasedate" value="{{ date_format(date_create($purchase->purchasedate),'Y-m-d') }}" class="form-control" autofocus="autofocus">
	</div>

	<div class="form-group">
		<label for="vendorid">Vendor</label>
		<select name="vendor_id" id="vendor_id" class="form-control">
			@foreach($vendors as $vendor)
			<option value="{{ $vendor->id }}">{{ $vendor->title }}</option>
			@endforeach
		</select>
	</div>
	
	<input type="hidden" name="">

	<input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>

@endsection