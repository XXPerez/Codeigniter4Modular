<?= $this->extend('layouts/general') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>DASHBOARD for Codeigniter4 modular</h2>     
            <br>
            <?= session()->get('firstname');?>
        </div>
    </div>
</div> 
<?= $this->endSection() ?>

