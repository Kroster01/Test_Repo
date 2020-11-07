<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>

<div id="idantePersonalesdiv" class="tab-pane active">
    <?php
        // Paso 1: Antecedentes personales
        $data['Num'] = "1";
        $data['IsLast'] = "false";
        $this->load->view("jugador/steps/ButtonOneSteps", $data)
    ?>
    <h2 class="mt0 mb0"><?php echo lang('step_1') ?></h2>
    <div class="row">
        <div class="col-md-12 pt5 pl15 pb15 pr15">
            <form class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="inputNombres" class="col-xs-12 col-md-12 pl0 col-form-label required" align="left"><?php echo lang('nombres') ?></label>
                        <input type="text" name="inputNombres" class="form-control wpor90" id="inputNombres" placeholder="<?php echo lang('nombres') ?>" onkeypress="return soloLetras(event)" maxlength="30">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputApellidos" class="col-xs-12 col-md-12 pl0 col-form-label required" align="left"><?php echo lang('apellidos') ?></label>
                        <input type="text" name="inputApellidos" class="form-control wpor90" id="inputApellidos" placeholder="<?php echo lang('apellidos') ?>" onkeypress="return soloLetras(event)" maxlength="30">
                    </div>
                    <div class="col-sm-4">
                        <label for="inputRut" class="col-xs-12 col-md-12 pl0 col-form-label required" align="left"><?php echo lang('rut') ?></label>
                        <input type="text" name="inputRut" class="form-control wpor90" id="inputRut" maxlength="12" placeholder="<?php echo lang('rut') ?>" onKeypress="validateKCRut(event)" onblur="formatRut(this)">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="inputfotoPerfil" class="col-xs-12 col-md-12 pl0 col-form-label" align="left"><?php echo lang('foto_perfil') ?></label>
                        <div class="input-group input-file wpor90" id="fotoid" name="fotoperfil">
                            <input type="text" id="inputFotoPerfil" class="form-control col-md-12 wpor100 cursorpoiter" placeholder='<?php echo lang('foto_perfil') ?>' readonly />
                            <span class="input-group-btn text-right">
                                <button class="btn btn-danger btn-reset" type="button"><?php echo lang('limpiar') ?></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="fechanacjugador" class="col-xs-12 col-md-12 pl0 col-form-label required"><?php echo lang('fecha_nacimiento') ?></label>
                        <input type="text" name="fechanacjugador" id="fechanacjugador" class="form-control wpor90 datepickerdate" placeholder="<?php echo lang('format_date') ?>" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="inputFonoContacto" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('fono_contacto') ?></label>
                        <input type="text" name="inputFonoContacto" class="form-control wpor90" id="inputFonoContacto" placeholder="+56" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="9">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="inputemail" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('e-mail') ?></label>
                        <input type="text" name="inputemail" class="form-control wpor90" id="inputemail" placeholder="<?php echo lang('e-mail') ?>" maxlength="40">
                    </div>
                    <div class="col-sm-4">
                        <label for="selectRegion" class="col-md-12 pl0 col-form-label"><?php echo lang('region') ?></label>
                        <select id="selectRegion" name="region" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft">
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_region') ?></option>
                            <?php foreach ($regiones as $key => $value) {?>
                                <option data-id="<?php echo $value->RGN_PK ?>">
                                        <?php echo $value->RGN_CODE_REG ?> <?php echo $value->RGN_DESC ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="selectProvincia" class="col-md-12 pl0 col-form-label"><?php echo lang('provincia') ?></label>
                        <select id="selectProvincia" name="provincia" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft" disabled>
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_provincia') ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="selectComuna" class="col-md-12 pl0 col-form-label"><?php echo lang('comuna') ?></label>
                        <select id="selectComuna" name="comuna" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft" disabled>
                            <option selected hidden class="wpor90" data-id="NN"><?php echo lang('seleccione_comuna') ?></option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="inputDireccion" class="col-xs-12 col-md-12 pl0 col-form-label required"><?php echo lang('direccion') ?></label>
                        <input type="text" name="inputDireccion" class="form-control wpor90" data-id="inputDireccion" id="inputDireccion" placeholder="<?php echo lang('direccion') ?>" maxlength="45" disabled>
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        // Paso 1: Antecedentes personales
        $data['Num'] = "1";
        $data['IsLast'] = "false";
        $this->load->view("jugador/steps/ButtonOneSteps", $data)
    ?>
</div>