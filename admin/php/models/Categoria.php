<?php
class Categoria extends Doctrine_Record {
    
    public function setTableDefinition()
    {
        $this->setTableName('categoria');
        $this->hasColumn('id', 'integer', 1, array('primary' => true, 'unsigned'=>true, 'autoincrement'=>true));
        $this->hasColumn('value', 'string', 255);
        $this->hasColumn('estado', 'integer', 1, array('unsigned'=>true, 'default'=>1));
    }
    
    public function setUp()
    {
        $this->hasMany('Producto as productos', array(
            'local' => 'id',
            'foreign' => 'id_categoria'
        ));

        //behaviors
        $this->actAs('Sluggable', array('fields'=>array('value'),'unique'=>true,'canUpdate'=>true,'name'=>'slug'));
    }
    
    public static function toSelect($objeto=false)
    {
        $categoriaId = ($objeto)?$objeto->categoria->id:0;
        $categorias = Doctrine::getTable('categoria')->findAll(Doctrine::HYDRATE_ARRAY);
        $categorias = Doctrine_Query::create()->select('c.*')->from('Categoria c')->orderBy('c.value')->execute(array(),Doctrine::HYDRATE_ARRAY);
        $html = '<select class="dt-inputarea" data-value="'.$categoriaId.'"  id="selectCategoria" name="categoria">';
            foreach ($categorias as $categoria) {
                $selected = ($categoria['id'] == $categoriaId)?' selected="selected"':'';
                $html .= '<option value="' . $categoria['id'] . '"' . $selected . '>' . $categoria['value'] . '</option>';
            }
        $html .= '</select>';
        return $html;
    }

    public function hasProductos()
    {
        return Doctrine_Query::create()
            ->select('count(id)')
            ->from('categoria c')
            ->innerJoin('c.productos p ON c.id = ?', $this->id)
            ->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR)
        ;
    }
}
