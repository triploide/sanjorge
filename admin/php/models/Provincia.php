<?php
class Provincia extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('provincia');
        $this->hasColumn('id', 'integer', 1, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 150);
    }

    public function setUp() {
        $this->hasMany('Localidad as localidades', array(
            'local' => 'id',
            'foreign' => 'id_provincia',
            'onUpadate' => 'CASCADE'
        ));
    }

    var $selected = false;
    
    public static function findLocalidades ($id) {
        return Doctrine_Query::create()
                ->select('l.*')
                ->from('Localidad l')
                ->innerJoin('l.provincia p WITH p.id = '.$id)
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
                ;
    }

    public static function toSelect($objeto=false) {
        $provinciaId = ($objeto)?$objeto->localidad->provincia->id:0;
        $provincias = Doctrine::getTable('provincia')->findAll(Doctrine::HYDRATE_ARRAY);
        $html = '<select name="provincia">';
        $html .= '<option value="">Elegir</option>';
        foreach ($provincias as $prov) {
            $selected = ($prov['id'] == $provinciaId)?$selected = ' selected="selected"':$selected = '';
            $html .= '<option value="'.$prov['id'].'"'.$selected.'>'.$prov['value'].'</option>';
        }
        $html .= '</select>';
        return $html;
    }

}
?>