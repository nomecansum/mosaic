@extends('layouts.lockscreen')

@section('css')

@endsection

@section('content')
    <div id="container" class="cls-container">

		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>

		<!-- LOCK SCREEN -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3">{{ Auth::user()->name }}</h1>
		                <span>{{ DB::table('niveles_acceso')->where('cod_nivel',Auth::user()->cod_nivel)->first()->des_nivel_acceso }}</span>
		            </div>
		            <div class="pad-btm mar-btm">

                        @if(Auth::user()->img_usuario!="" && file_exists( public_path().'/img/users/'.Auth::user()->img_usuario))
                        <img alt="Profile Picture" class="img-lg img-circle img-border-light" src="{{url('/img/users/'.Auth::user()->img_usuario)}}">
                        @else
                        {!! icono_nombre(Auth::user()->name) !!}
                        @endif
		            </div>
		            <p>Introduzca su password para desbloquear!</p>
                    <form method="POST" id="loginform" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" class="form-control"  name="email" value="{{ Auth::user()->email }}" required autocomplete="email" autofocus>
		                <div class="form-group">
		                    <input type="password" class="form-control" placeholder="Password">
		                </div>
		                <div class="form-group text-right">
		                    <button class="btn btn-block btn-lg btn-success" type="submit">Login In</button>
		                </div>
		            </form>
		            <div class="pad-ver">
		                <a href="{{ url('/') }}" class="btn-link mar-rgt text-bold">Utilizar una cuenta distinta</a>
		            </div>
		        </div>
		    </div>
		</div>
		<!--===================================================-->


		<!-- DEMO PURPOSE ONLY -->
		<!--===================================================-->
		{{-- <div class="demo-bg">
		    <div id="demo-bg-list">
		        <div class="demo-loading"><i class="demo-psi-repeat-2"></i></div>
		        <img data-id="1" class="demo-chg-bg bg-trans active" src="img/bg-img/thumbs/bg-trns.jpg" alt="Background Image">
		        <img data-id="2" class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
		        <img data-id="3" class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
		        <img data-id="4" class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
		        <img data-id="5" class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
		        <img data-id="6" class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
		        <img data-id="7" class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
		        <img data-id="8" class="demo-chg-bg" src="img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
		    </div>
		</div> --}}
		<!--===================================================-->



    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->



    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="js/jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="js/nifty.min.js"></script>




    <!--=================================================-->

    <!--Background Image [ DEMONSTRATION ]-->
    <script src="js/demo/bg-images.js"></script>


    <script>
        let index=2;
        let max=8;

        function cambio(){
            console.log(cambio);
            $("img[data-id='" + index +"']").removeClass('active');
            $("img[data-id='" + index +"']").click();
            index++;
            $("img[data-id='" + index +"']").addClass('active');
            if (index==max){
                index=1;
            }
        }

        t=setInterval(cambio,10000);

    </script>

@endsection
