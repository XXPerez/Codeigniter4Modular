<?= $this->extend('layouts/general') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-6 offset-sm-2 col-md-5 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3><?=lang('Users.form.login_title')?></h3>
                <hr>
                <?php if (session()->get('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success');?>
                    </div>
                <?php endif; ?>
                <form class="" action="<?=base_url()?>/login" method="post">
                    <div class="form-group">
                        <label for="email"><?=lang('Users.form.email')?></label>
                        <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email')?>">
                    </div>
                    <div class="form-group">
                        <label for="password"><?=lang('Users.form.password')?></label>
                        <input type="password" class="form-control" name="password" id="password" value="">
                    </div>
                    
                    <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-12 col-sm-8">
                            <a href="<?=base_url()?>/register"><?=lang('Users.form.new_user')?></a>
                        </div>
                        <div class="col-12 col-sm-4 text-right">
                            <button type="submit" class="btn btn-primary"><?=lang('Users.form.button.login')?></button>
                        </div>
                    </div>
                        
                </form>
                
            </div>
            
        </div>
        
    </div>
</div>
<?= $this->endSection() ?>
