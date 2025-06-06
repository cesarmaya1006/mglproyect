@extends('intranet.layout.app')
@section('cssPagina')

@endsection
@section('tituloPagina')
    <i class="fa fa-home" aria-hidden="true"></i> Dashboard
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
@endsection
@section('botones')

@endsection
@section('cueroPagina')
Holass
<br>
{{ session('roles') }}
<br>
fin

@endsection
@section('modales')

@endsection
@section('scriptPagina')

@endsection
