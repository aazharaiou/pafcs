@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">PAF Contractor System</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome
                    <br>
                    <br>
                    @if(!empty($message))
                    <div class="alert alert-danger text-center"> {{ $message }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
