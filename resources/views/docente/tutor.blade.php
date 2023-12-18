@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <p class="fs-4 m-0 fw-bold">{{ __('Tutoria') }}</p>
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
                                        <th>Estado</th>  
                                        <th>Acciones</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tutors as $tesis)
                                    <tr class="align-middle">
                                        <td>{{ $tesis->period }}</td>
                                        <td>{{ $tesis->title }}</td>
                                        <td>{{ $tesis->user->name }} <br> {{ $tesis->partner }}</td>
                                        <td>{{ $tesis->status_tutor }}</td>
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
                                                                            <select class="form-select" name="status_tutor">
                                                                                <option value="Pendiente">Pendiente</option>
                                                                                <option value="Aprobado">Aprobado</option>
                                                                                <option value="Rechazado">Rechazado</option>
                                                                            </select>
                                                                        </div>
                                                                    
                                                                </div>
                                                                <div class="row mb-3">
                                                                    
                                                                        <label for="comment-area" class="col-md-4 col-form-label text-md-end">Comentario</label>
                                                                        <div class="col-md-6">
                                                                            <textarea class="form-control" name="comment_tutor" id="commentTextarea" rows="3"></textarea>
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
                                            <!-- Modal Editar -->
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            {{ $tutors->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar este registro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formEliminar" method="post" action="{{ route('user.destroy',1) }}" data-action="{{ route('user.destroy',1) }}">
                    @method('delete') @csrf
                    <input  type="submit" class="btn btn-danger" value="Eliminar">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Eliminar --> 

<script>

const deleteModal = document.getElementById('modalEliminar')
deleteModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const id = button.getAttribute('id')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    action = $('#formEliminar').attr('data-action').slice(0,-1) + id;

    $('#formEliminar').attr('action', action)
})

</script>
@endsection
