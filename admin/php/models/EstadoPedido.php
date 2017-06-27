<?php
class EstadoPedido extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('estado_pedido');
        $this->hasColumn('id', 'integer', 1, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 50);
    }
    
    const ENTREGADO = 1;
    const PENDIENTE = 2;
    const CANCELADO = 3;

}
