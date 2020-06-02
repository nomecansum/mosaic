@php
Use \Carbon\Carbon;
@endphp

@extends('layout')

@section('breadcrumb')
<!-- Content Header (Page header) -->
<ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i> </a></li>
    <li class="">Configuracion</li>
    <li class="active">bitacora</li>
</ol>

@endsection

@section('camino')
<!-- Content Header (Page header) -->
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Log Argos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Log</li>
                <li class="breadcrumb-item active">Log Argos</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
@endsection

@section('styles')
<style type="text/css">

    .select2-container{
        height: 40px;
    }
       
    .select2-selection{
        height: 40px;
    }

    .select2-selection__choice{
        height: 30px;
        padding-top: 2px;
        background-color: #25476a;
    }
  
</style>

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="row"><br></div>
        <form name="frm_busca_bitacora" method="POST" action="{{ url('bitacoras/search') }}">
        <div class="row">

        {{ csrf_field() }}
            <div class="col-md-1" style="margin-left:30px">
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status"  style="height: 40px;">
                        <option value=""></option>
                        <option>ok</option>
                        <option>error</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Fechas:</label>

                    <div class="input-group mar-btm">
                        <input type="text" class="form-control pull-right" id="fechas" autocomplete="off" name="fechas" style="height: 40px;" value="{{ isset($r)?Carbon::parse($fechas[0])->format('d/m/Y').' - '.Carbon::parse($fechas[1])->format('d/m/Y'):'' }}">
                        <div class="input-group-btn">
                            <span class="btn input-group-text btn-mint"  style="height: 40px"><i class="fa fa-calendar mt-1"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Usuario</label>
                    <select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true" name="usuario">
                        <option value=""></option>
                        @foreach($usuarios as $key=>$value)
                        <option {{ isset($r) && $r->usuario==$value ? 'selected' : '' }} value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Modulo</label>
                    <select class="form-control select2" multiple=""  style="width: 100%; height: 40px" tabindex="-1" aria-hidden="true" name="modulos[]">
                        <option value=""></option>
                        @foreach($modulos as $key=>$value)
                        <option {{ isset($r) && $r->modulos==$value ? 'selected' : '' }} value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Accion:</label>
                    <input type="text" class="form-control" id="fechas" name="accion" style="width: 100%; height: 40px">
                </div>
            </div>

            <div class="col-md-1" style="width: auto">
                <button type="submit" class="btn btn-primary" style="margin-top: 22px; margin-right: 30px; height: 40px"><i class="fa fa-search"></i> Buscar</button>
            </div>

        </div>
        </form>
    @php
        //dd($bitacoras);
    @endphp
        @if(!isset($bitacoras))
            <div class="panel-body text-center">
                <h4>No Bitacoras Available.</h4>
            </div>
        @else

        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th>id_bitacora</th>
                            <th>id_usuario</th>
                            <th>id_modulo</th>
                            <th>accion</th>
                            <th>status</th>
                            <th>fecha</th>
                            <th style="width: 140px">id_seccion</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bitacoras as $bitacora)
                        <tr style="font-size: 13px" @if($bitacora->status=="error" || strpos($bitacora->accion,"ERROR:")!==false) class="bg-red color-palette" @endif>
                            <td>{{ $bitacora->id_bitacora }}</td>
                            <td>{{ $bitacora->id_usuario }}</td>
                            <td>{{ $bitacora->id_modulo }}</td>
                            @php
                                $clase="";
                                if(strpos($bitacora->id_modulo,"ATIS Maniobras")!==false && $bitacora->status!=="error"){
                                    if(strpos($bitacora->accion,"Cambiada Maniobra S")!==false){
                                        $clase="linea_titulo_pistas bg_amarillo titulo_orientacion_maniobras";
                                    } else{
                                        $clase="linea_titulo_pistas bg_azul_claro txt_blanco titulo_orientacion_maniobras";
                                    }
                                }
                            @endphp
                            <td class="{{ $clase }}" style="word-break: break-all;">{{ $bitacora->accion }}</td>
                            <td ><span @if($bitacora->status=="ok") class="bg-green-active color-palette" @endif style="padding: 0 5px 0 5px">{{ $bitacora->status }}</span></td>
                            <td>{!! beauty_fecha($bitacora->fecha) !!}</td>
                            <td>{{ $bitacora->id_seccion }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {{-- {!! $bitacoras->render() !!} --}}
        </div>

        @endif

    </div>
@endsection
@php
    //dd($r->modulos);
    if(isset($r)){
        $fechas=explode(" - ",$r->fechas);
    } else {
        /* $fechas[0]=date('Y-m-d');
        $fechas[1]=date('Y-m-d', strtotime(date('Y-m-d') . " + 30 day")); */
        //$fechas[0]=adaptar_fecha($fechas[0]);
        
        if (isset($r->fechas) && $r->fechas[0]!=null && $r->fechas[1]!=null){
            $fechas=explode(" - ",$r->fechas);
            $fechas[0]=adaptar_Fecha($fechas[0]);
            $fechas[1]=adaptar_Fecha($fechas[1]);
            //dd($fechas);
            } else {
            $fechas=null;
            }
                }

@endphp
@section('scripts')
    <script>
     //Date range picker
     $('#fechas').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            opens: 'right',
        }, function(start_date, end_date) {
            $('#fechas').val(start_date.format('DD/MM/YYYY')+' - '+end_date.format('DD/MM/YYYY'));
        });

    @if(isset($fechas) && $fechas[0]!='' && $fechas[1]!='')
        $('#fechas').val('{{ $fechas[0] }} - {{ $fechas[1] }}');
    @endif;
    </script>
@endsection
