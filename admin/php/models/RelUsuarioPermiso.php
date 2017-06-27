<?php
class RelUsuarioPermiso extends Doctrine_Record {
    public function setTableDefinition()
    {
	$this->setTableName('rel_usuario_permiso');
        $this->hasColumn('id_usuario', 'integer', 2, array(
            'primary' => true,
            'unsigned'=>true,
        ));
        $this->hasColumn('id_permiso', 'integer', 1, array(
            'primary' => true,
            'unsigned'=>true,
	));
    }
}
