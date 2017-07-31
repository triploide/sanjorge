<!DOCTYPE html>
<html lang="ES">
<head>
<link rel="icon" type="image/png" href="/images/favicon.png" />
<title>Productos - SanJorGE</title>
<link href="/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="/css/style.css" type="text/css" rel="stylesheet" media="all">
<link rel="stylesheet" type="text/css" media="screen" href="/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="/css/smartadmin/production-plugins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="/css/smartadmin/production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="/css/smartadmin/skins.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<!-- //Custom Theme files -->
<!-- js -->
<script src="/js/jquery-1.11.1.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/modernizr.custom.js"></script>
<!-- //js -->
<style>
    .baner2 {min-height: auto}
    .logo {margin: 0}
</style>
</head>
<body>
	<!--baner-->
	<div class="baner2" id="home">
		<div class="container">
			<div class="logo">
				<h1> <a href="index.html"><img src="/images/logo.png"  alt=""/></a> </h1>
			</div>	
		</div>
	</div>
	<!--//baner-->

	<!--about-->
	<div class="about" id="about">
		<div class="container">
			<div class="row">
                <div class="col-md-4 hidden-sm hidden-xs"></div>
                 <div class="col-md-4">
                    <div class="well no-padding">
                        <form action="/clientes/login" method="post" id="login-form" class="smart-form client-form">
                            <header>
                                Área de clientes
                            </header>

                            <fieldset>

                                <section>
                                    <label class="label">Email</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="usuario" autofocus>
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Ingrese su nombre de usuario</b></label>
                                </section>

                                <section>
                                    <label class="label">Contraseña</label>
                                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="pass">
                                        <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Ingrese su contraseña</b> </label>
                                </section>

                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>
                            </footer>
                        </form>

                    </div>

                </div>
                <div class="col-md-4 hidden-sm hidden-xs"></div>
            </div>
		</div>	
	</div>
	<!--//about-->
	
	<!--footer-->
	<div class="footer">
		<div class="container">
			<p> © SanJorGE Suspensión - Todos los derechos reservados - Av. Don Bosco 2401, Morón (Esq. French) Tel: 11 4696-1771 Nextel: 159*9205 Whatsapp: 11-6417-6371  | Diseñado por <a href="http://mlmpublicidad.com.ar/" target="_blank">MLM Publicidad</a></p>
		</div>
	</div>
	<!--//footer-->

    <script src="/js/bootstrap.js"></script>
    <script>
        var navoffeset=$(".top-nav").offset().top;
        $(window).scroll(function(){
            var scrollpos=$(window).scrollTop(); 
            if(scrollpos >=navoffeset){
                $(".top-nav").addClass("fixed");
            }else{
                $(".top-nav").removeClass("fixed");
            }
        });
    </script>

</body>
</html>