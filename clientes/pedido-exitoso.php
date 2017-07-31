<?php require '../admin/php/includes/configClientes.php'; ?>
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
<link rel="stylesheet" type="text/css" href="/js/plugin/stepper/jquery.fs.stepper.css">
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
    nav ul {width: auto}
    .nav .badge { position: absolute; top: 5px; right: -5px;}
    @media (min-width: 768px) {
        .navbar-nav {float: right}
    }
    @media (max-width: 767px) {
        .navbar-default .navbar-nav > li > a {color: #fff}
        .baner2 {background-position: 0 0}
    }
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
	<!--navigation-->
	<div class="top-nav">
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html"><img src="/images/logo2.png"  alt=""/></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-center cl-effect-15">
                        <li><a href="/clientes/productos" class="active">Productos</a></li>
                        <li id="nav-pedido"><a href="/clientes/pedido">Pedido</a></li>
						<li><a href="/clientes/logout">Salir</a></li>
					</ul>	
					<div class="clearfix"> </div>
				</div>
			</div>	
		</nav>		
	</div>
	<!--navigation-->
	<!--about-->
	<div class="about" id="about">
		<div class="container">
			<h3 class="title">El pedido se realizó con éxito</h3>
			<p style="font-size:1.2em">Muchas gracias por su pedido. En breve estaremos pasando para realizar la entrega. Ante cualquier duda o consulta se puede comunicar con nosotros mediante cualquiera de los medios disponibles al efecto.</p>
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

</body>
</html>