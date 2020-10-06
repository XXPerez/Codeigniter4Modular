<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 mt-5 pt-3 pb-3 bg-white from-wrapper">
            <div class="container">
                <h3><?=lang('Users.form.register_title')?></h3>
                <hr>
                <form class="" action="<?=base_url()?>/register" method="post">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="firstname"><?=lang('Users.form.name')?></label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname')?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="lastname"><?=lang('Users.form.lastname')?></label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname')?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email"><?=lang('Users.form.email')?></label>
                                <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email')?>">
                            </div>
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
                        <?php if (isset($validation)) : ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors() ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="btn btn-primary"><?=lang('Users.form.button.create')?></button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="<?=base_url()?>/login"><?=lang('Users.form.have_user')?></a>
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div>
        
    </div>
</div>