@extends('layouts.app');
@section('content')

<form action="{{ url('/reports/pwledgerlist') }}" method="post" target="_blank">
	@csrf
<h1>Product Wise Ledger</h1>	
<div class="form-group">
<label for="product_id">Product</label>
<select name="product_id" id="product_id" class="form-control">
	<option value="">Please Select</option>
	@foreach($products as $product)
		<option value="{{ $product->id }}">{{ $product->code }} - {{ $product->description }}</option>
	@endforeach
</select>
</div>

<button class="btn btn-primary" name="submit">Submit</button>
</form>
@endsection