<?php
class Usuario extends Doctrine_Record {

    public function setTableDefinition()
    {
        $this->setTableName('usuario');
        $this->hasColumn('id', 'integer', 1, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('nombre', 'string', 50);
        $this->hasColumn('nick', 'string', 32);
        $this->hasColumn('pass', 'string', 64);
        $this->hasColumn('salt', 'string', 64);
        $this->hasColumn('id_estado', 'integer', 1, array('unsigned'=>true));
    }
    
     public function setUp()
     {
        $this->hasMany('Permiso as permisos', array(
            'local' => 'id_usuario',
            'foreign' => 'id_permiso',
            'refClass' => 'RelUsuarioPermiso'
        ));
        $this->actAs('Sluggable', array('fields'=>array('nombre'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
     }

    //INCIO DE GETERS Y SETERS
    public function setPass($pass)
    {
        $salt = uniqid(mt_rand(), true);
        $this->_set('pass', hash('sha256', $salt.$pass));
        $this->_set('salt', $salt);
    }
    //FIN SETERS Y GETERS

    static public function checkLogin($nick, $pass)
    {
        $q = Doctrine_Query::create()
                ->select('u.*')
                ->from('Usuario u')
                ->where('u.nick = ?', $nick);
        $usuario = $q->fetchOne();
        return ($usuario && $usuario->pass == hash('sha256', $usuario->salt.$pass)) ? $usuario : false;
    }
    
    public function permisosToIds()
    {
        $ids = Doctrine_Query::create()
                ->select('p.id')
                ->from('Permiso p')
                ->innerJoin('p.usuarios as u WITH u.id = ?', $this->id)
                ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
        return (is_array($ids))?$ids:array($ids);
    }

}
