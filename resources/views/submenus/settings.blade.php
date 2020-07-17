@extends('layout')

@section('css')

@endsection

@section('content')
    <div id="container">



        <div id="page-head">

                <hr class="new-section-sm bord-no">
                <div class="text-center">
                    <h3>Hola {{ Auth::user()->name }}, estos son los posibles accesos a la configuración.</h3>
                    <p>Recuerda que debes tener los permisos necesarios. <a href="#" class="btn-link">Compruebalo</a></p>
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
					                    <p class="text-muted">32TB Total storage</p>
					                    <p class="text-sm">The Big Oxmox advised her not to do so, because there were thousands of bad.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Get it now</button> --}}
					                </div>
					            </div>
					        </div>
					        <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-computer-secure icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Usuarios</p>
					                    <p class="text-muted">Latest Technology</p>
					                    <p class="text-sm">The Big Oxmox advised her not to do so, because there were thousands of bad.</p>
					                    {{-- <button class="btn btn-primary mar-ver">View reports</button> --}}
					                </div>
					            </div>
					        </div>
					        <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-consulting icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Perfiles</p>
					                    <p class="text-muted">We are here 24/7</p>
					                    <p class="text-sm">The Big Oxmox advised her not to do so, because there were thousands of bad.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Contact us</button> --}}
					                </div>
					            </div>
                            </div>

                            <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-consulting icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Secciones</p>
					                    <p class="text-muted">We are here 24/7</p>
					                    <p class="text-sm">The Big Oxmox advised her not to do so, because there were thousands of bad.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Contact us</button> --}}
					                </div>
					            </div>
                            </div>

                            <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-consulting icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Permisos</p>
					                    <p class="text-muted">We are here 24/7</p>
					                    <p class="text-sm">The Big Oxmox advised her not to do so, because there were thousands of bad.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Contact us</button> --}}
					                </div>
					            </div>
                            </div>

                            <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-consulting icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Clientes</p>
					                    <p class="text-muted">We are here 24/7</p>
					                    <p class="text-sm">The Big Oxmox advised her not to do so, because there were thousands of bad.</p>
					                    {{-- <button class="btn btn-primary mar-ver">Contact us</button> --}}
					                </div>
					            </div>
					        </div>

					    </div>
                </div>


    </div>
@endsection
