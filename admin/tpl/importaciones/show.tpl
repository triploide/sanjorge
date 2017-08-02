<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li><a href="">Home</a></li>
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
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa-fw fa fa-upload"></i> Importación <span>> Resultado</span>
                </h1>
            </div>
            <!-- end col -->
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
                            <h2>Resultado de la importación</h2>
                            <ul class="nav nav-tabs pull-right in" id="myTab">
                                <li class="active">
                                    <a data-toggle="tab" href="#s1">Nuevos productos</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#s2">Errores</a>
                                </li>
                            </ul>         
                        </header>
        
                        <!-- widget div-->
                        <div>
                            <!-- widget content -->
                            <div class="widget-body">
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade active in" id="s1">
                                        <table id="datatable-nuevos" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>                         
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th data-class="expand">Mensaje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade in" id="s2">
                                        <table id="datatable-errores" class="table table-striped table-bordered table-hover" width="100%">
                                            <thead>                         
                                                <tr>
                                                    <th data-class="expand">Tipo</th>
                                                    <th data-class="expand">Mensaje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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