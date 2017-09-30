// JavaScript Document

function cargaSendMail(){
 
 
    $("#c_enviar").attr("disabled", true);
 
    $(".c_error").remove();
 
    var filter=/^[A-Za-z][A-Za-z0-9_.]*@[A-Za-z0-9_]+.[A-Za-z0-9_.]+.[A-za-z]$/;
    var s_name = $('#c_name').val();
	var s_email = $('#c_mail').val();
	var s_phone = $('#c_phone').val();
    var s_msg = $('#c_msg').val();
 	
	if (s_name.length == 0 ){
    $('#c_name').before( "<span class='c_error' id='c_error_name'>Ingrese su nombre.</span>" );
    var sendMail = "false";
    }
    if (filter.test(s_email)){
    sendMail = "true";
    } else{
    $('#c_mail').before("<span class='c_error' id='c_error_mail'>Ingrese e-mail valido.</span>");
     //aplicamos color de borde si el se encontro algun error en el envio
    $('#contactform').css("border-color","#e74c3c");   
    sendMail = "false";
    }
	if (s_phone.length == 0 ){
    $('#c_phone').before( "<span class='c_error' id='c_error_phone'>Ingrese su teléfono.</span>" );
    var sendMail = "false";
    }
    if (s_msg.length == 0 ){
    $('#c_msg').before( "<span class='c_error' id='c_error_msg'>Ingrese mensaje.</span>" );
    var sendMail = "false";
    }
 
    
    if(sendMail == "true"){
     
     var datos = {
 
            "nombre" : $('#c_name').val(),
			 
			 "telefono" : $('#c_phone').val(),
 
            "email" : $('#c_mail').val(),
 
            "mensaje" : $('#c_msg').val()
 
     };
 
     $.ajax({
 
             data:  datos,
             // hacemos referencia al archivo contacto.php
             url:   'contact.php',
 
             type:  'post',
 
             beforeSend: function () {
             //aplicamos color de borde si el envio es exitoso
                    $('#c_information').css("","");
 
                     $("#c_enviar").val("Enviando");
 
             },
 
             success:  function (response) {
 
                    $('form')[0].reset(); 
                    $("#c_enviar").val("Enviar");
                    $("#c_information p").html(response);
                    $("#c_information").fadeIn('slow');
                    $("#c_enviar").removeAttr("disabled");
                     
 
 
             }
 
     });
 
} else{
    $("#c_enviar").removeAttr("disabled");
}
 
}
