
<div id="containerHeader" class="container col-md-12">
    <div id="containerNav" class="col-ms-12">
        <h2></h2>
        <div class="row">
            <div class="col-md-3 col-lg-3 " align="center" style="float: right;">
                <img alt="User Pic" src="<?= $this->session->userdata('urlFotoUser') ?><?= $this->session->userdata('nameFotoUser') ?>" class="img-circle img-responsive">
                <input type="hidden" id="idSessionUser" name="idSessionUser" value="<?= $this->session->userdata('idUser') ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12" align="center" style="float: right;">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a id="menuNavHome" name="homeCatalogo" class="navbar-brand" data-url="<?php echo site_url('Home_Controller/index') ?>" style="cursor: pointer;">Home Catalogo</a> 
                        </div>
                        <ul class="nav navbar-nav menu-nav">
                            <li><a name="catalogo" data-url="<?php echo site_url('Productos_Controller/catalogo') ?>" style="cursor: pointer;">Catálogo</a></li>
                            <li><a name="micuenta" data-url="<?php echo site_url('Usuarios_Controller/micuenta') ?>" style="cursor: pointer;">Mi Cuenta</a></li>
                            <li><a name="salir" data-url="<?php echo site_url('Usuarios_Controller/salir') ?>" style="cursor: pointer;">Salir</a></li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
    </div>
</div>