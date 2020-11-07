<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>

<div id="idtipoBeneficiodiv" class="tab-pane">
    <?php
        // Paso 3: Tipo de Beneficio
        $data['Num'] = "3";
        $data['IsLast'] = "false";
        $this->load->view("jugador/steps/ButtonSteps", $data)
        ?>
    <h2 class="mt0 mb0"><?php echo lang('step_3') ?></h2>
    <div class="row">
        <div class="col-md-12 pt5 pl15 pb15 pr15">
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="inputTipBeneficio" class="col-xs-12 col-md-12 pl0 col-form-label required"><?php echo lang('tipo_beneficio') ?></label>
                        <select id="inputTipBeneficio" name="inputTipBeneficio" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft">
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('tipo_beneficio') ?></option>
                            <?php foreach ($beneficios as $key => $value) {?>
                                <option data-id="<?php echo $value->BEF_PK ?>" data-tip-ben="<?php echo $value->BEF_TIPO_BEN ?>"><?php echo $value->BEF_DESCRIPCION ?> - $ <?php echo number_format($value->BEF_MONTO,0); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputFechaIni" class="col-xs-12 col-md-12 pl0 col-form-label required"><?php echo lang('fecha_inicial') ?></label>
                        <input type="text" name="inputFechaIni" id="inputFechaIni" class="form-control wpor90 datepickerdate" placeholder="<?php echo lang('fecha_inicial') ?>" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputFechaFin" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('fecha_termino') ?></label>
                        <input type="text" name="inputFechaFin" id="inputFechaFin" class="form-control wpor90 datepickerdate" placeholder="<?php echo lang('fecha_termino') ?>" readonly>
                    </div>
                    <div class="col-sm-3">
                        <label for="inputObservacion" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('obserbaciones') ?></label>
                        <input type="text" name="inputObservacion" id="inputObservacion" class="form-control wpor90" placeholder="<?php echo lang('obserbaciones') ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        // Paso 3: Tipo de Beneficio
        $data['Num'] = "3";
        $data['IsLast'] = "false";
        $this->load->view("jugador/steps/ButtonSteps", $data)
        ?>
</div>