<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>title</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <script type="text/javascript" src="assets/js/jquery/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
    </head>
    <body>
        <?php 
            $uri = service('uri');
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?=base_url()?>/">CI4</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if (session()->get('isLoggedIn')) : ?>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item <?= ($uri->getSegment(1) == 'dashboard')? 'active' : null?>">
                        <a class="nav-link" href="<?=base_url()?>/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item <?= ($uri->getSegment(1) == 'profile')? 'active' : null?>">
                        <a class="nav-link" href="<?=base_url()?>/profile">Profile</a>
                    </li>
                </ul>
                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url()?>/logout">Logout</a>
                    </li>
                </ul>
                <?php else: ?>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item <?= ($uri->getSegment(1) == 'login')? 'active' : null?>">
                        <a class="nav-link" href="<?=base_url()?>/login">Login</a>
                    </li>
                    <li class="nav-item <?= ($uri->getSegment(1) == 'register')? 'active' : null?>">
                        <a class="nav-link" href="<?=base_url()?>/register">Register</a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </nav>

