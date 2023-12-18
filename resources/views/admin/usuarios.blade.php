@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <p class="fs-4 m-0 fw-bold">{{ __('Lista de usuarios') }}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalRegister">
                            {{ __('Registrar') }}
                        </button>                            
                    </p>
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (Auth::user()->role === "Administrador") <!-- Lista de usuarios -->
                        <!-- Modal registro -->
                        <div class="modal fade" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                        @csrf

                                            
                                            <div class="row mb-3">
                                                <label for="picture_file" class="col-md-4 col-form-label text-md-end">{{ __('Foto de perfil') }}</label>

                                                <div class="col-md-6">
                                                    <input id="picture_file" type="file" class="form-control @error('name') is-invalid @enderror" name="picture_file" value="{{ old('name') }}" accept="image/*">

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            

                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="id_card" class="col-md-4 col-form-label text-md-end">{{ __('Cedula') }}</label>

                                                <div class="col-md-6">
                                                    <input id="id_card" type="text" class="form-control @error('id_card') is-invalid @enderror" name="id_card" value="{{ old('id_card') }}" required autocomplete="id-card">

                                                    @error('id_card')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  required autocomplete="new-password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="role-selec" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>
                                                <div class="col-md-6">
                                                    <select class="form-select" name="role" required>
                                                        <option value="Administrador">Administrador</option>
                                                        <option value="Director">Director</option>
                                                        <option value="Docente">Docente</option>
                                                        <option value="Estudiante">Estudiante</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="carrer-selec" class="col-md-4 col-form-label text-md-end">{{ __('Escuela') }}</label>
                                                <div class="col-md-6">
                                                    <select class="form-select" name="career">
                                                        <option value=NULL>Ninguna</option>
                                                        <option value="Computación">Computación</option>
                                                        <option value="Industrial">Industrial</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Registrar') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>    
                                </div>
                            </div>
                        </div>

                        <div class="row px-3">
                            <table class="table table-condensed table-striped table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th class="col">Foto</th> 
                                        <th>Nombre</th>
                                        <th>Rol</th>
                                        <th>Correo</th>  
                                        <th>Acciones</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr class="align-middle">
                                        <td><img width="65" height="65" class="img-thumbnail" src="{{ asset('images/profile_pictures/'.$user->picture) }}"/></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <ul class="navbar-nav ms-auto">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        Opciones
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                        <a class="dropdown-item" data-bs-toggle="modal" href="#modalVisualizar-{{ $user->id }}">
                                                            Ver registro
                                                        </a>
                                                        <a class="dropdown-item" data-bs-toggle="modal" href="#modalEditar-{{ $user->id }}" data-bs-id="{{ $user->id }}">
                                                            Editar
                                                        </a>
                                                        <a class="dropdown-item" data-bs-toggle="modal" href="#modalEliminar-{{ $user->id }}" data-bs-id="{{ $user->id }}">
                                                            Eliminar
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>

                                            <!-- Modal Visualizar -->
                                            <div class="modal fade" id="modalVisualizar-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Visualizar registro</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img width="130" height="130" class="img-thumbnail float-start me-3" src="{{ asset('images/profile_pictures/'.$user->picture) }}"/>
                                                            <h3>{{ $user->name }}</h3>
                                                            @if ($user->career === NULL)
                                                                <h3>{{ $user->role }}</h3>
                                                            @else
                                                                <h3>{{ $user->role }} de {{ $user->career }}</h3>
                                                            @endif
                                                            <h4>{{ $user->email }}</h4>
                                                            <h4>{{ $user->id_card }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Visualizar -->

                                            <!-- Modal Editar -->
                                            <div class="modal fade" id="modalEditar-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Editar registro</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="formEditar" method="POST" action="{{ route('user.update', $user->id) }}" data-action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                                                            @csrf @method('patch')

                                                                
                                                                <div class="row mb-3">
                                                                    <label for="picture_file" class="col-md-4 col-form-label text-md-end">{{ __('Foto de perfil') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="picture_file" type="file" class="form-control @error('name') is-invalid @enderror" name="picture_file" value="{{ old('picture_file') }}" accept="image/*">

                                                                        @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                

                                                                <div class="row mb-3">
                                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ??  old('name') }}" required autocomplete="name" autofocus>

                                                                        @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="id_card" class="col-md-4 col-form-label text-md-end">{{ __('Cedula') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="id_card" type="text" class="form-control @error('id_card') is-invalid @enderror" name="id_card" value="{{ $user->id_card ?? old('id_card') }}" required autocomplete="id-card">

                                                                        @error('id_card')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" required autocomplete="email">

                                                                        @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $user->password ?? old('password') }}" autocomplete="new-password">

                                                                        @error('password')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="row mb-3">
                                                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ $user->password ?? old('password') }}" autocomplete="new-password">
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="role-selec" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>
                                                                    <div class="col-md-6">
                                                                    <?php
                                                                        echo "<select class='form-select' name='role'>";    
                                                                        $selected = "selected";
                                                                        $valor = $user->role;
                                                                            echo "<option value='Administrador'" . ($valor=="Administrador" ? $selected : '') . ">Administrador</option>')";
                                                                            echo "<option value='Director'" . ($valor=="Director" ? $selected : '') . ">Director</option>";
                                                                            echo "<option value='Docente'" . ($valor=="Docente" ? $selected : '') . ">Docente</option>";
                                                                            echo "<option value='Estudiante'" . ($valor=="Estudiante" ? $selected : '') . ">Estudiante</option>";
                                                                        echo "</select>";
                                                                    ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label for="carrer-selec" class="col-md-4 col-form-label text-md-end">{{ __('Escuela') }}</label>
                                                                    <div class="col-md-6">
                                                                    <?php
                                                                        echo "<select class='form-select' name='career'>";
                                                                        $selected = "selected";
                                                                        $valor = $user->career;
                                                                            echo "<option value=NULL" . ($valor==NULL ? $selected : '') . ">Ninguna</option>";
                                                                            echo "<option value='Computación'" . ($valor=="Computación" ? $selected : '') . ">Computación</option>";
                                                                            echo "<option value='Industrial'" . ($valor=="Industrial" ? $selected : '') . ">Industrial</option>";
                                                                        echo "</select>";
                                                                    ?>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-0">
                                                                    <div class="col-md-6 offset-md-4">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ __('Guardar cambios') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Editar -->

                                            <!-- Modal Eliminar -->
                                            <div class="modal fade" id="modalEliminar-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Está seguro que desea eliminar a {{ $user->name }}?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form id="formEliminar" method="post" action="{{ route('user.destroy',$user->id) }}" data-action="{{ route('user.destroy',$user->id) }}">
                                                                @method('delete') @csrf
                                                                <input  type="submit" class="btn btn-danger" value="Eliminar">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Eliminar -->
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    @else
                        {{ __('¡Estás conectado!') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


 

<script>
    /*const deleteModal = document.getElementById('modalEliminar')
    deleteModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const id = button.getAttribute('id')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        action = $('#formEliminar').attr('data-action').slice(0,-1) + id;
        console.log(id)
        $('#formEliminar').attr('action', action)
    })*/
</script>
@endsection
