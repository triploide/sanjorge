<?php
class StockItem extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('stock_item');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('cantidad', 'integer', 3);
        $this->hasColumn('costo', 'decimal', 8); //costo por unidad
        $this->hasColumn('precio', 'decimal', 8); //precio por unidad
        $this->hasColumn('id_producto','integer', 2, array('unsigned'=>true));
        $this->hasColumn('id_stock_log','integer', 3, array('unsigned'=>true));
        
    }
    
    public function setUp(){
        $this->hasOne('Producto as producto',array(
            'local'=>'id_producto',
            'foreign'=>'id'
        ));
        $this->hasOne('StockLog as log', array(
            'local' => 'id_stock_log',
            'foreign' => 'id'
        ));
    }

}
?>