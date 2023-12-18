@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <p class="fs-4 m-0 fw-bold">{{ __('Jurado') }}</p>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="row px-3">
                            <table class="table table-condensed table-striped table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>Periodo</th> 
                                        <th>Titulo</th>
                                        <th>Autores</th>
                                        <th>Cedula</th>
                                        <th>Estado</th>  
                                        <th></th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($juries as $tesis)
                                    <tr class="align-middle">
                                        <td>{{ $tesis->period }}</td>
                                        <td>{{ $tesis->title }}</td>
                                        <td>{{ $tesis->user->name }} <br> {{ $tesis->partner }}</td>
                                        <td>{{ $tesis->user->id_card }}</td>
                                        <td>{{ $tesis->status_jury }}</td>
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
                                                                    
                                                                        <label for="status-selec" class="col-md-4 col-form-label text-md-end">Estatus</label>
                                                                        <div class="col-md-6">
                                                                            <select class="form-select" name="status_jury">
                                                                                <option value="Pendiente">Pendiente</option>
                                                                                <option value="Aprobado">Aprobado</option>
                                                                                <option value="Rechazado">Rechazado</option>
                                                                            </select>
                                                                        </div>
                                                                    
                                                                </div>
                                                                <div class="row mb-3">
                                                                    
                                                                        <label for="comment-area" class="col-md-4 col-form-label text-md-end">Comentario</label>
                                                                        <div class="col-md-6">
                                                                            <textarea class="form-control" name="comment_jury" id="commentTextarea" rows="3"></textarea>
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
                            {{ $juries->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
