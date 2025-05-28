@extends('extranet.layout.app')
@section('cuerpoPagina')
    <div class="container">
        <div class="card card-info card-outline mb-4 mt-5" style="box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
            <div class="card-header">
                <div class="card-title"><strong>Registro para prueba del sistema free</strong></div>
            </div>
            <div class="card-body">
                <div class="row pt-3">
                    <form class="col-12 form-horizontal" action="{{ route('extranet.registrar') }}" method="POST"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-12">
                                <h5><strong>Datos de la empresa</strong></h5>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="tipo_registro">Tipo de registro</label>
                                <select id="tipo_registro" class="form-control form-control-sm" required>
                                    <option value="Empresa">Como Empresa</option>
                                    <option value="Grupo">Como Grupo Empresarial</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="empresa">Nombre de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="empresa" id="empresa"
                                    required>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="nit">Nit de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="nit" id="nit"
                                    required>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="email">Email de la Empresa o Grupo empresarial</label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email"
                                    required>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="telefono">Teléfono de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="telefono" id="telefono"
                                    required>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="direccion">Dirección de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="direccion" id="direccion"
                                    required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h5><strong>Datos del usuario de contacto y administrador</strong></h5>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="tipo_registro">Tipo de registro</label>
                                <select id="tipo_registro" class="form-control form-control-sm" required>
                                    <option value="Empresa">Como Empresa</option>
                                    <option value="Grupo">Como Grupo Empresarial</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="empresa">Nombre de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="empresa" id="empresa"
                                    required>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="nit">Nit de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="nit" id="nit"
                                    required>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="email">Email de la Empresa o Grupo empresarial</label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email"
                                    required>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="telefono">Teléfono de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="telefono" id="telefono"
                                    required>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="direccion">Dirección de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="direccion" id="direccion"
                                    required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" style="border: solid 1px black">
                                    <label class="form-check-label" for="flexCheckDefault">Acepto los terminos, condiciones y politias de MGL-Tech</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5 mb-3">
                            <div class="col-12 col-md-3 mb-4 mb-md-0 d-grid gap-2 d-block ">
                                <button type="submit" class="btn btn-primary btn-sm pl-sm-5 pr-sm-5" style="box-shadow: 5px 5px 3px 0px rgba(0,0,0,0.85);">Registrarse</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-12"></div>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
@endsection
