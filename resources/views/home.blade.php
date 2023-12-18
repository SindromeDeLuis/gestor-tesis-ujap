@extends('layouts.app')

@section('content')
<div class="banner">
    <div class="container-banner">
        <div class="texto-principal">
            <h2>Universidad José Antonio Páez</h2>
            <h3>Dirección de Trabajo de Grado y Pasantía</h3>
        </div>
    </div>
</div>
<div class="container-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p class="fs-3 m-0">
                            {{ __('Trabajos de Grado y Pasantia') }}
                            <searchbar-component class="float-end"></searchbar-component>
                        </p>
                    </div>
                    <div class="card-body">
                        <carousel-component :teses="{{ $public_teses }}" :students="{{ $users }}"></carousel-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="container-footer" style="transform:translateY(24px)">
    <footer class="footer flex-wrap justify-content-center align-items-center pt-3 px-5 pb-4 bg-white shadow-lg position-relative">
        <div class="text-center mb-3 mb-md-0 d-flex flex-column position-absolute bottom-0">
            <span class="fw-bold">Universidad José Antonio Páez</span>
            <span class="fw-bold">Municipio San Diego, Calle Nº 3. Urb. Yuma II. (2do. Semáforo de La Urb. La Esmeralda, detrás del Conjunto Residencial Poblado). Valencia – Edo. Carabobo</span>
            <span><b>Teléfonos:</b> 0241-8720269 (Centro de Información UJAP) y 0241-8714240 (Master)</span>
        </div>
    </footer>
</div> -->
<footer class="footer">
    <nav class="foot">
        <span class="fw-bold">Universidad José Antonio Páez</span>
        <span class="fw-bold">Municipio San Diego, Calle Nº 3. Urb. Yuma II. (2do. Semáforo de La Urb. La Esmeralda, detrás del Conjunto Residencial Poblado). Valencia – Edo. Carabobo</span>
        <span><b>Teléfonos:</b> 0241-8720269 (Centro de Información UJAP) y 0241-8714240 (Master)</span>
    </nav>
</footer>
@endsection

<script>
    window.addEventListener("scroll", function() {
        const distance = window.scrollY
        document.querySelector(".banner").style.transform = `translateY(${distance * 1}px)`
        document.querySelector(".container-banner").style.transform = `translateY(${distance * 0.1}px)`
        setTimeout(() => {
            document.querySelector(".container").classList.add("animate-me")
            document.querySelector("footer").classList.add("animate-me")
        }, 400)
    })
</script>

<style>
    .navbar {
        position: fixed !important;
        height: 85px;
        width: 100%;
        z-index: 11;
    }

    .banner {
        background: url("{{ asset('images/banner.jpg') }}");
        /*background-position: center;
        background-attachment: contain;*/
        background-size: cover;
        display: flex;
        flex-direction: column;
        position: relative;
        height: 400px;
        z-index: -1;
    }
        .texto-principal {
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            color: white;
            padding: 0 50px;
        }
        .texto-principal h2 { 
            font-weight: bold;
            background: rgba(0, 0, 0, .4);
            padding: 5px 6px;
        }
        .texto-principal h3 { 
            background: rgba(0, 0, 0, .4);
            padding: 5px 6px;
        }

    .container-body {
        background: #f8fafc;
        padding-top: 24px;
        
    }

    .modal-container {
        width: 70% !important;
    }    

    .container-footer {
        background: #f8fafc;
    }

    .footer{
        background: white;
        display: flex;
        justify-content: center;
        padding: 15px 0;
        height: 90px;
        position: relative;
        bottom: -24px;
        box-shadow: 0 -0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
        .foot{
            text-align: center;
            display: flex;
            flex-direction: column;
        }
            .foot span{
                color: black;
                font-size: 14px;
                padding: 0 10px;
                text-decoration: none;
            }

    .animate-me {
        animation: bounceIn 3s ease-in-out;
    }
</style>
