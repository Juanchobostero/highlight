<?php $this->load->view('public/incl/header');?>

<section class="login-main">

    <div class="login-banner">
        Login    
    </div>

    <div class="login-head">
        <img class="login-img" src="<?=base_url('assets/img/public/imgVarios/user-img.jpeg')?>" alt="user">
        <h2 class="login-title"><?=$title?></h2>
        <hr class="login-hr">
        <span class="title-secondary">Fácil y rápido</span>
    </div>

    <form class="form">
        <div class="form-group">
            <input class="mail" type="mail" name="correo" placeholder="Correo electrónico">
        </div>
        <div class="form-group">
            <input class="password" type="password" name="pass" placeholder="Contraseña">
        </div>
        <div class="lost-pass">
            <input type="checkbox" id="remember-pass" name="remember">
            <span class="remember"><a href="#">R<u>ecorda</u>r mi contraseña</a></span>
            <span class="forget"><a href="#">¿O<u>lvidast</u>e tu contraseña?</a></span>
        </div>
        <div class="buttons">
            <button class="btn-login">Ingresar</button>
            <a href="<?=base_url('registro')?>" class="btn-register">Registrate</a>
        </div>
    </form>
</section>

<?php $this->load->view('public/incl/footer');?>