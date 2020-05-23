@extends('layout')
@section('title')
<h1 class="page-header text-overflow pad-no">Clientes</h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> </a></li>
        <li class="breadcrumb-item">Configuracion</li>
        <li class="breadcrumb-item"><a href="{{url('/clientes')}}">Usuarios</a></li>
        <li class="breadcrumb-item active">Editar cliente {{ !empty($clientes->nom_cliente) ? $clientes->nom_cliente : '' }}</li>
    </ol>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('customers.create') }}" accept-charset="UTF-8" id="create_customers_form" nom_cliente="create_customers_form" class="form-horizontal form-ajax"  enctype="multipart/form-data">
            {{ csrf_field() }}
            @include ('customers.form', [
                                        'clientes' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-10">
                        <input class="btn btn-primary btn-lg" type="submit" value="Guardar">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


