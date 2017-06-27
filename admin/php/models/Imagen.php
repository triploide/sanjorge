<?php
class Imagen extends Doctrine_Record {

    public function setTableDefinition()
    {
        $this->setTableName('imagen');
        $this->hasColumn('id', 'integer', 3, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('src', 'string', 255);
        $this->hasColumn('orden', 'integer', 1, array('default'=>0));
        $this->hasColumn('id_producto', 'integer', 2, array('unsigned'=>true));
    }
    
    public function setUp()
    {
        $this->hasOne('Producto as producto',array(
            'local'=>'id_producto',
            'foreign'=>'id'
        ));
    }
    
    public static function lastId()
    {
        return Doctrine_Query::create()
            ->select('i.id')
            ->from('Imagen i')
            ->orderBy('i.id desc')
            ->limit(1)
            ->offset(0)
            ->fetchOne(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
        ;
    }
    
}
