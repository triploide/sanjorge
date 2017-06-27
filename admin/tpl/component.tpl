<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment"> 
            <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                <i class="fa fa-refresh"></i>
            </span> 
        </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>Componentes</li><li>Nuevo componente    </li>
        </ol>
        <!-- end breadcrumb -->

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->

    </div>
    <!-- END RIBBON -->
    
    

    <!-- MAIN CONTENT -->
    <div id="content">

        <!-- row -->
        <div class="row">
            
            <!-- col -->
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    
                    <!-- PAGE HEADER -->
                    <i class="fa-fw fa fa-copy"></i> 
                        Nueva página
                </h1>
            </div>
            <!-- end col -->
            
        </div>
        <!-- end row -->
        
        <!--
            The ID "widget-grid" will start to initialize all widgets below 
            You do not need to use widgets if you dont want to. Simply remove 
            the <section></section> and you can use wells or panels instead 
            -->
        
        <!-- widget grid -->
        <section id="widget-grid" class="">
        
            <!-- row -->
            <div class="row">

                <!-- /preview -->
                <div class="col-sm-9">
                    <div class="well padding-10">
                        <h5 class="margin-top-0"><i class="fa fa-file-o"></i> Página</h5>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button> </span>
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
                <!-- /preview -->
                
                <!-- /arbol-->
                <div class="col-sm-3">
                    <div class="well padding-10">
                        <h5 class="margin-top-0"><i class="fa fa-sitemap"></i> Componentes</h5>
                        <div id="tree">
                            
                        </div>
                        <!-- /input-group -->
                    </div>
                </div>
                <!-- /arbol-->
                
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="well padding-10 bg-color-darken txt-color-white">
                        <p class="margin-top-0"><i class="fa fa-pencil"></i> Editor</p>
                        <div class="row">
                            <div class="col-md-4">uno</div>
                            <div class="col-md-4">dos</div>
                            <div class="col-md-4">tres</div>
                        </div>
                    </div>
                </div>
            </div>
        
        
        </section>
        <!-- end widget grid -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->