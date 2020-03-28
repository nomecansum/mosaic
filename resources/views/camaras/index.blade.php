@extends('layout')

@section('title')
    <h1 class="page-header text-overflow pad-no">Gestión de cámaras</h1>
@endsection

@section('styles')

@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
        <li class="breadcrumb-item">Camaras</li>
        {{--  <li class="breadcrumb-item"><a href="{{url('/users')}}">Usuarios</a></li>
        <li class="breadcrumb-item active">Editar usuario {{ !empty($users->name) ? $users->name : '' }}</li>  --}}
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="panel">
           <div class="panel">
               <div class="panel-body">
                <table class="table table-striped table-hover table-vcenter">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>IP</th>
                            <th>Puerto</th>
                            <th>URL</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($camaras as $camara)
                            <tr class="hover-this" data-href="{{url('camaras/'.$camara->id)}}">
                            <td><a href="#fakelink" class="btn-link">Order #53451</a></td>
                            <td>{{$camara->etiqueta}}</td>
                            <td>
                                @if($camara->status==1)
                                    <div class="label label-table label-success">ONLINE</div>
                                @else
                                    <div class="label label-table label-danger">OFFLINE</div>
                                @endif
                            </td>
                            <td>{{$camara->ip}}</td>
                            <td>{{$camara->port}}</td>
                            <td>{{$camara->url}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
               </div>
           </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
