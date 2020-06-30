@extends('layouts.print')

@section('content')

<h1>All Companies List</h1>


<table class = 'table table-bordered table-hover'>
<thead>
	<th>Company Title</th>
	<th>Logo</th>
	<th>Header</th>
	<th>Footer</th>
</thead>
<tbody>
	@foreach($allcompanies as $company)
	<tr>
		<td>{{ $company->title }}</td>
		<td><img src="{{ url('/upload/companies',$company->logo) }}"  width="150px"></td>
		<td><img src="{{ url('/upload/companies',$company->header) }}" width="150px"></td>
		<td><img src="{{ url('/upload/companies',$company->footer) }}"  width="150px"></td>
		
	</tr>
	@endforeach
</tbody>
</table>

@endsection