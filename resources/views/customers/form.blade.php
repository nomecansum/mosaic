
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
<div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="form-group col-md-10 {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="control-label">Nombre</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ old('name', optional($clientes)->name) }}" minlength="1" maxlength="255" required="true" placeholder="Enter name here...">
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-10 {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="control-label">e-mail</label>
                    <input class="form-control" name="email" type="text" id="email" value="{{ old('email', optional($clientes)->email) }}" minlength="1" maxlength="255" required="true" placeholder="Enter email here...">
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-10 {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>
                    <input class="form-control" name="password" type="password" id="password" value="{{ old('password', optional($clientes)->password) }}" minlength="1" maxlength="255" required="true" placeholder="Enter password here...">
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2 text-center">
            <label for="imagen_usuario" class="col-md-2 control-label">Imagen</label><br>
            <div class="col-12">
                <div class="form-group  {{ $errors->has('img_usuario') ? 'has-error' : '' }}">
                    <label for="img_usuario" class="preview preview1" style="background-image: url();">
                        <img src="{{ isset($clientes) ? url('img/clientes/',$clientes->img_usuario) : ''}}" style="margin: auto; display: block; width: 180px; heigth:180px" alt="" class="img-fluid">
                    </label>
                    <div class="custom-file">
                        <input type="file" accept=".jpg,.png,.gif" class="form-control  custom-file-input" name="img_usuario" id="img_usuario" lang="es">
                        <label class="custom-file-label" for="img_usuario"></label>
                    </div>
                </div>
                    {!! $errors->first('img_usuario', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
</div>
<div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
            <div class="form-group {{ $errors->has('id_perfil') ? 'has-error' : '' }}">

                {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
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
