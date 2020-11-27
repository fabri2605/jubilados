    
@extends('layouts.app')
@push('head-style')
@endpush
@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="container-fluid">
                    @include('enviados.modal')
                    @include('enviados.table')    
                </div>
            </div>
        </div>
    </div>
@endsection
