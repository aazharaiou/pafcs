@extends('layouts.app')
@section('content')

<h1>Sale Price Product Wise</h1>
<h1>Product Code: {{ $productcode->code }}</h1>
    @if(count($saleprices) > 0)
    
    <table class="table table-hover">
        
        <thead>
            <tr>
                <th>Date</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
                @php
                    $amount = 0;
                @endphp
                @foreach($saleprices as $saleprice)
                <tr>
                <td>{{ date_format(date_create($saleprice->created_at),'d-m-Y') }}</td>
                <td>{{ $saleprice->quantity }}</td>
                <td>{{ $saleprice->unit_price }}</td>
                <td>
                    @php
						$amount = $saleprice->quantity * $saleprice->unit_price;
					@endphp
					
					{{ $amount }}
                </td>
                </tr>
                @endforeach()
            
        </tbody>
        
    </table>
    
    @else
	<div class="text-danger text-center">{{ "No record found" }}</div>
@endif
     
@endsection