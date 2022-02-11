<?= $this->extend('layouts/general') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 col-sm-12">
            <h2></h2>     
        </div>
    </div>
    <div class="mx-auto" style="margin: 0 auto;">
        
        <!-- MAIN LOGGED MENU CARD -->
        <div class="card-deck mx-auto" style="margin: 0 auto;">
            <div class="card text-white bg-dark mb-3" style="min-width: 12rem;">
                <div class="card-header"><?=lang('General.myprofile')?></div>
                    <a href="<?=base_url()?>/profile" class="btn btn-primary stretched-link"></a>
                <div class="card-body">
                    <h5 class="card-title"><?=lang('General.myprofile-title')?></h5>
                    <p class="card-text"><?=lang('General.myprofile-desc')?></p>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?= $this->endSection() ?>

