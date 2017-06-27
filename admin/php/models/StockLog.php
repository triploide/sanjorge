<?php
class StockLog extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('stock_log');
        $this->hasColumn('id', 'integer', 3, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('fecha', 'date');
        
    }
    
    public function setUp()
    {
        $this->hasMany('StockItem as items', array(
            'local' => 'id',
            'foreign' => 'id_stock_log'
        ));
    }

}
