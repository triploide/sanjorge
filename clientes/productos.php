<?php
require '../admin/php/includes/configClientes.php';
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : array();
$categorias = Doctrine_Query::create()->select('*')->from('Categoria')->where('estado = 1')->orderBy('value')->execute();
?>
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
    nav ul {width: auto}
    .nav .badge { position: absolute; top: 5px; right: -5px;}
    @media (min-width: 768px) {
        .navbar-nav {float: right}
    }
    @media (max-width: 767px) {
        .navbar-default .navbar-nav > li > a {color: #fff}
        .baner2 {background-position: 0 0}
    }
    /*DATATABLES*/
    .dataTable .ui-sortable-placeholder::before {content: none !important;}
    .dataTable .ui-sortable-helper {height: 50px}
    .dataTable .sortable {cursor: move;}
    .dataTable th:last-child, .dataTable td:last-child {text-align: right;}
    .dataTables_empty {text-align: center !important;}
    .dataTable .row-detail th, .dataTable .row-detail td {text-align: left !important;}
    /* ----------- */

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
                        <li id="nav-pedido">
                            <a href="/clientes/pedido">Pedido
                            <span class="badge bg-color-red"><?php echo(count($cart)?count($cart):''); ?></span>
                            </a>
                        </li>
						<li><a href="/clientes/logout">Salir</a></li>
					</ul>	
					<div class="clearfix"> </div>
				</div>
			</div>	
		</nav>		
	</div>
	<!--navigation-->
	<!--about-->
	<div class="about" id="about" style="padding-bottom: 30px">
		<div class="container">
			<h3 class="title">Listado de productos</h3>
			<p style="font-size:1.2em">Buscá los productos que necesitás y agregalos a tu pedido</p>
		</div>	
	</div>
	<!--//about-->
	
	<!--gallery-->
	<div class="container" style="min-height: 550px">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <select id="categoria" class="form-control">
                    <option value="">Elija una categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo($categoria->slug); ?>"><?php echo($categoria->value); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-9 col-sm-6 text-right">
                <a class="btn btn-success" href="/productos/imprimir" target="_blank"><span class="fa fa-print"></span> Imprimir</a>
            </div>
        </div>
        <p>&nbsp;</p>
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false"  data-widget-colorbutton="false"  data-widget-togglebutton="false"  data-widget-deletebutton="false"  data-widget-sortable="false">
            <header>
                <h2>Listado de productos</h2>              
            </header>
            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
            		<table id="datatable" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>                         
                            <tr>
                                <th>Imagen</th>
                                <th data-hide="phone,tablet">Código</th>
                                <th data-class="expand">Nombre</th>
                                <th data-hide="phone">Precio</th>
                                <th data-hide="phone,tablet">Categoría</th>
                                <th><i class="fa fa-fw fa-cog text-muted hidden-md hidden-sm hidden-xs"></i> Agregar</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
	<!--gallery-->
	
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

    <!-- datatable -->
    <script src="/js/plugin/datatables/i18n/spanish.js"></script>
    <script src="/js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="/js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

    <script>
        var productosAgregados = <?php echo(json_encode($cart)) ?>
    </script>

    <script src="/clientes/js/productos.js"></script>
    <!-- /datatable -->
</body>
</html>