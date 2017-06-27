runAllForms();

$(function() {
    // Validation
    $("#login-form").validate({
        // Rules for form validation
        rules : {
            email : {
                required : true,
            },
            password : {
                required : true,
            }
        },

        // Messages for form validation
        messages : {
            email : {
                required : 'Ingresá tu nombre de usuario',
            },
            password : {
                required : 'Ingresá tu contraseña'
            }
        },

        // Do not change code below
        errorPlacement : function(error, element) {
            error.insertAfter(element.parent());
        }
    });

    Box.small({title: 'Error en los datos', content: 'El usuario o la contraseña son incorrectos.'})
        .error()
        .showIfHash('error')
    ;
    Box.small({title: 'Usuario borrado', content: 'El usuario con el que trata de acceder fue eliminado.'})
        .error()
        .showIfHash('banned')
    ;

});