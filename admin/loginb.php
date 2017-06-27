﻿<?php include('php/includes/config.php'); ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
    <?php include(INC.'admin/tpl/partials/head.tpl') ?>
</head>

<body class="hidden-menu">

    <?php 
        include('tpl/partials/header.tpl') ;
        //include('tpl/menu.tpl');
    ?>

    <!-- MAIN PANEL -->
    <div id="" role="main">
        <!-- MAIN CONTENT -->
            <div id="content" class="container">

                <div class="row">
                    <div class="col-md-4 hidden-sm hidden-xs"></div>
                     <div class="col-md-4">
                        <div class="well no-padding">
                            <form action="php/controllers/login.controller.php" method="post" id="login-form" class="smart-form client-form">
                                <header>
                                    Login
                                </header>

                                <fieldset>

                                    <section>
                                        <label class="label">Usuario</label>
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
    <!-- /MAIN PANEL -->

    <?php 
        include('tpl/partials/footer.tpl');
        include('tpl/partials/scripts.tpl');
    ?>


</body>
</html>