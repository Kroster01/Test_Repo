<form action="" method="POST" id="formId" class="form-horizontal">
    <div class="container col-md-12 pb20">
        <div class="row">
            <div class="col-md-12">
                <!--<h3>Tabs</h3>-->
                <!-- tabs -->
                <div class="tabbable">
                    <h2> Buscar Cuotas </h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 pt25 pr25 pb25 pl25" style="border-style: outset;">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label for="inputNombres" class="col-xs-12 col-md-12 pl0 col-form-label" align="left"><?php echo lang('nombres') ?></label>
                                            <input type="text" name="inputNombres" class="form-control wpor90" id="inputNombres" placeholder="<?php echo lang('nombres') ?>" onkeypress="return soloLetras(event)" maxlength="30">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputApellidos" class="col-xs-12 col-md-12 pl0 col-form-label" align="left"><?php echo lang('apellidos') ?></label>
                                            <input type="text" name="inputApellidos" class="form-control wpor90" id="inputApellidos" placeholder="<?php echo lang('apellidos') ?>" onkeypress="return soloLetras(event)" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label for="inputRut" class="col-xs-12 col-md-12 pl0 col-form-label" align="left"><?php echo lang('rut') ?></label>
                                            <input type="text" name="inputRut" class="form-control wpor90" id="inputRut" maxlength="12" placeholder="<?php echo lang('rut') ?>" onKeypress="validateKCRut(event)" onblur="formatRut(this)">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputCategoria" class="col-xs-12 col-md-12 pl0 col-form-label"><?php echo lang('categoria') ?></label>
                                            <select id="inputCategoria" name="inputCategoria" class="form-control btn btn-default dropdown-toggle wpor90 textalignleft">
                                                <option selected hidden class="wpor90" data-id="NN"><?php echo lang('categoria') ?></option>
                                                <?php foreach ($categorias as $key => $value) {?>
                                                    <option data-id="<?php echo $value->CAT_PK ?>"><?php echo $value->CAT_DESC_CATEGORIA ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label for="fechainicuota" class="col-xs-12 col-md-12 pl0 col-form-label">Fecha inicio</label>
                                            <input type="text" name="fechainicuota" id="fechainicuota" class="form-control wpor90 datepickerdate" placeholder="<?php echo lang('format_date') ?>" readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="fechafincuota" class="col-xs-12 col-md-12 pl0 col-form-label">Fecha fin</label>
                                            <input type="text" name="fechafincuota" id="fechafincuota" class="form-control wpor90 datepickerdate" placeholder="<?php echo lang('format_date') ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 wpor95">
                                            <button type="button" id="BuscarCuota" class="btn btn-default floatright">Consultar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12 pt25 pr0 pb25 pl0">
                                <div id="responseSearchCuota">
                                    <table id="tableBuscarCuota" class="table table-striped table-bordered" style="width: 100% !important;">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="wpor20" scope="col">Nombre</th>
                                                <th class="wpor10" scope="col">Rut</th>
                                                <th class="wpor14" scope="col">Monto</th>
                                                <th class="wpor10" scope="col">Periodo</th>
                                                <th class="wpor23" scope="col">Categoria</th>
                                                <th class="wpor23" scope="col">Contacto apoderados</th>
                                            </tr>
                                        </thead>
                                        </tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /tabs -->
            </div>
        </div>
    </div><!-- /row -->
</form>

<?php
    $this->load->view("cuotaSocial/cuotaSocial_js")
    ?>