<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>

<div id="idlesionesdiv" class="tab-pane">
    <?php
        // Paso 5: Lesiones
        $data['Num'] = "5";
        $data['IsLast'] = "true";
        $this->load->view("jugador/steps/ButtonSteps", $data)
    ?>
    <h2 class="mt0 mb0"><?php echo lang('step_5') ?></h2>
    <div class="row">
        <div class="col-md-12 pt5 pl15 pb15 pr15">
            <form class="form-horizontal">
                <div id="contenedorButtonLesion" class="col-md-12">
                    <div class="form-group">
                        <div id="containerCheckLesion" class="col-sm-12 pl0">
                            <div class="radio col-md-12 pl0">
                                <label style="padding-left: 0 !important;">
                                    <input type="radio" id="PendiAsingLes" name="o3" class="Active" value="" checked="">
                                    <span class="cr"><i class="cr-icon fa fa-star"></i></span>
                                    <?php echo lang('sin_lesiones') ?>
                                </label>
                            </div>
                            <div class="radio col-md-12 pl0">
                                <label style="padding-left: 0 !important;">
                                    <input type="radio" id="AsingLes" name="o3" class="" value="">
                                    <span class="cr"><i class="cr-icon fa fa-star"></i></span>
                                    <?php echo lang('asignar_lesion') ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="button" id="buttonAddLesiones" class="btn btn-primary btn-sm pull-right" disabled="disabled">
                                <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;<?php echo lang('add') ?>&nbsp;<?php echo lang('lesion') ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 pt25 pr0 pb25 pl0">
                                <div id="responseSearchLesion">
                                    <table id="tablelesiones" class="table table-striped table-bordered" style="width: 100% !important;">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="wpor4" scope="col"><?php echo lang('nro') ?></th>
                                                <th class="wpor15" scope="col"><?php echo lang('tipo_Lesion') ?></th>
                                                <th class="wpor20" scope="col"><?php echo lang('area_Corporal') ?></th>
                                                <th class="wpor22" scope="col"><?php echo lang('segmento_Corporal') ?></th>
                                                <th class="wpor20" scope="col"><?php echo lang('diagnostico_Patologia') ?></th>
                                                <th class="wpor15" scope="col"><?php echo lang('fecha_Lesion') ?></th>
                                                <th class="wpor4" scope="col"><?php echo lang('action') ?></th>
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
        // Paso 5: Lesiones
        $data['Num'] = "5";
        $data['IsLast'] = "true";
        $this->load->view("jugador/steps/ButtonSteps", $data)
    ?>
</div>