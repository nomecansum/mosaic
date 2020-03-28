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
                            <tr class="hover-this" onclick="editar({{ $camara->id }})">
                            <td class="thumb" data-id="{{ $camara->id }}" >@if($camara->status==1 && isset($camara->thumbnail))<img src="{{ url('img/camaras/'.$camara->thumbnail) }}" style="width: 80px; height: 40px;">
                                <a href="javascript:void(0)" class="btn-link"></a>
                                @endif
                            </td>
                            <td>{{$camara->etiqueta}}</td>
                            <td>
                                @if($camara->status==1)
                                    <div class="label label-table label-success">ONLINE</div>
                                @elseif($camara->status==-1)
                                    <div class="label label-table label-warning">N/A</div>
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
		//window.scrollTo(0, 0);
    }

    $('.thumb').click(function(event){
        event.stopPropagation();
        $(location).attr("href", "{{ url('/camaras/ver_camara/') }}/"+$(this).data('id'));

    })



</script>
@endsection
