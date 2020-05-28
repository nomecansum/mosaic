@extends('layout')

@section('css')

@endsection
@section('breadcrumb')
<!-- Content Header (Page header) -->
<ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i> </a></li>
    <li class="">Configuracion</li>
    <li class="active">Clientes</li>
</ol>

@endsection

@section('content')


    <div class="panel panel-default">
        <div class="row">
            <div class="col-md-4">

            </div>
            <div class="col-md-7">
                <br>
            </div>
            <div class="col-md-1 text-right ">
                <div class="btn-group btn-group-sm pull-right v-middle mt-2" role="group" style="margin-right: 20px;">
                    <a href="{{ route('customers.create') }}" class="btn btn-success" title="Nuevo dashboard">
                        <i class="fa fa-plus-square" style="font-size: 20px" aria-hidden="true"></i> Nuevo
                    </a>
                </div>
            </div>
        </div>

        @if(count($clientesObjects) == 0)
            <div class="panel-body text-center">
                <h4>No Clients Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th style="width:auto">Nombre</th>
                            <th>Logo</th>
                            {{-- <th style="width:auto">Id</th>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Teléfono</th>
                            <th>Logo</th>
                            <th>ApiKey</th>
                            <th>Token</th>
                            <th>CIF</th>
                            <th>Fecha de borrado</th>
                            <th>mca_appmovil</th>
                            <th>mca_vip</th>
                            <th>Locked</th>
                            <th>Tipo Cliente</th> --}}
                        </tr>
                    </thead>



                    <tbody>
                        @foreach($clientesObjects as $clientes)
                            <tr class="hover-this" onclick="javascript: document.location='{{ route('customers.edit', $clientes->id_cliente) }}'">

                                <td class="pt-3">{{ $clientes->nom_cliente}}</td>

                                <td>{{ $clientes->img_logo }}</td>

                                {{-- <td class="pt-3">{{ $clientes->id_cliente}}</td>

                                <td>{{ $clientes->nom_cliente }}</td>

                                <td>{{ $clientes->nom_contacto }}</td>

                                <td>{{ $clientes->tel_cliente }}</td>

                                <td>{{ $clientes->img_logo }}</td>

                                <td>{{ $clientes->val_apikey }}</td>

                                <td>{{ $clientes->token_1uso }}</td>

                                <td>{{ $clientes->CIF }}</td>

                                <td>{{ $clientes->fec_borrado }}</td>

                                <td>{{ $clientes->mca_appmovil }}</td>

                                <td>{{ $clientes->mca_vip }}</td>

                                <td>{{ $clientes->locked }}</td>

                                <td>{{ $clientes->cod_tipo_cliente }}</td> --}}

                            <td style="vertical-align: middle">
                                <form method="POST" action="{!! route('customers.destroy', $clientes->id_cliente) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs pull-right floating-like-gmail" role="group">
                                        <a href="{{ route('customers.edit', $clientes->id_cliente) }}" class="btn btn-info  add-tooltip" title="Editar Cliente"  style="float: left"><span class="fa fa-pencil pt-1" ></span></a>
                                        <button type="submit" class="btn btn-danger add-tooltip" style="float: left" title="Borrar cliente" onclick="if(confirm(&quot;¿Seguro que quiere borrar al cliente?.&quot;)){document.location='{{ url('clientes/delete/'.$clientes->id_cliente) }}'}"  style="float: right">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer">
            {{-- {!! $clientes->render() !!} --}}
        </div>
        @endif
    </div>
@endsection
