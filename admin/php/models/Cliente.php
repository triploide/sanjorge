<?php
class Cliente extends Doctrine_Record {

    public function setTableDefinition()
    {
        $this->setTableName('cliente');
        $this->hasColumn('id', 'integer', 2, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('email', 'string', 127);
        $this->hasColumn('pass', 'string', 64);
        $this->hasColumn('salt', 'string', 64);
        $this->hasColumn('cuit', 'string', 30);
        $this->hasColumn('horario', 'string', 80);
        $this->hasColumn('telefono', 'string', 20);
        $this->hasColumn('descuento', 'decimal', 4);
        $this->hasColumn('razon_social', 'string', 127);
        $this->hasColumn('direccion', 'string', 127);
        $this->hasColumn('estado', 'integer', 1, array('unsigned'=>true, 'default'=>1));
        $this->hasColumn('id_localidad','integer', 2, array('unsigned'=>true));
    }
    
    public function setUp()
    {
        $this->hasOne('Localidad as localidad',array(
            'local'=>'id_localidad',
            'foreign'=>'id'
        ));
        $this->hasMany('Pedido as pedidos', array(
            'local' => 'id',
            'foreign' => 'id_cliente'
        ));
    }
    
    public static function toAutocomplete()
    {
        $clientes = Doctrine_Query::create()
                ->select('c.razon_social as razon')
                ->from('Cliente c')
                ->where('c.estado = 1')
                ->orderBy('c.razon_social')
                ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
        return (is_array($clientes))?'"'.implode('","', $clientes).'"':'"'.$clientes.'"';
    }
    
    public static function numeroToAutocomplete()
    {
        $clientes = Doctrine_Query::create()
                ->select('c.id as razon')
                ->from('Cliente c')
                ->where('c.estado = 1')
                ->orderBy('c.id')
                ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
        return (is_array($clientes))?'"'.implode('","', $clientes).'"':'"'.$clientes.'"';
    }

    //INCIO DE GETERS Y SETERS
    public function setPass($pass)
    {
        $salt = uniqid(mt_rand(), true);
        $this->_set('pass', hash('sha256', $salt.$pass));
        $this->_set('salt', $salt);
    }
    //FIN SETERS Y GETERS

    static public function checkLogin($email, $pass)
    {
        $q = Doctrine_Query::create()
                ->select('c.*')
                ->from('Cliente c')
                ->where('c.email = ?', $email);
        $usuario = $q->fetchOne();
        return ($usuario && $usuario->pass == hash('sha256', $usuario->salt.$pass)) ? $usuario : false;
    }

}
