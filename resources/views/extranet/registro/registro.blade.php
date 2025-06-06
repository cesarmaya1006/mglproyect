@extends('extranet.layout.app')
@section('cuerpoPagina')
<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-10">
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
                                <select id="tipo_registro" name="tipo_registro" class="form-control form-control-sm" required style="border: 1px solid gray;">
                                    <option value="Empresa">Como Empresa</option>
                                    <option value="Grupo">Como Grupo Empresarial</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="empresa">Nombre de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="empresa" id="empresa" required  style="border: 1px solid gray;">
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="nit">Nit de la Empresa o Grupo empresarial (solo números)</label>
                                <input type="text" class="form-control form-control-sm" name="nit" id="nit" required  style="border: 1px solid gray;">
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="email_empresa">Email de la Empresa o Grupo empresarial</label>
                                <input type="email" class="form-control form-control-sm" name="email_empresa" id="email_empresa" required  style="border: 1px solid gray;">
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="telefono_empresa">Teléfono de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="telefono_empresa" id="telefono_empresa" required  style="border: 1px solid gray;">
                            </div>
                            <div class="col-12 col-md-5 form-group">
                                <label class="requerido" for="direccion_empresa">Dirección de la Empresa o Grupo empresarial</label>
                                <input type="text" class="form-control form-control-sm" name="direccion_empresa" id="direccion_empresa" required  style="border: 1px solid gray;">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <h5><strong>Datos del usuario de contacto y administrador</strong></h5>
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="nombres">Nombres</label>
                                <input type="text" class="form-control form-control-sm inputBorder" name="nombres" id="nombres" required style="border: 1px solid gray;">
                            </div>
                            <div class="col-12 col-md-3 form-group">
                                <label class="requerido" for="apellidos">Apellidos</label>
                                <input type="text" class="form-control form-control-sm inputBorder" name="apellidos" id="apellidos" required style="border: 1px solid gray;">
                            </div>
                            <div class="col-12 col-md-4 form-group">
                                <label class="requerido" for="email">Correo Electrónico</label>
                                <input type="email" class="form-control form-control-sm inputBorder" name="email" id="email" required style="border: 1px solid gray;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="terminos" name="terminos" style="border: solid 1px black" required>
                                    <label class="form-check-label" for="terminos">Acepto los terminos, condiciones y politias de MGL-Tech</label>
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
</div>
@endsection
