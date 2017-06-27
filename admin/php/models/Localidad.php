<?php
class Localidad extends Doctrine_Record {

    public function setTableDefinition() {
        $this->setTableName('localidad');
        $this->hasColumn('id', 'integer', 2, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 150);
        $this->hasColumn('id_provincia', 'integer', 1, array('unsigned'=>true));
    }

    public function setUp() {
        $this->hasOne('Provincia as provincia', array(
            'local' => 'id_provincia',
            'foreign' => 'id',
            'onUpadate' => 'CASCADE'
        ));
    }
    
    public static function findByProvincia ($provinciaId) {
        return Doctrine_Query::create()
                ->select('l.*')
                ->from('Localidad l')
                ->innerJoin('l.provincia p WITH p.id = '.$provinciaId)
                ->orderBy('l.value')
                ->execute(array(), Doctrine::HYDRATE_ARRAY)
                ;
    }
    
    public static function toSelect($provinciaId, $objeto=false) {
        $localidadId = ($objeto)?$objeto->localidad->id:0;
        $localidades = Localidad::findByProvincia($provinciaId);
        $html = '<select class="dt-inputarea" data-value="'.$localidadId.'" id="selectLocalidad" name="localidad">';
            foreach ($localidades as $localidad) {
                $selected = ($localidad['id'] == $localidadId)?'  selected="selected"':$selected = '';
                $html .= '<option value="' . $localidad['id'] . '"' . $selected . '>' . htmlentities($localidad['value']) . '</option>';
            }
        $html .= '</select>';
        return $html;
    }

}
?>