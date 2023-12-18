@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar Tomo I') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!--<div class="row mb-3 mx-5">
                        <form method="POST" action="{{ route('tesis.store') }}" enctype="multipart/form-data" class="dropzone" id="upload-form" files="true">@csrf</form>
                    </div>-->
                    <form method="POST" action="{{ route('tesis.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Nombre del trabajo') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="period" class="col-md-4 col-form-label text-md-end">{{ __('Periodo') }}</label>

                            <div class="col-md-6">
                                <input id="period" type="text" class="form-control @error('id_card') is-invalid @enderror" name="period" required autocomplete="period">

                                @error('id_card')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="partner-selec" class="col-md-4 col-form-label text-md-end">{{ __('Compañero') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="partner" id="studentID">
                                    <option selected>Seleccionar</option>
                                    @foreach($students as $student)
                                                <option value="{{ $student->name }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tutor-selec" class="col-md-4 col-form-label text-md-end">{{ __('Tutor') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="tutor" id="tutorID" onchange="updateJury()">
                                    <option value=NULL>Seleccionar</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jury-selec" class="col-md-4 col-form-label text-md-end" >{{ __('Jurado') }}</label>

                            <div class="col-md-6">
                                <select multiple class="form-select" name="jury[]" id="juradoID" onchange="selectJury()">
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->name }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Tipo de trabajo') }}</label>

                            <div class="col-md-6 mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="TG">
                                    <label class="form-check-label" for="flexRadioDefault1">Trabajo de Grado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value="PS">
                                    <label class="form-check-label" for="flexRadioDefault2">Pasantia</label>
                                </div>
                            </p></div>
                        </div>
                        
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="file" accept=".pdf">
                            </div>
                        </div>

                        <div class="row mb-0 justify-content-center">
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
</div>

<script>

    function updateJury() {
        const tutorSelect = document.getElementById('tutorID');
        const juradoSelect = document.getElementById('juradoID');
        const index = tutorSelect.selectedIndex;

        Array.from(juradoSelect.options).forEach((select, i) => select.style.display = select.value === tutorSelect.options[index].value ? 'none' : '');
    }

    function selectJury() {
        const juradoSelect = document.getElementById('juradoID');
        const maxOptions = 2;
        let optionCount = 0;
        Array.from(juradoSelect.options).forEach((select, i) => {
            if (select.selected) {
                optionCount++;
                console.log(optionCount)
                if (optionCount > maxOptions) {
                    select.selected = false;
                }
            }
        })
    }

</script>
@endsection
