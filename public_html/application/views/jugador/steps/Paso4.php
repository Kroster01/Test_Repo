<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>

<div id="idapoderadosdiv" class="tab-pane">
    <?php
        // Paso 4: Apoderados
        $data['Num'] = "4";
        $data['IsLast'] = "false";
        $this->load->view("jugador/steps/ButtonSteps", $data)
    ?>
    <h2 class="mt0 mb0"><?php echo lang('step_4') ?></h2>
    <div class="row">
        <div class="col-md-12 pt5 pl15 pb15 pr15">
            <form class="form-horizontal">
                <div id="contenedorButtonApo" class="col-md-12">
                    <div class="form-group">
                        <div id="containerCheckApo" class="col-sm-12 pl0">
                            <div class="radio col-md-12 col-sm-12 col-xs-12 pl0">
                                <label style="padding-left: 0 !important;">
                                    <input type="radio" id="PendiAsingApo" name="o4" value="" class="Active" checked="">
                                    <span class="cr"><i class="cr-icon fa fa-star"></i></span>
                                    <?php echo lang('sin_apoderados') ?>
                                </label>
                            </div>
                            <div class="radio col-md-12 col-sm-12 col-xs-12 pl0">
                                <label style="padding-left: 0 !important;">
                                    <input type="radio" id="AsingApo" name="o4" value="" class="" >
                                    <span class="cr"><i class="cr-icon fa fa-star"></i></span>
                                    <?php echo lang('asignar_apoderados') ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="button" id="buttonAddApoderado" class="btn btn-primary btn-sm pull-right" disabled="disabled">
                                <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;<?php echo lang('add') ?>&nbsp;<?php echo lang('apoderado') ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 pt25 pr0 pb25 pl0">
                                <div id="responseSearchJugador">
                                    <table id="tableApoderados" class="table table-striped table-bordered" style="width: 100% !important;">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="wpor5" scope="col"><?php echo lang('nro') ?></th>
                                                <th class="wpor20" scope="col"><?php echo lang('responsabilidad') ?></th>
                                                <th class="wpor25" scope="col"><?php echo lang('nombre') ?></th>
                                                <th class="wpor25" scope="col"><?php echo lang('e_mail') ?></th>
                                                <th class="wpor20" scope="col"><?php echo lang('telefono') ?></th>
                                                <th class="wpor5" scope="col"><?php echo lang('action') ?></th>
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
            </form>
        </div>
    </div>
    <?php
        // Paso 4: Apoderados
        $data['Num'] = "4";
        $data['IsLast'] = "false";
        $this->load->view("jugador/steps/ButtonSteps", $data)
    ?>
</div>