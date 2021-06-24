@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Oficina</h4>
                <h6 class="card-subtitle">Complete todos los datos para registrar una oficina</h6>
            </div>
            <hr class="m-t-0">
            <form class="form-horizontal striped-rows b-form" action="{{ route('oficina.store') }}" method="POST">
                @include('oficina.form')
                <hr>
                <div class="card-body">
                    <div class="form-group m-b-0 text-right">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Guardar</button>
                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="window.location='{{ route('oficina.index') }}'">Volver</button>
                    </div>
                </div>
            </form>
         </div>
</div>
</div>
@endsection
                