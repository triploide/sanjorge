<?php
class Permiso extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('permiso');
        $this->hasColumn('id', 'integer', 1, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 30);
    }
    
    public function setUp()
    {
        $this->hasMany('Usuario as usuarios', array(
            'local' => 'id_permiso',
            'foreign' => 'id_usuario',
            'refClass' => 'RelUsuarioPermiso'
        ));
     }
    
    //ATAJOS
    const PRODUCTOS = 1;
    const STOCK = 2;
    const PEDIDOS = 3;
    const CLIENTES = 4;
    const CATEGORIAS = 5;

}
