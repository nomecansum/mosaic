@extends('layout')

@section('css')

@endsection

@section('content')
    <div id="container">



        <div id="page-head">

                <hr class="new-section-sm bord-no">
                <div class="text-center">
                    <h3>Hola {{ Auth::user()->name }}, estos son los posibles accesos a la configuración.</h3>
                    <p>Recuerda que debes tener los permisos necesarios en tu perfil. <a href="{{ route('users.users.edit', Auth::user()->id ) }}" class="btn-link">Compruebalo</a></p>
                </div>
                <hr class="new-section-md bord-no">
        </div>


                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">


					    <div class="row">
					        <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-data-settings icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Bitacora</p>
					                    <p class="text-muted">Actividad del usuario</p>
					                    <p class="text-sm">Estructura cronológica actualizada regularmente, monitoriza la actividad de los usuarios.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Get it now</button> --}}
					                </div>
					            </div>
					        </div>
					        <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
                                        <div class="pad-ver mar-top text-main"><i class="demo-pli-address-book icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Usuarios</p>
					                    <p class="text-muted">Personas con permiso de acceso</p>
					                    <p class="text-sm">Los usuarios tendran acceso a la configuración del sistema.</p>
					                    {{-- <button class="btn btn-primary mar-ver">View reports</button> --}}
					                </div>
					            </div>
                            </div>

                            <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
                                        <div class="pad-ver mar-top text-main"><i class="fas fa-users fa-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Perfiles</p>
					                    <p class="text-muted">Nivel de acceso</p>
					                    <p class="text-sm">Cada usuario tendrá un nivel de acceso según el perfil otorgado, para acceder a la información.</p>
					                    {{-- <button class="btn btn-primary mar-ver">View reports</button> --}}
					                </div>
					            </div>
					        </div>


                            <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="fas fa-puzzle-piece fa-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Secciones</p>
					                    <p class="text-muted">Apartados de configuración</p>
					                    <p class="text-sm">Las secciones serán adecuadas al uso de la aplicación.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Contact us</button> --}}
					                </div>
					            </div>
                            </div>

                            <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="fas fa-key fa-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Permisos</p>
					                    <p class="text-muted">Acceso</p>
					                    <p class="text-sm">Para acceder a las diferentes secciones se otorgaran los permisos correspondientes.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Contact us</button> --}}
					                </div>
					            </div>
                            </div>

                            <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="fas fa-user-tag fa-4x"></i></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Clientes</p>
					                    <p class="text-muted">Dan acceso al sistema a los usuarios</p>
					                    <p class="text-sm">Se podrá comprobar su nombre y el logo correspondiente.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Contact us</button> --}}
					                </div>
					            </div>
					        </div>

					    </div>
                </div>


    </div>
@endsection
