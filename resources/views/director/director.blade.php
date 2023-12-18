@extends('layouts.app')

@section('content')
<header class="header" id="section-to-print">
    <nav class="navbar navbar-expand-md navbar-light bg-white">
    <img width="70" height="70" class="float-start me-3" src="{{ asset('images/ujap_logo.jpg') }}"/>
        <div class="end-0">
            Universidad Jose Antonio Paez
            <br>
            Dirección de Trabajos de Grado y Pasantias
        </div>
    </nav>
</header>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <span class="fs-4 m-0 fw-bold">{{ __('Tesis por aprobar') }}
                        <button type="button" class="btn btn-primary float-end" onclick="window.print()" >
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </span>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="row px-3">
                            <table class="table table-condensed table-striped table-bordered table-responsive" id="section-to-print">
                                <thead>
                                    <tr>
                                        <th>Periodo</th> 
                                        <th>Titulo</th>
                                        <th>Autores</th>
                                        <th>Cedula</th>
                                        <th>Estado</th>  
                                        <th>Acciones</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($directors as $tesis)
                                    <tr class="align-middle">
                                        <td>{{ $tesis->period }}</td>
                                        <td>{{ $tesis->title }}</td>
                                        <td>{{ $tesis->user->name }} <br> {{ $tesis->partner }}</td>
                                        <td>{{ $tesis->user->id_card }}</td>
                                        <td>{{ $tesis->status_public }}</td>
                                        <td>
                                            <div class="text-center">
                                                <a class="px-1" data-bs-toggle="modal" href="#modalVisualizar-{{ $tesis->id }}">
                                                    <i class="fa-solid fa-eye fa-xl"></i>
                                                </a>
                                                <a class="px-1" data-bs-toggle="modal" href="#modalCalificar-{{ $tesis->id }}">
                                                    <i class="fa-solid fa-circle-check fa-xl"></i>
                                                </a>
                                            </div>

                                            <!-- Modal Visualizar -->
                                            <div class="modal fade" id="modalVisualizar-{{ $tesis->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Visualizar PDF</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe width="100%" height="500px" src="{{asset('trabajos/'.$tesis->filename)}}" frameborder="0"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Visualizar -->

                                            <!-- Modal Calificar -->
                                            <div class="modal fade" id="modalCalificar-{{ $tesis->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Calificar trabajo</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="formEditar" method="POST" action="{{ route('tesis.update',$tesis->id) }}" data-action="{{ route('user.update',$tesis->id) }}" enctype="multipart/form-data">
                                                            @csrf @method('patch')

                                                                <div class="row mb-3">
                                                                    <label for="status-selec" class="col-md-4 col-form-label text-md-end">Estado</label>
                                                                    <div class="col-md-6">
                                                                        <?php
                                                                        echo "<select class='form-select' name='status_public'>";
                                                                        $selected = "selected";
                                                                        $valor = $tesis->status_public;
                                                                            echo "<option value='Pendiente'" . ($valor=='Pendiente' ? $selected : '') . ">Pendiente</option>";
                                                                            echo "<option value='Publicado'" . ($valor=='Publicado' ? $selected : '') . ">Publicar</option>";
                                                                            echo "<option value='Rechazado'" . ($valor=='Rechazado' ? $selected : '') . ">Rechazar</option>";
                                                                        echo "</select>";
                                                                        ?>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">    
                                                                    <label for="comment-area" class="col-md-4 col-form-label text-md-end">Comentario</label>
                                                                    <div class="col-md-6">
                                                                        <textarea class="form-control" name="comment_director" id="commentTextarea" rows="3">{{ $tesis->comment_director }}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="date-area" class="col-md-4 col-form-label text-md-end">Fecha de presentación</label>
                                                                    <div class="col-md-6">
                                                                        <input class="form-control" type="date" name="date" id="commentTextarea" rows="3" value="{{ $tesis->date ??  old('date') }}"></input>
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-0">
                                                                    <div class="col-md-6 offset-md-4">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ __('Guardar') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Calificar -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $directors->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="section-to-print">
    <footer class="footer d-flex flex-wrap justify-content-between align-items-center pt-3 px-5 pb-4 mt-auto bg-white">
        <div class="col d-flex align-items-center">
            <span class="mb-3 mb-md-0">© 2022 Dirección de Computación, UJAP</span>
        </div>
    </footer>
</div>
@endsection
<style>
    .header {
        visibility: hidden;
        position: fixed;
        width: 100%;
        text-align: right;
        z-index: 1;
    }
    .footer {
        visibility: hidden;
        position: absolute;
        width: 100%;
        bottom: 0;
    }
    @media print {
        body * {
            visibility: hidden;
        }
        #section-to-print, #section-to-print * {
            visibility: visible;
        }
        #section-to-print {
            left: 0;
            top: 0;
        }
    }
</style>
