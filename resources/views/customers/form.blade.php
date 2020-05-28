
@section('css')
<style>
    .floating-like-gmail {
        position: absolute;
        bottom: 8px;
        right: 10px;
        max-width: 100vw;
        width: 600px;
        right: 10px;
        text-align: right;
        opacity: 0;
        transition: 500ms;
    }
    .modal {
        text-align: center !important;
    }
    .hover-this:hover .floating-like-gmail,.floating-like-gmail:hover {
        opacity: 1;
    }
    .preview {
        width: 100%;
        height: 200px;
        background-position: center;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 6px;
        overflow: hidden;
    }
    .img-preview {
        height: 100px;
        /*width: 100px;*/
        background-position: center;
        background-size: cover;
    }
    #img-inputs input {
        display: none;
        height: 0;
    }
    .sidebar-footer a {
        width: 50%;
    }
    .user-profile .profile-img::before {
        left: 0;
        right: 0;
    }
</style>
@endsection
<input type="hidden" name="id_cliente" value="{{ isset($clientes->id_cliente)?$clientes->id_cliente:0 }}">
<div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="form-group col-md-10 {{ $errors->has('nom_cliente') ? 'has-error' : '' }}">
                    <label for="nom_cliente" class="control-label">Nombre</label>
                    <input class="form-control" name="nom_cliente" type="text" id="nom_cliente" value="{{ old('nom_cliente', optional($clientes)->nom_cliente) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
                    {!! $errors->first('n', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2 text-center">

            <div class="col-12">
                <label for="img_logo" class="col-md-2 control-label">Imagen</label>
                <div class="form-group  {{ $errors->has('img_logo') ? 'has-error' : '' }}">
                    <label for="img_logo" class="preview preview1" style="background-image: url();">
                        <img src="{{ isset($clientes) ? url('/img/customers/',$clientes->img_logo) : ''}}" style="margin: auto; display: block; width: 180px; heigth:180px" alt="" class="img-fluid">

                        <label for="img_logo" class="col-md-2 control-label">Logo</label>

                    </label>
                    <div class="custom-file">
                        <input type="file" accept=".jpg,.png,.gif" class="form-control  custom-file-input" name="img_logo" id="img_logo" lang="es">
                        <label class="custom-file-label" for="img_logo"></label>
                    </div>
                </div>
                    {!! $errors->first('img_logo', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
</div>
<div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('id_cliente') ? 'has-error' : '' }}">

                {!! $errors->first('id_cliente', '<p class="help-block">:message</p>') !!}
            </div>

        </div>
        <div class="col-md-1"></div>

</div>

@section('scripts_modulo')
<script>
    function readURL(input,element) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            console.log(reader)
            reader.onload = function (e) {
                $(element).html('<img src="'+e.target.result+'" style="height: 100%; margin: auto; display: block;" alt="">');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".imgInp").change(function(){
        readURL(this,$(this).data('preview'));
    });
</script>
@endsection
