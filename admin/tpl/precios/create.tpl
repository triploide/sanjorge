<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

        <!-- breadcrumb -->
        <ol class="breadcrumb">
            <li>Precios</li><li>Editar</li>
        </ol>
        <!-- /breadcrumb -->

    </div>
    <!-- /RIBBON -->

     <!-- STOCK -->
    <div id="content">

        <!-- row -->
        <div class="row">

            <!-- col -->
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">

                    <!-- PAGE HEADER -->
                    <i class="fa-fw fa fa-dollar"></i> 
                    Precios 
                    <span>>  
                        Editar
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
                
                <!-- WIDGET STOCK -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div 
                        class="jarviswidget" 
                        id="" 
                        data-widget-colorbutton="false" 
                        data-widget-editbutton="false" 
                        data-widget-togglebutton="false" 
                        data-widget-deletebutton="false" 
                        data-widget-sortable="false"
                    >
                        <header>
                            <h2>Precios</h2>
                        </header>

                        <!-- widget div-->
                        <div role="content">

                            <!-- widget content -->
                            <div class="widget-body">
                                
                                <table id="precios" class="table table-striped table-bordered table-hover smart-form" width="100%" style="margin-bottom: 20px">
                                    <thead>
                                        <tr>
                                            <th>C&oacute;digo</th>
                                            <th>Nombre</th>
                                            <th>Costo</th>
                                            <th>Tipo</th>
                                            <th>Magen %</th>
                                            <th>Precio</th>
                                            <th><i class="fa fa-times"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="input"><input name="codigo" type="text" value="" /></label>
                                            </td>
                                            <td>
                                                <label class="input"><input name="nombre" type="text" value="" /></label>
                                            </td>
                                            <td>
                                                <label class="input"><input class="costo" name="costo" type="text" value="" data-type="float" /></label>
                                            </td>
                                            <td>
                                                <select class="form-control" name="tipo_precio">
                                                    <option value="1">Margen (en función del costo)</option>
                                                    <option value="2">Precio fijo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <label class="input"><input name="margen" type="text" value="" data-type="float" /></label>
                                            </td>
                                            <td>
                                                <label class="input"><input class="precio" name="precio" type="text" value="" data-type="float" disabled /></label>
                                                <input type="hidden" name="item" value="" />
                                                <input type="hidden" name="producto" value="" />
                                            </td>
                                            <td><a class="btn btn-danger" style="padding: 5px 10px" onclick="removeItem(this)"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <footer>
                                    <form id="form" action="php/controllers/precio.controller.php" method="post" style="display: inline-block;">
                                        <button tabindex="-1" type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Guardar
                                        </button>
                                    </form>
                                    <a class="btn btn-success addItem">
                                        <i class="fa fa-plus"></i> Agregar
                                    </a>
                                </footer>
                            </div>
                            <!-- /widget content -->

                        </div>
                        <!-- /widget div -->
                        

                    </div>
                    <!-- /widget -->

                </article>
                <!-- /WIDGET STOCK -->
                
               
            </div>

            <!-- /row -->

        </section>
        <!-- /widget grid -->

    </div>
    <!-- /STOCK -->
</div>