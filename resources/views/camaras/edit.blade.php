<div class="panel" id="editor">
    <div class="panel">
        <div class="panel-heading">
            <div class="panel-control">
                <button class="btn btn-default" data-panel="dismiss"><i class="demo-psi-cross"></i></button>
            </div>
            <h3 class="panel-title">Modificar camara</h3>
        </div>
        <div class="panel-body">
            <form  action="{{url('camaras/update')}}" method="POST" name="frm_contador" id="frm_contador" class="form-ajax">
                <div class="row">
                    <input type="hidden" name="id" value="{{ $camara->id }}">
                    {{csrf_field()}}
                    <div class="form-group col-md-3">
                        <label for="">Nombre</label>
                        <input required type="text" name="etiqueta" id="etiqueta" class="form-control" required value="{{$camara->etiqueta}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">URL</label>
                        <input required type="text" name="url" id="url" class="form-control" required value="{{$camara->url}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Username</label>
                        <input type="text" name="username" id="username" class="form-control"  value="{{$camara->username}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Password</label>
                        <input type="text" name="password" id="password" class="form-control"  value="{{$camara->password}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="">IP</label>
                        <input required type="text" name="ip" id="ip" class="form-control" required  value="{{$camara->ip}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="">Puerto</label>
                        <input required type="number" min="0" max="65000" name="port" id="port" class="form-control" required  value="{{$camara->port}}">
                    </div>
                    <div class="col-md-2">
                        <label>Color</label><br>
                        <input type="text" name="val_color" id="val_color"  class="minicolors form-control" value="{{isset($camara->val_color)?$camara->val_Color:App\Classes\RandomColor::one(['luminosity' => 'bright'])}}" />
                    </div>



                    <div class="md-1 float-right" style="margin-top:22px">
                        @if(checkPermissions(['Camaras'],["W"]))<button type="submit" class="btn btn-primary">GUARDAR</button>@endif
                    </div>
                </div>
            </form>
        </div>
    </div>
 </div>

 <script>
    $('.minicolors').minicolors({
          control: $(this).attr('data-control') || 'hue',
          defaultValue: $(this).attr('data-defaultValue') || '',
          format: $(this).attr('data-format') || 'hex',
          keywords: $(this).attr('data-keywords') || '',
          inline: $(this).attr('data-inline') === 'true',
          letterCase: $(this).attr('data-letterCase') || 'lowercase',
          opacity: $(this).attr('data-opacity'),
          position: $(this).attr('data-position') || 'bottom',
          swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
          change: function(value, opacity) {
            if( !value ) return;
            if( opacity ) value += ', ' + opacity;
          },
          theme: 'bootstrap'
        });

    //$('#frm_contador').on('submit',form_ajax_submit);
    $('#frm_contador').submit(form_ajax_submit);

    $('.demo-psi-cross').click(function(){
        $('#editor').hide();
    })

 </script>
