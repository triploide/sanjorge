<?php
class Pedido extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('pedido');
        $this->hasColumn('id', 'integer', 3, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('fecha', 'date');
        $this->hasColumn('descuento', 'decimal', 4);
        $this->hasColumn('total', 'decimal', 8);
        $this->hasColumn('costo', 'decimal', 8);
        $this->hasColumn('observaciones', 'string', 255);
        $this->hasColumn('id_estado','integer', 1, array('unsigned'=>true));
        $this->hasColumn('id_cliente','integer', 2, array('unsigned'=>true));
    }
    
    public function setUp()
    {
        $this->hasOne('EstadoPedido as estado',array(
            'local'=>'id_estado',
            'foreign'=>'id'
        ));
        $this->hasOne('Cliente as cliente', array(
            'local' => 'id_cliente',
            'foreign' => 'id'
        ));
        $this->hasMany('Item as items', array(
            'local' => 'id',
            'foreign' => 'id_pedido'
        ));
        //behaviors
        $this->actAs('Timestampable', array('created'=>array('disabled'=>true)));
    }

}
?>