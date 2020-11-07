<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>

<div id="idanteJugadordiv" class="tab-pane">
    <?php
        // Paso 2:  Antecedentes de Jugador
        $data['Num'] = "2";
        $data['IsLast'] = "false";
        $this->load->view("jugador/steps/ButtonSteps", $data)
    ?>
    <h2 class="mt0 mb0"><?php echo lang('step_2') ?></h2>
    <div class="row">
        <div class="col-md-12 pt5 pl15 pb15 pr15">
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="inputingresoClubfecha" class="col-xs-12 col-md-12 pl0 col-form-label required"><?php echo lang('fecha_ingreso_club') ?></label>
                        <input type="text" name="inputingresoClubfecha" id="inputingresoClubfecha" class="form-control wpor90 datepickerdate" placeholder="<?php echo lang('fecha_ingreso_club') ?>" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="inputCategoria" class="col-xs-12 col-md-12 pl0 col-form-label required"><?php echo lang('categoria') ?></label>
                        <select id="inputCategoria" name="inputCategoria" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft">
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('categoria') ?></option>
                            <?php foreach ($categorias as $key => $value) {?>
                                <option data-id="<?php echo $value->CAT_PK ?>"><?php echo $value->CAT_DESC_CATEGORIA ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="inputUbCancha" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('posicion_en_cancha') ?></label>
                        <select id="inputUbCancha" name="inputUbCancha" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft">
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('posicion_en_cancha') ?></option>
                            <?php foreach ($ubicacionesCancha as $key => $value) {?>
                                <option data-id="<?php echo $value->UBC_PK ?>"><?php echo $value->UBC_DESC_POSICION ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="inputpeso" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('peso') ?></label>
                        <input type="text" name="inputpeso" class="form-control wpor90" id="inputpeso" placeholder="<?php echo lang('peso') ?>" onKeypress="soloNumeros(event)" maxlength="6">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputestatura" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('estatura') ?></label>
                        <input type="text" name="inputestatura" class="form-control wpor90" id="inputestatura" placeholder="<?php echo lang('estatura') ?>" onKeypress="soloNumeros(event)" maxlength="4">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputgruposanguineo" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('grupo_sanguineo') ?></label>
                        <select id="inputgruposanguineo" name="inputgruposanguineo" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft">
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('grupo_sanguineo') ?></option>
                            <?php foreach ($gruposanguineos as $key => $value) {?>
                                <option data-id="<?php echo $value->GSO_PK ?>"><?php echo $value->GSO_DESC ?> <?php echo $value->GSO_CORRELATIVO ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 divcontain">
                        <div class="containtradio" align="center">
                            <label class="radio radio-inline ml0">
                                <input type="radio" class="checkalergias" name="alergias" value="Si"><?php echo lang('si') ?>
                            </label>
                            <label class="radio radio-inline ml20">
                                <input type="radio" class="checkalergias" name="alergias" value="No" checked><?php echo lang('no') ?>
                            </label>
                        </div>
                        <input type="text" name="inputalergias" class="form-control wpor90" id="inputalergias" placeholder="<?php echo lang('alergias') ?>" disabled="disabled">
                    </div>
                    <div class="col-sm-4 divcontain">
                        <div class="containtradio" align="center">
                            <label class="radio radio-inline ml0">
                                <input type="radio" class="checkmedicamentos" name="medicamentos" value="Si"><?php echo lang('si') ?>
                            </label>
                            <label class="radio radio-inline ml20">
                                <input type="radio" class="checkmedicamentos" name="medicamentos" value="No" checked><?php echo lang('no') ?>
                            </label>
                        </div>
                        <input type="text" name="inputmedicamentos" class="form-control wpor90" id="inputmedicamentos" placeholder="<?php echo lang('medicamentos') ?>" disabled="disabled">
                    </div>
                    <div class="col-sm-4 divcontain">
                        <div class="containtradio" align="center">
                            <label class="radio radio-inline ml0">
                                <input type="radio" class="checksegaccident" name="seguroaccidente" value="Si"><?php echo lang('si') ?>
                            </label>
                            <label class="radio radio-inline ml20">
                                <input type="radio" class="checksegaccident" name="seguroaccidente" value="No" checked><?php echo lang('no') ?>
                            </label>
                        </div>
                        <input type="text" name="textseguroAccidente" class="form-control wpor90" id="inputseguroAccidente" placeholder="<?php echo lang('nombre_seguro_de_accidente') ?>" disabled="disabled">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 divcontain">
                        <div class="containtradio" align="center">
                            <label class="radio radio-inline ml0">
                                <input type="radio" class="checkllamara" name="llamara" value="Si"><?php echo lang('si') ?>
                            </label>
                            <label class="radio radio-inline ml20">
                                <input type="radio" class="checkllamara" name="llamara" value="No" checked><?php echo lang('no') ?>
                            </label>
                        </div>
                        <input type="text" name="inputllamara" class="form-control wpor90" id="inputllamara" placeholder="<?php echo lang('numero_de_emergencia') ?>" disabled="disabled">
                    </div>
                    <div class="col-sm-4 divcontain">
                        <div class="containtradio" align="center">
                            <label class="radio radio-inline ml0">
                                <input type="radio" class="checkevalunutri" name="evalunutri" value="Si"><?php echo lang('si') ?>
                            </label>
                            <label class="radio radio-inline ml20">
                                <input type="radio" class="checkevalunutri" name="evalunutri" value="No" checked><?php echo lang('no') ?>
                            </label>
                        </div>
                        <input type="text" name="inputevalunutri" class="form-control wpor90" id="inputevalunutri" placeholder="<?php echo lang('evaluación_nutricional') ?>" disabled="disabled">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputTipoPrevision" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('tipo_prevision') ?></label>
                        <select id="inputTipoPrevision" name="inputTipoPrevision" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft">
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_tipo_prevision') ?></option>
                            <?php foreach ($TipePrevision as $key => $value) {?>
                                <option data-id="<?php echo $value->PVS_PK ?>" data-code="<?php echo $value->PVS_CODE ?>" data-name="<?php echo $value->PVS_NOMBRE ?>" name="<?php echo lang('prevision') ?>" value="<?php echo $value->PVS_NOMBRE ?>"><?php echo $value->PVS_NOMBRE ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="inputPrevision" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('prevision') ?></label>
                        <select id="inputPrevision" name="inputPrevision" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft" disabled>
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_prevision') ?></option>
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <label for="inputobserbaciones" class="col-xs-12 col-md-12 pl0 col-form-label pr27"><?php echo lang('obserbaciones') ?></label>
                        <textarea id="inputobserbaciones" class="wpor97 textareaobs" rows="4" name="inputobserbaciones" cols="50" placeholder="<?php echo lang('obserbaciones') ?>" maxlength="500"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        // Paso 2:  Antecedentes de Jugador
        $data['Num'] = "2";
        $data['IsLast'] = "false";
        $this->load->view("jugador/steps/ButtonSteps", $data)
    ?>
</div>