@extends('layouts.base')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="text-right col-lg-12">
                <a class="btn btn-info btn-sm" href="{{route('login') }}">Cerrar sesion</a>
            </div>
            <div class="col-lg-12">
                <h2>Autorizar Usuarios</h2>
            </div>
            <div class="col-lg-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">codigoMVCS</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Acción</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($solicitudes as $solicitud)
                  <tr>
                    <td>{{ $solicitud->IdbdSolicitudes }}</td>
                    @if ($solicitud->IdTipoPersona == 2 || $solicitud->IdTipoPersona == 1) <td>{{ $solicitud->PrimerNombre }} {{$solicitud->ApellidoPaterno}} </td>@endif 
                    @foreach ($agentes as $agente)
                        @if ($solicitud->IdTipoPersona == 3 && $agente->CodigoMVCS == $solicitud->CodigoMVCS)<td> {{$agente->Nombres}} </td>@endif
                    @endforeach
                    <td>@if ($solicitud->IdTipoPersona == 3 || $solicitud->IdTipoPersona == 1) {{$solicitud->CodigoMVCS}} @elseif ($solicitud->IdTipoPersona == 2) {{$solicitud->CodigoMVCSPadre}} @endif</td>
                    <td>@if ($solicitud->Estado == 0) Pendiente @endif </td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{route('updateUser',['id'=>$solicitud->IdbdSolicitudes,'act'=>1]) }}">Autorizar</a> 
                        <a class="btn btn-danger btn-sm" href="{{route('updateUser',['id'=>$solicitud->IdbdSolicitudes,'act'=>2]) }}">No Autorizar</a>
                    </td>
                </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
        </div>
    </div>
@stop