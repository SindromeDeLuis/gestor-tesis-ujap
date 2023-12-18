@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Cronograma de presentaciones de Trabajos de Grado y Pasantia') }}
                </div>
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <calendar-component :teses="{{ $public_teses }}" :students="{{ $users }}"></calendar-component>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .modal-container {
        width: 35% !important;
    }
</style>
