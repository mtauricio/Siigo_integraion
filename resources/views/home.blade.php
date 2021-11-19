@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Bienvenido!') }}
                    <div>
                        <button class="btn btn-success" id="sync-button">Sincronizar</button>
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
                if (response === 0) {
                    alert('Se crearon todos los servicios satisfactoriamente');
                } else {
                    alert('Fallaron en crearse ' + response + ' servicios por favor intente de nuevo');
                }
                
            }
        });
    }

</script>
@endsection
