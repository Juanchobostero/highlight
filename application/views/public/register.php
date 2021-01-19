<?php $this->load->view('public/incl/header');?>

<section class="login-main">

    <div class="login-banner">
           
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
        <div class="form-group">
            <input class="password" type="password" name="pass" placeholder="*Confirmar contraseña">
        </div>
        <!-- <div class="lost-pass">
            <select name="prov" id="prov"></select>
            <select name="loc" id="loc"></select>
        </div> -->
        <div class="buttons">
            <button class="btn-register">Registrate</button>
        </div>
    </form>
</section>

<?php $this->load->view('public/incl/footer');?>