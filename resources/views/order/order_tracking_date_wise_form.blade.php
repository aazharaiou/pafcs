@extends('layouts.app')
@section('content')
<h1>Date Wise Orders</h1>
{{-- <form action="{{ url('reports/c_wise_p_sale') }}" method="post" target="_blank"> --}}
	<form method="post" target="_blank">
	@csrf
	@include('layouts/partials/datefrom_dateto')
	<div class="form-group col-md-6">
		
		<button class="btn btn-primary">Submit</button>
	</div>
	
		
	
</form>
@endsection