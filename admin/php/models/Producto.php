<?php
class Producto extends Doctrine_Record {

    public function setTableDefinition()
    {
        $this->setTableName('producto');
        $this->hasColumn('id', 'integer', 2, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('nombre', 'string', 255);
        $this->hasColumn('codigo', 'string', 30);
        $this->hasColumn('stock', 'integer', 3);
        $this->hasColumn('costo', 'decimal', 8);
        $this->hasColumn('margen', 'decimal', 4);
        $this->hasColumn('precio', 'decimal', 8);
        $this->hasColumn('id_estado', 'integer', 1, array('default'=>1, 'unsigned'=>true));
        $this->hasColumn('id_categoria','integer', 1, array('unsigned'=>true));
    }
    
    public function setUp()
    {
        $this->hasOne('EstadoProducto as estado',array(
            'local'=>'id_estado',
            'foreign'=>'id'
        ));
        $this->hasOne('Categoria as categoria',array(
            'local'=>'id_categoria',
            'foreign'=>'id'
        ));
        $this->hasMany('Imagen as imagenes', array(
            'local' => 'id',
            'foreign' => 'id_producto'
        ));
        $this->hasMany('Item as items', array(
            'local' => 'id',
            'foreign' => 'id_producto'
        ));
        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('nombre'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
        $this->actAs('Versionable', array( 'versionColumn' => 'version', 'className' => '%CLASS%Version', 'auditLog' => true));
    }

}
