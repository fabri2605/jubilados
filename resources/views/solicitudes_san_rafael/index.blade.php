    
@extends('layouts.app')
@push('head-style')
@endpush
@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="container-fluid">
                    @include('solicitudes.modal')
                    @include('solicitudes.table')    
                </div>
            </div>
        </div>
    </div>
@endsection
