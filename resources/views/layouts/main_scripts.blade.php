<script>
    ///Variables globales de la aplicacion ////
    let modal_open = false;   //Indica si hay ventanas modales abiertas


    //Funciones para mostrar los mensajes Toast
    function toast_ok(titulo,mensaje){
        $.toast({
            heading: titulo,
            text: mensaje,
            position: 'bottom-right',
            showHideTransition: 'slide',
            loaderBg: '#ff8000',
            icon: 'success',
            hideAfter: 3000,
            stack: 6,
            bgColor : '#d4edda',
            textColor : '#155724',
        });
    }
    function toast_error(titulo,mensaje){
        $.toast({
            heading: titulo,
            text: mensaje,
            position: 'bottom-right',
            showHideTransition: 'slide',
            loaderBg: '#ff8000',
            icon: 'error',
            hideAfter: 10000,
            stack: 6,
            bgColor : '#f8d7da',
            textColor : '#721c24',
        });
    }
    function toast_warning(titulo,mensaje){
        $.toast({
            heading: titulo,
            text: mensaje,
            position: 'bottom-right',
            showHideTransition: 'slide',
            loaderBg: '#ff8000',
            icon: 'warning',
            hideAfter: 6000,
            stack: 6,
            bgColor : '#fff3cd',
            textColor : '#856404',
        });
    }

    //Mostrara un sweet alert indicando que hay algo leyendo en la pagina. Para quitarlo se llama a fin_espere()
    function block_espere(mensaje="Cargando... espere"){
        sw=Swal.fire({
            title: mensaje,
            footer: '<img src="/imgs/onthespot_10.png" class="float-right">',
            allowEscapeKey: true,
            allowOutsideClick: false,
            timer: 90000
            });
        Swal.showLoading();
    }

    function fin_espere(){
        Swal.close();
    }

    //Para poner animaciones en caulquier elennto
    function animateCSS(element, animationName, callback) {
        const node = document.querySelector(element)
        node.classList.add('animated', animationName)

        function handleAnimationEnd() {
            node.classList.remove('animated', animationName)
            node.removeEventListener('animationend', handleAnimationEnd)

            if (typeof callback === 'function') callback()
        }

        node.addEventListener('animationend', handleAnimationEnd)
    }

    //PAra ocultar automaticamente las notificaciones flash que no sean errores
    $('div.alert').not('.alert-important,.alert-danger,.not-dismissable').delay(5000).fadeOut(350);

    //Inicilizacion de los controles select2
    $('.select2').select2();

    //Inicializacion del picker de colores
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

    //Esta clase te permite poner un link en cualquier elemento
    $('.hover-this').click(function(event) {
        if (!modal_open) {
            if ($(this).data('href')) {
                window.open($(this).data('href'),'_self');
            }
        }
    });

    //Para mostrar los password
    $('.toggle-password').click(function(event) {
        if ($(this).parent().prev().attr('type') == "password") {
            $(this).parent().prev().attr('type',"text")
        }else{
            $(this).parent().prev().attr('type',"password")
        }
    });

    // when any modal is opening
    $('.modal').on('shown.bs.modal', function (e) {
      // disable your handler
      modal_open = true;
    })

    // when any modal is closing
    $('.modal').on('hidden.bs.modal', function (e) {
      // enable your handler
      modal_open = false;
    })


    $('.form-ajax').submit(form_ajax_submit);

    //Form enviado por AJAX con notificaciones mediabte TOAST
    function form_ajax_submit(event){
        event.preventDefault();

        //$(this).block({ message: "<br><img src='{{url('ajax-loader.gif')}}' style='width:50px'><br><br>" });
        block_espere();

        let form = $(this);

        let data = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            contentType: false,
            processData: false,
            data: data,
        })
        .done(function(data) {
            if(data.error){
                toast_error(data.title,data.error);
            } else if(data.alert){
                toast_warning(data.title,data.alert);
            } else{
                toast_ok(data.title,data.message);
            }

            if (data.theme && data.is_auth) {
                //console.log(data);
                localStorage.setItem('theme',data.theme)
                //$('#theme').attr('href','{{url('monster-admin/main')}}/css/colors/'+data.theme+'.css')
            }
            $('.modal').modal('hide');



            setTimeout(()=>{
                if(data.url=="reload()"){
                    top.location.reload();
                }else if(data.url=="reload_acciones()"){
                    $('#acciones_regla').load("{{ url('/eventos/acciones/') }}/"+data.id);
                } else {
                    window.open(data.url,'_self');
                }
            },3000)
        })
        .fail(function(err) {
            let error = JSON.parse(err.responseText);
            let html =error.message;
            console.log(error);
            $.each(error.errors, function(index, val) {
                 html += "- "+$(this)[0]+"<br>";
            });
            toast_error("Error:",html);
        })
        .always(function() {
            fin_espere();
            console.log("FORM complete");
            form.find('[type="submit"]').attr('disabled',false);
        });
    }


    $('#loginform,#recoverform').submit(function(event) {
        event.preventDefault();
        $('#spin_login').show();
        $.post($(this).attr('action'), $(this).serializeArray(), function(data, textStatus, xhr) {
            if (data.recover) {
                console.log("Enviado login")
                toast_ok("Login", data.msg)

                $('#recoverform')[0].reset();
                setTimeout(()=>{
                    $('#recoverform').hide();
                    $('#loginform').show();
                    $('#login_email').val($('#login_remember').val());
                },3000)
            }else{
                localStorage.setItem('theme',data.theme);
                window.open('{{url('/login')}}','_self');
            }
        }).fail(function(r){
            console.log(r.responseJSON.message);
            toast_error("Registro",r.responseJSON.message);
        })
        .always(function(){
            $('#spin_login').hide();
        });
    });
    //Para el formulario del index.blade bitacoras
    function ajax_filter(event) {
        block_espere("Obteniendo datos...");
        let form = $(this);
        event.preventDefault();

        $('#action_orig').val($(this).attr('action'));

        $.post($(this).attr('action'), $(this).serializeArray(), function(data, textStatus, xhr) {
        block_espere("Renderizando datos...");

        $('#myFilter').html(data);
        fin_espere();

        })
        .fail(function(err) {
        let error = JSON.parse(err.responseText);
        console.log(error);

        toast_error("ERROR",error.message);
        })
        .always(function() {
        fin_espere();
        //console.log("complete");
        form.find('[type="submit"]').attr('disabled',false);
        });
        }

        function get_ajax(url,spin){
        console.log(url+" "+spin);
            if(spin!=null){
                $('#'+spin).show();
            }
        $.ajax({
        url: url
        })
        .done(function(data) {
        if(data.error){
        toast_error(data.title,data.error);
        } else if(data.warning){
        toast_warning(data.title,data.alert);
        } else{
        toast_ok(data.title,data.message);
        }
        $('.modal').modal('hide');
        setTimeout(()=>{
        if(data.url)
        window.open(data.url,'_self');
        if(data.reload)
        window.location.reload();
        },3000)
        })
        .fail(function(err) {
        let error = JSON.parse(err.responseText);
        let html = "";
        console.log(error);
        $.each(error.errors, function(index, val) {
        html += "- "+$(this)[0]+"<br>";
        });
        toast_error("Error",html);
        })
        .always(function() {
        fin_espere();
        console.log("complete");
        if(spin!=null){
        $('#'+spin).hide();
        }
        });
}

</script>
