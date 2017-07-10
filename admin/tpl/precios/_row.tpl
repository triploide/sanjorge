<tr>
    <td>
        <label class="input"><input name="codigo" type="text" value="" /></label>
    </td>
    <td>
        <label class="input"><input name="nombre" type="text" value="" /></label>
    </td>
    <td>
        <label class="input"><input class="costo" name="costo" type="text" value="" data-type="float" /></label>
    </td>
    <td>
        <select class="form-control" name="tipo_precio">
            <option value="1">Margen (en función del costo)</option>
            <option value="2">Precio fijo</option>
        </select>
    </td>
    <td>
        <label class="input"><input name="margen" type="text" value="" data-type="float" /></label>
    </td>
    <td>
        <label class="input"><input class="precio" name="precio" type="text" value="" data-type="float" disabled /></label>
        <input type="hidden" name="item" value="" />
        <input type="hidden" name="producto" value="" />
    </td>
    <td><a class="btn btn-danger" style="padding: 5px 10px" onclick="removeItem(this)"><i class="fa fa-trash-o"></i></a></td>
</tr>