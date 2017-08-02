<?php
class Importacion extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('importacion');
        $this->hasColumn('id', 'integer', 3, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('fecha', 'date');
        $this->hasColumn('total_errores', 'integer', 2, array('unsigned'=>true, 'default' => 0));
        $this->hasColumn('total_nuevos', 'integer', 2, array('unsigned'=>true, 'default' => 0));
        $this->hasColumn('total_general', 'integer', 2, array('unsigned'=>true, 'default' => 0));
    }
    
    public function setUp()
    {
        $this->hasMany('ImportacionLog as logs', array(
            'local' => 'id',
            'foreign' => 'id_importacion'
        ));
    }

}
