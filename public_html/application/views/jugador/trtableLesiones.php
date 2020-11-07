<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<tr class="text-center" id="<?php echo $idRow ?>">
    <td class="wpor4" scope="col" value="<?php echo $idRow ?>">
        <?php echo $idRow ?>
    </td>
    <td class="wpor15" scope="col">
        <select id="inputTipoDeLesiones" name="inputTipoDeLesiones" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft" title="<?php echo lang('area_Corporal') ?>">
            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_Tipo_Lesión') ?></option>
            <?php foreach ($tipoDeLesiones as $key => $value) {?>
            <option data-id="<?php echo $value->LSN_PK ?>"><?php echo $value->LSN_DESCRIPCION ?></option>
            <?php } ?>
        </select>
    </td>
    <td class="wpor20" scope="col">
        <select id="inputAreaCorporal" name="inputAreaCorporal" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft" title="<?php echo lang('area_Corporal') ?>">
            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_Area_Corporal') ?></option>
            <?php foreach ($areaCoporal as $key => $value) {?>
            <option data-id="<?php echo $value->LSN_PK ?>"data-code-parent="<?php echo $value->LSN_PARENT_LESION ?>"  data-code-child="<?php echo $value->LSN_CHILD_LESION ?>">
            <?php echo $value->LSN_DESCRIPCION ?>
            </option>
            <?php } ?>
        </select>
    </td>
    <td class="wpor22" scope="col">
        <select id="inputSegmentoCorporal" name="inputSegmentoCorporal" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft" title="<?php echo lang('segmento_Corporal') ?>" disabled>
            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_Segmento_Corporal') ?></option>
        </select>
    </td>
    <td class="wpor20" scope="col">
        <input type="text" name="inputDiagnostico" class="form-control wpor90" id="inputDiagnostico" placeholder="<?php echo lang('diagnostico_Patologia') ?>" maxlength="200" disabled>
    </td>
    <td class="wpor15" scope="col">
        <input type="text" name="inputFechaLesion" id="inputFechaLesion" class="form-control wpor90 datepickerdate" placeholder="<?php echo lang('fecha_Lesion') ?>" readonly>
    </td>
    <td class="wpor4" scope="col">
        <a id="<?php echo $idRow ?>" class="btn btn-sm btn-default deleteRowLesion"><span class="glyphicon glyphicon-trash"></span></a>
    </td>
</tr>