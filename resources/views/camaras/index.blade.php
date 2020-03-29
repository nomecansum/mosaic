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
    <div id="editorCAM">

    </div>
    <div class="row">
        <div class="panel">
           <div class="panel">
               <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-7">
                        <br>
                    </div>
                    <div class="col-md-1 text-right">
                        <div class="btn-group btn-group-sm pull-right" role="group">
                                <a href="#" id="btn_nueva_camara" class="btn btn-success" title="Nueva camara">
                                <i class="fa fa-plus-square pt-2" style="font-size: 20px" aria-hidden="true"></i>
                                <span>Nueva</span>
                            </a>
                        </div>
                    </div>
                </div>
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
                            <tr class="hover-this">
                            <td class="thumb" data-id="{{ $camara->id }}" >@if($camara->status==1 && isset($camara->thumbnail))<img src="{{ url('img/camaras/'.$camara->thumbnail) }}" style="width: 80px; height: 40px;">
                                <a href="javascript:void(0)" class="btn-link"></a>
                                @endif
                            </td>
                            <td class="td" data-id="{{ $camara->id }}">{{$camara->etiqueta}}</td>
                            <td class="td" data-id="{{ $camara->id }}">
                                @if($camara->status==1)
                                    <div class="label label-table label-success">ONLINE</div>
                                @elseif($camara->status==-1)
                                    <div class="label label-table label-warning">N/A</div>
                                @else
                                    <div class="label label-table label-danger">OFFLINE</div>
                                @endif
                            </td>
                            <td class="td" data-id="{{ $camara->id }}">{{$camara->ip}}</td>
                            <td class="td" data-id="{{ $camara->id }}">{{$camara->port}}</td>
                            <td style="position: relative;">
                                {{$camara->url}}
                                <div class="btn-group btn-group-xs pull-right floating-like-gmail" role="group">
                                    <a href="#"  class="btn btn-warning btn_editar add-tooltip thumb"  title="Ver camara" data-id="{{ $camara->id }}"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                                    <a href="#"  class="btn btn-info btn_editar add-tooltip" onclick="editar({{ $camara->id }})" title="Editar camara" data-id="{{ $camara->id }}"> <span class="fa fa-pencil pt-1" aria-hidden="true"></span></a>
                                    <a href="#eliminar-camara-{{$camara->id}}" data-target="#eliminar-camara-{{$camara->id}}" title="Borrar camara" data-toggle="modal" class="btn btn-danger add-tooltip btn_del"><span class="fa fa-trash" aria-hidden="true"></span></a>
                                </div>
                                <div class="modal fade" id="eliminar-camara-{{$camara->id}}" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">×</span></button>
                                                  <div><img src="/img/onthespot_20.png" class="float-right"></div>
                                                <h4 class="modal-title">¿Borrar camara {{$camara->etiqueta}}?</h4>
                                              </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-info" href="{{url('/camaras/delete',$camara->id)}}">Si</a>
                                                <button type="button" data-dismiss="modal" class="btn btn-warning">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>

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
<script>
	$('#btn_nueva_camara').click(function(){
       $('#editorCAM').load("{{ url('/camaras/edit/0') }}", function(){
		animateCSS('#editorCAM','bounceInRight');
	   });
	  // window.scrollTo(0, 0);
      //stopPropagation()
	});

	function editar(id){
        $('#editorCAM').load("{{ url('/camaras/edit/') }}"+"/"+id, function(){
			animateCSS('#editorCAM','bounceInRight');
		});
    }

    $('.thumb').click(function(event){
        $(location).attr("href", "{{ url('/camaras/ver_camara/') }}/"+$(this).data('id'));
    })

    $('.td').click(function(event){
        editar( $(this).data('id'));
    })





</script>
@endsection
