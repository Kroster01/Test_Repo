<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<tr class="text-center" id="<?php echo $idRow ?>">
    <td class="wpor5" scope="col" value="<?php echo $idRow ?>"><?php echo $idRow ?></td>
    <td class="wpor20" scope="col">
        <select id="NivelResponsabilidad" name="NivelResponsabilidad" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft" title="<?php echo lang('responsabilidad') ?>">
            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_responsabilidad') ?></option>
            <?php foreach ($responsabiliddaApo as $key => $value) {?>
            <option data-id="<?php echo $value->REAP_PK ?>">
            <?php echo $value->REAP_DESCRIPCION ?>
            </option>
            <?php } ?>
        </select>
    </td>
    <td class="wpor25" scope="col">
        <input type="text" name="inputNombreApo" class="form-control wpor90" id="inputNombreApo" placeholder="<?php echo lang('nombres') ?>" onkeypress="return soloLetras(event)" maxlength="30">
    </td>
    <td class="wpor25" scope="col">
        <input type="text" name="inputemailApo" class="form-control wpor90" id="inputemailApo" placeholder="<?php echo lang('e-mail') ?>" maxlength="40">
    </td>
    <td class="wpor20" scope="col">
        <input type="text" name="inputFonoApo" class="form-control wpor90" id="inputFonoApo" placeholder="+56" onKeypress="soloNumeros(event)" maxlength="9">
    </td>
    <td class="wpor5" scope="col">
        <a id="<?php echo $idRow ?>" class="btn btn-sm btn-default deleteRowApo"><span class="glyphicon glyphicon-trash"></span></a>
    </td>
</tr>