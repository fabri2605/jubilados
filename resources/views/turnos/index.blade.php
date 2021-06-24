    
@extends('layouts.app')
@push('head-style')
    <link rel="stylesheet" href="/css/datepicker.css">
@endpush
@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="container-fluid">
                    @include('turnos.table')    
                </div>
            </div>
        </div>
    </div>
@endsection
