<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>

<div class="row">
    <div class="col-md-12 pl0">
        <div class="form-group mt5 mb5">
            <a id="butonPaso<?php echo (int)$Num - 1 ?>" class="formBtn btn btn-warning ml15" data-toggle="tab" aria-expanded="false">
                <span class="glyphicon glyphicon-chevron-left"></span> <?php echo (int)$Num - 1 ?>
            </a>
            <?php if ($IsLast === 'true' ) { ?>
                <input type="button" id="saveJugador" data-id-step="<?php echo (int)$Num ?>" class="formBtn btn btn-success saveJugador floatright pull-right" name="saveJugador" value="Guardar"/>
            <?php } else { ?>
                <a id="butonPaso<?php echo (int)$Num + 1 ?>" class="formBtn btn btn-warning pull-right" data-toggle="tab" aria-expanded="false">
                    <span class="glyphicon glyphicon-chevron-right"></span> <?php echo (int)$Num + 1 ?>
                </a>
            <?php } ?>
        </div>
    </div>
</div>