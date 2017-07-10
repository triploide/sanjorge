<tr>
    <td>
        <label class="input"><input name="codigo" type="text" value="${codigo}" /></label>
    </td>
    <td>
        <label class="input"><input name="nombre" type="text" value="${nombre}" /></label>
    </td>
    <td>
        <label class="input"><input class="costo" name="costo" type="text" value="" data-type="float" /></label>
    </td>
    <td>
        <label class="input"><input class="stock" name="cantidad" type="text" value="${cantidad}" data-type="int" /></label>
        <input type="hidden" name="item" value="${item}" />
        <input type="hidden" name="producto" value="${producto}" />
    </td>
    <td><a class="btn btn-danger" style="padding: 5px 10px" onclick="removeItem(this)"><i class="fa fa-trash-o"></i></a></td>
</tr>