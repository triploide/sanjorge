<?php
require '../admin/php/includes/configClientes.php';
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : array();
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
    /*DATATABLES*/
    .dataTable .ui-sortable-placeholder::before {content: none !important;}
    .dataTable .ui-sortable-helper {height: 50px}
    .dataTable .sortable {cursor: move;}
    .dataTable th:last-child, .dataTable td:last-child {text-align: right;}
    .dataTables_empty {text-align: center !important;}
    .dataTable .row-detail th, .dataTable .row-detail td {text-align: left !important;}
    /* ----------- */

    /*Stepper*/
    .stepper {width: 80px}
    /*-------*/

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
			<h3 class="title">Pedido</h3>
			<p style="font-size:1.2em">Indicá las cantidades que vas a solicitar de cada item antes de realizar tu pedido.</p>
		</div>	
	</div>
	<!--//about-->
	
	<!--gallery-->
	<div class="container">
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false"  data-widget-colorbutton="false"  data-widget-togglebutton="false"  data-widget-deletebutton="false"  data-widget-sortable="false">
            <header>
                <h2>Pedido</h2>              
            </header>
            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="table-responsive">
                		<table id="datatable" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>                         
                                <tr>
                                    <th data-hide="phone">Remover</th>
                                    <th data-hide="phone,tablet">Código</th>
                                    <th data-class="expand">Nombre</th>
                                    <th data-class="expand">Cantidad</th>
                                    <th data-hide="phone">Precio</th>
                                    <th data-hide="phone">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart'])): ?>
                                    <?php $totalFinal = 0; ?>
                                    <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                                        <?php $producto = Doctrine::getTable('Producto')->find($key); ?>
                                        <?php $totalFinal += $producto->precio * $item['cantidad'] ?>
                                        <tr>
                                            <td><a href="remover-producto" data-id="<?php echo($producto->id); ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                            <td><?php echo($producto->codigo); ?></td>
                                            <td><?php echo($producto->nombre); ?></td>
                                            <td>
                                                <input class="cantidad" type="number" name="cantidad[]" value="<?php echo($item['cantidad']); ?>" min="1" max="<?php echo($producto->stock); ?>" pattern="[0-9]*" data-id="<?php echo($producto->id); ?>">
                                            </td>
                                            <td class="precio">$ <?php echo( number_format($producto->precio, 0, ',', '.')); ?></td>
                                            <td class="total" style="text-align: right;">$ <?php echo( number_format($producto->precio * $item['cantidad'], 0, ',', '.')); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr style="height: 100px">
                                        <td colspan="6" style="text-align: center; vertical-align:middle">No hay productos seleccionados</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart'])): ?>
                                <tfoot>
                                    <tr>
                                        <td class="total-final" style="text-align: right;" colspan="6"><strong>$ <?php echo(number_format($totalFinal, 0, ',', '.')); ?></strong></td>
                                    </tr>
                                </tfoot>
                            <?php endif; ?>
                        </table>
                    </div>
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart'])): ?>
                        <p style="padding: 10px; text-align: right;" id="btn-pedido"><a href="hacer-pedido" class="btn btn-success"><span class="fa fa-spin fa-spinner" style="display: none"></span> <span class="text">Hacer pedido</span></a></p>
                    <?php endif; ?>
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

    <script src="/js/plugin/stepper/jquery.fs.stepper.min.js"></script>
    <script src="/clientes/js/pedido.js"></script>
    <!-- /datatable -->
</body>
</html>