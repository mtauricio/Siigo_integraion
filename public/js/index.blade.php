@extends("theme.$theme.layout")
@section('title')
Agencias - Rumbos Express
@endsection

@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="icon-gradient bg-love-kiss pe-7s-culture">
                </i>
            </div>
            <div>
                <h1>Agencias</h1>
                <div class="page-title-subheading">Configuracion de las Agencias</div>
            </div>
        </div>
    </div>
</div>
@include('includes.form-error')
<div class="row">
    <div class="col-lg-7">
        <div class="main-card mb-3 card">
            <div class="card-body card border border-dark">
                <h5 class="card-title">Agencias Registradas</h5>
                <!-- Tabla -->
                <div id="list-table"></div>
                <!-- Fin Tabla -->
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="main-card mb-3 card">
            <div class="card-body card border border-dark">
                <h5 class="card-title">Registrar Agencia</h5>
                <div>
                    <form method="POST" id="form-general">
                        @csrf

                        <div class="position-relative row form-group">
                            <label for="agencyName" class="col-sm-3 col-form-label requerido">Nombre de la Agencia</label>
                            <div class="col-sm-9">
                                <input name="agencyName" id="agencyName" placeholder="Nombre de la Agencia" type="text"
                                    class="form-control" value="{{old('agencyName')}}" required>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="latitude" class="col-sm-3 col-form-label">Logitud</label>
                            <div class="col-sm-9"><input name="logitude" id="latitude" placeholder="Longitud"
                                    type="text" class="form-control" value="{{old('latitude')}}"></div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="latitude" class="col-sm-3 col-form-label">Latitud</label>
                            <div class="col-sm-9"><input name="latitude" id="latitude" placeholder="Latitud"
                                    type="text" class="form-control" value="{{old('latitude')}}"></div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="city_id" class="col-sm-3 col-form-label requerido">Ciudad</label>
                            <div class="col-sm-9">
                                <select type="select" id="city_id" name="city_id" class="custom-select" required>
                                    <option value="">Seleccione la cuidad de la Agencia </option>

                                    @if (!empty($cities))
                                        @foreach ($cities as $item)
                                        <option value="{{$item->id}}">{{$item->cityName}}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="zipCode" class="col-sm-3 col-form-label">Codigo Postal</label>
                            <div class="col-sm-9"><input name="zipCode" id="zipCode" placeholder="Codigo Postal"
                                    type="text" class="form-control" value="{{old('zipCode')}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="phoneNumber" class="col-sm-3 col-form-label">Numero Telefonico</label>
                            <div class="col-sm-9"><input name="phoneNumber" id="phoneNumber" placeholder="Numero Telefonico"
                                    type="text" class="form-control" value="{{old('phoneNumber')}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9"><input name="email" id="email" placeholder="Numero Telefonico"
                                    type="email" class="form-control" value="{{old('email')}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="address" class="col-sm-3 col-form-label">Direccion de la Agencia</label>
                            <div class="col-sm-9"><input name="address" id="address" placeholder="Direccion de la Agencia"
                                    type="text" class="form-control" value="{{old('address')}}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="taxID" class="col-sm-3 col-form-label">TAX ID</label>
                            <div class="col-sm-9"><input name="taxID" id="taxID" placeholder="Codigo de Identificacion TAX ID"
                                    type="text" class="form-control" value="{{old('taxID')}}">
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-success m-1" onclick="register()">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Modal Editar Estado del Sistema  -->
<div class="modal fade" id="editarAgency" tabindex="-1" role="dialog" aria-labelledby="editarAgency"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5 class="modal-title text-center" id="editarAgency">Editar Agencia</h5>
                <br>
                <hr>
                @include('admin.agency.form')
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Editar Estado del Sistema -->
@endsection

@section('script')
    @include('admin.agency.script')
@endsection