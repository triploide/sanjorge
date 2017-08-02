<?php
class ImportacionLog extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('importacion_log');
        $this->hasColumn('id', 'integer', 3, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('mensaje', 'string', 100);
        $this->hasColumn('tipo', 'integer', 1, array('default'=>2, 'unsigned'=>true)); //1: nuevo - 2: error
        $this->hasColumn('id_importacion', 'integer', 3, array('default'=>1, 'unsigned'=>true));
    }
    
    public function setUp()
    {
        $this->hasOne('Importacion as importacion',array(
            'local'=>'id_importacion',
            'foreign'=>'id'
        ));
    }

}
