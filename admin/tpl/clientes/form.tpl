<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="/admin">Home</a></li>
            <li><a href="/admin/productos">Clientes</a></li>
            <li>${accion}</li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">

        <!-- row -->
        <div class="row">

            <!-- col -->
            <div class="col-xs-12 col-sm-7 col-md-4">
                <h1 class="page-title">
                    <i class="fa-fw fa fa-users"></i> 
                        Clientes 
                    <span>>  
                        ${accion}
                    </span>
                </h1>
            </div>
            <!-- /col -->

        </div>
        <!-- /row -->

        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->
            <div class="row">

                <!-- WIDGET DESIGN -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div 
                        class="jarviswidget jarviswidget-color-darken" 
                        id="" 
                        data-widget-colorbutton="false" 
                        data-widget-editbutton="false" 
                        data-widget-togglebutton="false" 
                        data-widget-deletebutton="false" 
                        data-widget-sortable="false"
                    >
                        <header>
                            <span class="widget-icon"> <i class="fa fa-${icon}"></i> </span>
                            <h2>${title}</h2>
                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">
                                <form id="form" action="/admin/php/controllers/cliente.controller.php" method="post" class="smart-form" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label">Razón Social:</label>
                                                <label class="input">
                                                    <input type="text" name="razon_social" value="${razonSocial}" autofocus />
                                                </label>
                                            </section>
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label">Email:</label>
                                                <label class="input">
                                                    <input type="text" name="email" value="${email}" />
                                                </label>
                                            </section>
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label">Contraseña:</label>
                                                <label class="input">
                                                    <input type="text" name="password" value="${password}" />
                                                </label>
                                            </section>
                                        </div>

                                        <div class="row">
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label">Horario:</label>
                                                <label class="input">
                                                    <input type="text" name="horario" value="${horario}" />
                                                </label>
                                            </section>
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label">Teléfono:</label>
                                                <label class="input">
                                                    <input type="text" name="telefono" value="${telefono}" />
                                                </label>
                                            </section>
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label">Cuit:</label>
                                                <label class="input">
                                                    <input type="text" name="cuit" value="${cuit}" />
                                                </label>
                                            </section>
                                        </div>
 
                                        <div class="row">
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label">Dirección:</label>
                                                <label class="input">
                                                    <input type="text" name="direccion" value="${direccion}" />
                                                </label>
                                            </section>
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label">Provincia:</label>
                                                <label class="select">
                                                    ${provinciaToSelect}<i></i>
                                                </label>
                                            </section>
                                            <section class="col col-sm-4 col-xs-12 smart-form">
                                                <label class="label"><i class="fa fa-spin fa-spinner" id="loader-localidad" style="display: none"></i> Localidad:</label>
                                                <label class="select">
                                                    ${localidadToSelect}<i></i>
                                                </label>
                                            </section>
                                        </div>
                                                
                                    </fieldset>
                                    <footer>
                                        <button type="submit" class="btn btn-success">
                                            Cargar
                                        </button>
                                    </footer>
                                    <input type="hidden" name="id" value="${id}" />
                                </form>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- /widget div -->

                    </div>
                    <!-- /widget -->

                </article>
                <!-- /WIDGET DESIGN -->

            </div>

            <!-- /row -->

        </section>
        <!-- /widget grid -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->