


@extends('layout')

@section('styles')


<meta name="_token" content="{{csrf_token()}}" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>


@endsection

@section('breadcrumb')
<!-- Content Header (Page header) -->
<ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="demo-pli-home"></i> </a></li>
    <li class="">Configuracion</li>
    <li class="active">Importación usuarios</li>
</ol>

@endsection

@section('content')

<div id="container" class="effect aside-float aside-bright mainnav-lg">
                <div id="page-content">

					<div class="panel">
					    <div class="eq-height clearfix">
					        <div class="col-md-4 eq-box-md text-center box-vmiddle-wrap bord-hor">

					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">Register Today</h3>
					                <div class="pad-ver">
					                    <i class="demo-pli-bag-coins icon-5x"></i>
					                </div>
					                <p class="pad-btn text-sm">Members get <span class="text-lg text-bold text-main">50%</span> more points, so register today and start earning points for savings on great rewards!</p>
					                <br>
					                <a class="btn btn-lg btn-primary" href="#">Learn More...</a>
					            </div>
					            <!--===================================================-->

					        </div>
					        <div class="col-md-8 eq-box-md eq-no-panel">

					            <!-- Main Form Wizard -->
					            <!--===================================================-->
					            <div id="demo-main-wz">

					                <!--nav-->
					                <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
					                    <li class="col-xs-3">
					                        <a data-toggle="tab" href="#demo-main-tab1">
					                            <span class="text-danger"><i class="demo-pli-number icon-1x"></i></span>
					                            <h5 class="mar-no">Descargar plantilla</h5>
					                        </a>
					                    </li>
					                    <li class="col-xs-3">
					                        <a data-toggle="tab" href="#demo-main-tab2">
					                            <span class="text-warning"><i class="demo-pli-number icon-2x"></i></span>
					                            <h5 class="mar-no">Rellenar plantilla</h5>
					                        </a>
					                    </li>
					                    <li class="col-xs-3">
					                        <a data-toggle="tab" href="#demo-main-tab3">
					                            <span class="text-info"><i class="demo-pli-number icon-3x"></i></span>
					                            <h5 class="mar-no">Procesar plantilla</h5>
					                        </a>
					                    </li>
					                    <li class="col-xs-3">
					                        <a data-toggle="tab" href="#demo-main-tab4">
					                            <span class="text-success"><i class="demo-pli-number icon-4x"></i></span>
					                            <h5 class="mar-no">Resultado</h5>
					                        </a>
					                    </li>
					                </ul>

					                <!--progress bar-->
					                <div class="progress progress-xs">
					                    <div class="progress-bar progress-bar-primary"></div>
					                </div>

                                    <div class="alert" style="display: none"  id="msg_result">
                                        <button type="button" class="close" onclick="$('#msg_result').hide();" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                        <h3 id="h_titulo" class=""><i id="icono_msg" class=""></i> <span id="tit_msg"></span></h3> <span id="msg"></span>
                                    </div>
                                    <!--form-->

					                    <div class="panel-body">
					                        <div class="tab-content">

                                                <!--First tab-->

					                            <div id="demo-main-tab1" class="tab-pane">

                                                    <h4>Descarge la plantilla EXCEL con los datos especificos de su empresa.</h4>
                                                        @if(isAdmin() || count(clientes())>1)
                                                            Seleccione la empresa<br><br>
                                                            <select required class="" id="id_cliente" name="id_cliente" palceholder="Seleccione la empresa">
                                                                <option selected value=""></option>
                                                                @foreach (@\DB::table('clientes')->orderby('nom_cliente')->get() as $c_)
                                                                    <option value="{{$c_->id_cliente}}">{{$c_->nom_cliente}}</option>
                                                                @endforeach
                                                            </select>

                                                        @else
                                                            <input type="hidden" id="id_cliente" name="id_cliente" value="{{ Auth::user()->id_cliente }}"
                                                        @endif

                                                        <br>
                                                        <div class="text-center">
                                                            <a class="link_excel hover-this" href="javascript:void(0)" id="link_descarga" @if(isAdmin() || count(clientes())>1)style="display: none"@endif>
                                                                <img src="{{ url('plantillas/logo_excel.png') }}">
                                                                <span><h2>
                                                                    <a href="{{url('/plantillas/fichero_plantilla.xlsx')}}">Descargar plantilla</a>
                                                                </h2></span>
                                                            </a>
                                                        </div>
                                                        <br><br>
                                                        <h4>Recuerde que si altera la parametrización de su empresa (Departamentos/Centros/Horarios/Ciclos) deberá volver a descargarla para asegurar que tiene los datos actualizados</h4>
                                                        <br>

					                            </div>

					                            <!--Second tab-->
					                            <div id="demo-main-tab2" class="tab-pane fade">

                                                    <h4>Rellene la plantilla EXCEL con los datos de sus usuarios.</h4>

                                                    <h4>Hay ciertos campos que son obligatorios, debe tener en cuenta de que si alguno de dichos campos no estan rellenos, se rechazará el la plantilla durante el procesado.</h4>
                                                    <h4 class="font-bold">Campos obligatorios</h4>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <ul>
                                                                <li>Nombre</li>
                                                                <li>Apeliidos</li>
                                                                <li>Situacion</li>
                                                                <li>e-mail</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <ul>
                                                                <li>Estado civil</li>
                                                                <li>Sexo</li>
                                                                <li>Fecha de nacimiento</li>
                                                                <li>Nivel de estudios</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <img src="{{ url('imgs/ejemplo_excel.png') }}">
                                                        </div>
                                                    </div>
                                                    <h4>Para estos dos campos, si no indica valor, se asignará el primero disponible por defecto</h4>
                                                    <ul>
                                                        <li>Centro</li>
                                                        <li>Departamento</li>
                                                    </ul>
                                                    <h4>Una vez rellenada la plantilla pulse "Siguiente"</h4>

					                            </div>

					                            <!--Third tab-->
					                            <div id="demo-main-tab3" class="tab-pane">

                                                        <h4>Ahora arrastre los ficheros que desea subir: imagenes de usuarios y la plantilla de excel rellenada.<br><br></h4>
                                                        <i class="fa fas fa-info-circle"></i>NOTA: Las fotos de usuarios deben tener el mismo nombre que haya puesto en la plantilla, si no, se descartarán.<br><br>
                                                        <h4>Es importante que <b>suba la plantilla en ultimo lugar</b>, pues al subir la plantilla se iniciará el procesado de la informacion y una vez subida ya no se podrán subir más ficheros con fotos.</h4>
                                                        <br><br>
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <label class="btn btn-warning">
                                                                <div class="custom-control custom-checkbox mr-sm-2">
                                                                    <input type="checkbox" class="custom-control-input" id="enviar_email" name="enviar_email" checked>
                                                                    <label class="custom-control-label" for="checkbox0">Marque si desea enviar email de bienvenida a los usuarios que se añadan</label>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data"
                                                            class="dropzone" id="dropzone">
                                                            @csrf
                                                        </form>
					                            </div>

					                            <!--Fourth tab-->
					                            <div id="demo-main-tab4" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Bio</label>
					                                    <div class="col-lg-9">
					                                        <textarea placeholder="Tell us your story..." rows="4" name="bio" class="form-control"></textarea>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <div class="col-lg-9 col-lg-offset-2">
					                                        <div class="checkbox">
					                                            <input id="demo-checkbox-1" class="magic-checkbox" type="checkbox" name="acceptTerms">
					                                            <label for="demo-checkbox-1"> Accept the terms and policies</label>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>


					                    <!--Footer buttons-->
					                    <div class="pull-right pad-rgt mar-btm">
					                        <button type="button" class="previous btn btn-primary">Previous</button>
					                        <button type="button" class="next btn btn-primary">Next</button>
					                        <button type="button" class="finish btn btn-success" disabled>Finish</button>
					                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
@endsection

@section('scripts')




<script type="text/javascript">



$(function(){
    var nom_fichero="plantilla";
    var fecha=moment().format('YYYYMMDD');
    $("#id_cliente").change(function(){
        if($( "#id_cliente option:selected" ).text()==''){
            $('#link_descarga').hide();
        }   else{
            var fichero = nom_fichero+$( "#id_cliente option:selected" ).text()+'_'+fecha+'.xlsx';
            $('#nombre_fichero').html(fichero);
            $('#fic').val(fichero);
            $('#link_descarga').show();
            Dropzone.forElement("#dropzone").removeAllFiles(true);
        }
    });

    $('.link_excel').click(function(){
        document.location="{{ url('employees/import/template/') }}"+"/"+$('#id_cliente').val();
    })

});
window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
]) !!};



    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        
        acceptedFiles: 'image/*,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel',

        addRemoveLinks: true,
        timeout: 50000,
        removedfile: function(file)
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                type: 'POST',
                url: '{{ url("image/delete") }}',
                data: {filename: name},
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file, response)
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
};
</script>



@endsection







