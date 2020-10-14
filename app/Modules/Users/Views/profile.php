<?= $this->extend('layouts/general') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3><?= $user->firstname.' '.$user->lastname?></h3>
                <hr>
                <form class="" action="<?=base_url()?>/profile" method="post">
                    <input name='fmode' id='fmode' value='update' type='hidden'>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="firstname"><?=lang('Users.form.name')?></label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname', $user->firstname)?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="lastname"><?=lang('Users.form.lastname')?></label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname', $user->lastname)?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email"><?=lang('Users.form.email')?></label>
                                <input type="text" readonly class="form-control" name="" id="email" value="<?= $user->email?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 bg-light">
                                <i><?=lang('Users.form.changepassword')?></i>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password"><?=lang('Users.form.password')?></label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="password"><?=lang('Users.form.password_confirm')?></label>
                                <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                            </div>
                        </div>
                        <?php if (session()->get('success')) : ?>
                            <div id="alertmessage" class="col-12 alert alert-success text-center" role="alert">
                                <?= session()->get('success');?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <button type="cancel" id='cancel' class="btn btn-secondary"><?=lang('Users.form.button.cancel')?></button>
                        </div>
                        <div class="col-12 col-sm-6 text-right">
                            <button type="submit" class="btn btn-primary"><?=lang('Users.form.button.update')?></button>
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>
        
    </div>
</div>
<script>
    $(document).ready(function(){
        setTimeout(function(){ $("#alertmessage").fadeOut(800); }, 1500);
        $("#cancel").on('click', function (){
            $("#fmode").val('cancel');
        });
    });
</script>
<?= $this->endSection() ?>
