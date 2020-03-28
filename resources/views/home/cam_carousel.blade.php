<style>
    .rounded_cam{
        border-radius: 6px;
    }

</style>

<div id="demo-panel-network" class="panel pb-3">
    <div class="panel-heading">
        <div class="panel-control">
            <button id="demo-panel-network-refresh" class="btn btn-default btn-active-primary" data-toggle="panel-overlay" data-target="#mosaico"><i class="demo-psi-repeat-2"></i></button>
            <div class="dropdown">
                <button class="dropdown-toggle btn btn-default btn-active-primary" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical"></i></button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>
        </div>
        <h3 class="panel-title">Camaras(<span id="paginade"></span>/<span id="paginatotal"></span>)</h3>
    </div>

    <div class="row" id="mosaico">
        @for ($i = 0; $i < 6; $i++)
        <div class="col-md-4">
            <div id="feedimg{{$i}}" class="mar-lft mar-rgt mar-top rounded_cam" style="border: thin solid gray; with:300px; height: 300px">
                <img id="imgcam{{$i}}" style="width:100%; height:100%" class="rounded_cam imgcam">
                <div class="p-2 mb-4 bg-mid-gray"><span class="badge badge-header badge-success float-left"></span><span id="label{{$i}}" class="float-left"></span></div>
            </div>

        </div>
        @endfor
    </div>
    <button id="save">Save</button>

</div>
@section('scripts')
    <script>
        let paginas;
        let datos;
        let pagina=0;
        let refresco=20000;

        function proceso(){
            bloque=datos[pagina];
            //console.log(bloque);
            indice=0;
            $.each(bloque,function(j,item){
                setTimeout(() => {
                    $('#imgcam'+indice).attr("src",item.url);
                    $('#label'+indice).html(item.etiqueta);
                    $('#paginade').html(pagina+1);
                    $('#paginatotal').html(paginas);
                    indice++;
                }, 500);
            })
            pagina++;
            if(pagina>=paginas){
                pagina=0;
            }
        }

        $('#demo-panel-network-refresh').click(function(){
            pagina=0;
            clearInterval(int_proceso);
            cargar_camaras();
        });

        function cargar_camaras(){
            $.get("{{ url('/6camaras/') }}/",function(data){
                data=JSON.parse(data);
                paginas=data.length;
                datos=data;
                proceso();
                int_proceso=setInterval(proceso, refresco);
            });
        }

        $(function(){
            cargar_camaras();
        });

        $('.imgcam').on('error', function(){

            setTimeout(() => {
                console.log('Error CAM '+$(this).attr("src")+' Releyendo');
                src=$(this).attr("src");
                $(this).attr("src",'');
                $(this).attr("src",src);
            }, 500);
        });


        document.getElementById('save').onclick = function () {

        var c = document.createElement('canvas');
        var img = document.getElementById('imgcam1');
        c.width = img.width;
        c.height = img.height;
        var ctx = c.getContext('2d');


        ctx.drawImage(img, 0, 0);
        //window.location = c.toDataURL('image/png');
        window.open(c.toDataURL('image/png'))
        };


    </script>
@endsection
