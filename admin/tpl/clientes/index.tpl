<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="">Home</a></li>
            <li>Clientes</li>
        </ol>
        <!-- end breadcrumb -->
    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">

        <!-- row -->
        <div class="row">
            
            <!-- col -->
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa-fw fa fa-users"></i> Clientes <span>>  Listado</span>
                </h1>
            </div>
            <!-- end col -->
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right">
                <a href="cliente" class="btn btn-success"><span class="fa fa-plus"></span> Agregar</a>
            </div>
        </div>
        <!-- end row -->
        
        <!-- widget grid -->
        <section id="widget-grid" class="">
        
            <!-- row -->
            <div class="row">
                
                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <!-- Widget ID (each widget will need unique ID)-->
                    <div
                        class="jarviswidget"
                        id="wid-id-1"
                        data-widget-editbutton="false" 
                        data-widget-colorbutton="false" 
                        data-widget-togglebutton="false" 
                        data-widget-deletebutton="false" 
                        data-widget-sortable="false"
                    >

                        <header>
                            <h2>Listado de clientes</h2>              
                        </header>
        
                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <table id="datatable" class="table table-striped table-bordered table-hover" width="100%">
                                    <thead>                         
                                        <tr>
                                            <th data-class="expand">Razón social</th>
                                            <th data-hide="phone,tablet">Horario</th>
                                            <th data-hide="phone,tablet">Email</th>
                                            <th data-hide="phone,tablet">Dirección</th>
                                            <th><i class="fa fa-fw fa-cog text-muted hidden-md hidden-sm hidden-xs"></i> Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->
                        
                    </div>
                    <!-- end widget -->
        
                </article>
                <!-- WIDGET END -->
                
            </div>
            <!-- end row -->
        
        </section>
        <!-- end widget grid -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->