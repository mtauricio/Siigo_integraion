@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: #ad0000;color: white;font-size: large;">{{ __('Bienvenido: '. Auth::user()->name)}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Aqui podrá sincronizar sus factura para crear los respectivos servicios en SmartQuick') }}
                    <div>
                        <button class="btn btn-lg btn-danger m-5" style="background: #ad0000;" id="sync-button">Sincronizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#sync-button").click(function (e) { 
            saveInvoices() 
    })
    });
    function saveInvoices() {
        $.ajax({
            type: "GET",
            url: "{{route('saveInvoices')}}",
            success: function (response) {
                if (response == true) {
                    createService();
                } else {
                    alert('Algo falló por favor intente de nuevo');
                }
            }
        });
    }

    function createService() {
        $.ajax({
            type: "POST",
            url: "{{route('createService')}}",
            success: function (response) {
                if (response == 0) {
                    Swal.fire(
                        'Excelente!',
                        'Se han creado los servicios correctamente!',
                        'success'
                    )
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups...',
                        text: 'Fallaron en crearse ' + response + ' servicios por favor intente de nuevo',
                    })
                }
                
            }
        });
    }

</script>
@endsection
