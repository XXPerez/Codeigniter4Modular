<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>CI4Modular - My title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <link href="<?=base_url()?>/assets/css/googlefonts/Roboto.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/css/style.css" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="<?=base_url()?>/assets/js/jquery/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="<?=base_url()?>/assets/bootstrap/js/bootstrap.js"></script>

        <script type="text/javascript">
            var BASEURL = "<?=base_url();?>";
        </script>
    </head>
    <body>
        <?php 
            $uri = service('uri');
        ?>
        
        <div id="modal-confirm" class="modal fade" tabindex="-1" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex">
                        <i class="modal-icon"></i>
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close ml-auto" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer d-block clearfix">
                        <button type="button" class="btn btn-sm btn-light btn-width-min" tabindex="2" data-kmmodal-button="no" data-dismiss="modal" data-i18n="generic.no">No</button>
                        <button type="button" class="btn btn-sm btn-light btn-width-min" tabindex="2" data-kmmodal-button="cancel" data-dismiss="modal" data-i18n="generic.cancel">Cancelar</button>
                        <button type="button" class="btn btn-sm btn-light btn-width-min" tabindex="2" data-kmmodal-button="back" data-dismiss="modal" data-i18n="generic.back">Volver</button>
                        <button type="button" class="btn btn-sm btn-primary btn-width-min float-right" tabindex="1"  data-kmmodal-button="yes" data-i18n="generic.yes" >Sí</button>
                        <button type="button" class="btn btn-sm btn-primary btn-width-min float-right" tabindex="1" data-kmmodal-button="accept" data-i18n="generic.accept" >Aceptar</button>
                        <button type="button" class="btn btn-sm btn-primary btn-width-min float-right" tabindex="1" data-kmmodal-button="continue" data-i18n="generic.continue" >Continuar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-alert" class="modal fade" tabindex="-1" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex">
                        <i class="mmodal-icon"></i>
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close ml-auto" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm km-btn-primary btn-width-min" data-dismiss="modal" data-i18n="generic.accept">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-alert-not-logged" class="modal fade" tabindex="-1" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex">
                        <i class="mmodal-icon"></i>
                        <h4 class="modal-title">ATENCION !!</h4>
                        <button type="button" class="close ml-auto" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">Ha caducado la sesión, debe volver a autenticarse</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm km-btn-primary btn-width-min" data-dismiss="modal" data-i18n="generic.accept">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-help" class="modal fade" tabindex="-1" data-backdrop="static">
            <div class="modal-dialog modal-full">
                <div class="modal-content">
                    <div class="modal-header d-flex">
                        <i class="mmodal-icon"></i>
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close ml-auto" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer d-block">
                      <button type="button" class="btn btn-sm btn-light btn-width-min" data-dismiss="modal" data-i18n="generic.close">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?=base_url()?>/">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </nav>
        <?= $this->renderSection('content') ?>
   </body>
</html>
        