<?php
class EstadoProducto extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('estado_producto');
        $this->hasColumn('id', 'integer', 1, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 50);
    }
    
    const VISIBLE = 1;
    const OCULTO = 2;
    const BORRADO = 3;
    
    public static function toSelect($producto=false)
    {
        $estadoId = ($producto)?$producto->id_estado:0;
        $estados = Doctrine::getTable('EstadoProducto')->findAll(Doctrine::HYDRATE_ARRAY);
        $html = '<select class="dt-inputarea" data-value="'.$estadoId.'" id="selectEstado" name="estado">';
            foreach ($estados as $estado) {
                $selected = ($estado['id'] == $estadoId)?$selected = '  selected="selected"':$selected = '';
                $html .= '<option value="' . $estado['id'] . '"' . $selected . '>' . $estado['value'] . '</option>';
            }
        $html .= '</select>';
        return $html;
    }
}
