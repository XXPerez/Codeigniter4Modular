<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>CI4Modular - Example app</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        
        <link href="<?=base_url()?>/assets/css/googlefonts/Roboto.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>/assets/css/style.css" rel="stylesheet" type="text/css">
        
        <script type="text/javascript" src="<?=base_url()?>/assets/js/jquery/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="<?=base_url()?>/assets/bootstrap/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="<?=base_url()?>/utils/setlang/home/general"></script>

        <script type="text/javascript">
            var BASEURL = "<?=base_url();?>";
            var LANG = "<?=service('request')->getLocale();?>"
        </script>
            
    </head>
    <body>
        <div id="loading-overlay">
            <div class="loading-icon"></div>
        </div>          
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
                        <button type="button" class="btn btn-sm btn-secondary btn-width-min" tabindex="2" data-modal-button="no" data-dismiss="modal" data-i18n="generic.no"><?=lang('General.no')?></button>
                        <button type="button" class="btn btn-sm btn-secondary btn-width-min" tabindex="2" data-modal-button="cancel" data-dismiss="modal" data-i18n="generic.cancel"><?=lang('General.cancelar.button')?></button>
                        <button type="button" class="btn btn-sm btn-secondary btn-width-min" tabindex="2" data-modal-button="back" data-dismiss="modal" data-i18n="generic.back"><?=lang('General.volver.button')?></button>
                        <button type="button" class="btn btn-sm btn-primary btn-width-min float-right" tabindex="1"  data-modal-button="yes" data-i18n="generic.yes" ><?=lang('General.no')?></button>
                        <button type="button" class="btn btn-sm btn-primary btn-width-min float-right" tabindex="1" data-modal-button="accept" data-i18n="generic.accept" ><?=lang('General.aceptar.button')?></button>
                        <button type="button" class="btn btn-sm btn-primary btn-width-min float-right" tabindex="1" data-modal-button="continue" data-i18n="generic.continue" ><?=lang('General.continuar.button')?></button>
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
                      <button type="button" class="btn btn-sm btn-primary btn-width-min" data-dismiss="modal"><?=lang('General.aceptar.button')?></button>
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
            <a class="navbar-brand" href="<?=base_url()?>/">CI4Modular</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if (session()->get('isLoggedIn')) : ?>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item <?= ($uri->getSegment(1) == 'profile')? 'active' : null?>">
                        <a class="nav-link" href="<?=base_url()?>/profile"><?=lang('General.myprofile')?></a>
                    </li>
                </ul>
                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>/logout"><?=lang('General.logout')?></a>
                    </li>
                </ul>
                <?php else: ?>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item <?= ($uri->getSegment(1) == 'login')? 'active' : null?>">
                        <a class="nav-link" href="<?=base_url()?>/login"><?=lang('General.login')?></a>
                    </li>
                    <li class="nav-item <?= ($uri->getSegment(1) == 'register')? 'active' : null?>">
                        <a class="nav-link" href="<?=base_url()?>/register"><?=lang('General.register')?></a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </nav>
        <div class="bodycontent">
        <?= $this->renderSection('content') ?>
        </div>
        <div class="modal fade" id="loading" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-focus="true" data-show="false" aria-labelledby="loading">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-body text-center">
                <?=lang('General.espereporfavor')?>
                <div class="loading-spinner"></div>
              </div>
            </div>
          </div>
        </div>
        
        
   </body>
</html>
        