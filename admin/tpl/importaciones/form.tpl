<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="/admin">Home</a></li>
            <li>Importar</li>
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
                    <i class="fa-fw fa fa-upload"></i> 
                        Productos 
                    <span>>  
                        Importar
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
                            <h2>Importar</h2>               
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
                                <form id="form" action="/admin/php/controllers/importar.controller.php" method="post" class="smart-form" enctype="multipart/form-data">
                                    <fieldset>
                                        <div class="row">
                                            <section class="col col-sm-12 col-xs-12">
                                                <label class="label">Archivo Excel:</label>
                                                <label class="input">
                                                    <input type="file" name="csv" value="" />
                                                </label>
                                            </section>
                                        </div>
                                    </fieldset>
                                </form>
                                
                                <div class="widget-footer smart-form">
                                    <div class="btn-group">
                                        <a href="javascript: window.history.back();" class="btn btn-sm btn-default" style="margin-right: 10px">
                                            Cancelar
                                        </a>
                                        <button class="btn btn-sm btn-success saveForm" type="submit">
                                            Importar
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

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->