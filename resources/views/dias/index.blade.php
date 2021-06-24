    
@extends('layouts.app')
@push('head-style')
    
@endpush
@section('content')
<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Días Especiales </h4>
                    <h6 class="card-subtitle">A continuación se desplegaran todos los días especiales del sistema </h6>
                    <hr>
                    <div class="col-lg-12 col-md-12 "">
                        <button type="button" class="btn bprimario cblanco btn-sm " onclick="window.location='{{ route('dias.create') }}'">
                            <i class="ti-plus"></i>
                            Nuevo
                        </button>
                    </div>
                    <hr>
                    @include('dias.table')    
                </div>
            </div>
        </div>
    </div>
@endsection