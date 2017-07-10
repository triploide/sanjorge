<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="/admin">Home</a></li>
            <li><a href="/admin/productos">Productos</a></li>
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
                    <i class="fa-fw fa fa-th-large"></i> 
                        Productos 
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
                            <div class="widget-toolbar" id="switch-1" role="menu">
                            <span class="widget-tolbar-loader onoffswitch-title" style="display: none"><i class="fa fa-spin fa-spinner"></i> Cargando</span>
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
                                <form id="form" action="/admin/php/controllers/producto.controller.php" method="post" class="smart-form" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-sm-6 col-xs-12 smart-form">
                                                <label class="label">Nombre:</label>
                                                <label class="input">
                                                    <input type="text" name="nombre" value="${nombre}" autofocus />
                                                </label>
                                            </section>
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Código:</label>
                                                <label class="input">
                                                    <input type="text" name="codigo" value="${codigo}" />
                                                </label>
                                            </section>
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Ubicación:</label>
                                                <label class="input">
                                                    <input type="text" name="ubicacion" value="${ubicacion}" />
                                                </label>
                                            </section>
                                        </div>

                                        <div class="row">
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Costo:</label>
                                                <label class="input">
                                                    <input type="text" name="costo" value="${costo}" data-type="float" />
                                                </label>
                                            </section>
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Valor de venta:</label>
                                                <label class="select">
                                                    <select class="form-control" name="tipo_precio" id="tipo-precio">
                                                        <option value="1" ${selectedMargen}>Margen (en función del costo)</option>
                                                        <option value="2" ${selectedPrecio}>Precio fijo</option>
                                                    </select>
                                                    <i></i>
                                                </label>
                                            </section>
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Margen (porcentual):</label>
                                                <label class="input">
                                                    <input type="text" name="margen" value="${margen}" data-type="float" />
                                                </label>
                                            </section>
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Precio:</label>
                                                <label class="input">
                                                    <input type="text" name="precio" value="${precio}" data-type="float" />
                                                </label>
                                            </section>
                                        </div>
 
                                        <div class="row">
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Stock:</label>
                                                <label class="input">
                                                    <input type="text" name="stock" value="${stock}" />
                                                </label>
                                            </section>
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Categoría:</label>
                                                <label class="select">
                                                    ${categoriaToSelect}<i></i>
                                                </label>

                                            </section>
                                            <section class="col col-sm-3 col-xs-12 smart-form">
                                                <label class="label">Estado:</label>
                                                <label class="select">
                                                    ${estadoToSelect}<i></i>
                                                </label>

                                            </section>
                                        </div>
                                                
                                    </fieldset>
                                    <input type="hidden" name="imgprefix" value="${imgprefix}" />
                                    <input type="hidden" name="id" value="${id}" />
                                </form>
                                
                                <div class="widget-footer smart-form">
                                    <div class="btn-group">
                                        <a href="javascript: window.history.back();" class="btn btn-sm btn-default" style="margin-right: 10px">
                                            Cancelar
                                        </a>
                                        <button class="btn btn-sm btn-success saveForm" type="submit">
                                            Guardar
                                        </button>   
                                    </div>
                                </div>

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

        <!-- widget grid slider -->
        <section id="slider" class="">

            <!-- row -->
            <div class="row">

                <!-- SLIDER -->
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
                            <span class="widget-icon"> <i class="fa fa-image"></i> </span>
                            <h2>Slider</h2>
                            <div class="widget-toolbar" style="display: none">
                                <div class="progress progress-striped active" rel="tooltip" data-original-title="0%" data-placement="bottom">
                                    <div class="progress-bar progress-bar-success" role="progressbar" style="width: 0%">0 %</div>
                                </div>
                            </div>
                        </header>

                        <!-- widget div-->
                        <div role="content">

                            <!-- widget content -->
                            <div class="widget-body">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-align-right">
                                        <div class="page-title">
                                            <form id="imagesUploader" action="php/uploaders/producto.uploader.php" method="post" enctype="multipart/form-data">
                                                <label class="btn btn-success" for="fileInput2">Cargar imágenes</label>
                                                <input class="hidden" id="fileInput2" onchange="Producto.forceUpload(this);" type="file" name="files[]" multiple />
                                                <input class="hidden" type="submit" value="Upload File to Server" />
                                                <input type="hidden" name="imgprefix" value="${imgprefix}" />
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- row -->
                                <div class="row">

                                    <!-- SuperBox -->
                                    <div id="sliderImagenes" class="col-sm-12">
                                        ${imagenes}
                                        <p class="empty">No hay imágenes cargadas</p>
                                        <div class="superbox-float"></div>
                                    </div>
                                    <!-- /SuperBox -->
                                    <script>
                                        ${data}
                                    </script>

                                </div>
                                <!-- /row -->

                            </div>
                            <!-- /widget content -->

                        </div>
                        <!-- /widget div-->

                    </div>

                </article>
                <!-- /SLIDER -->

            </div>
            <!-- /row -->

        </section>
        <!--/ widget grid slider -->


    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->