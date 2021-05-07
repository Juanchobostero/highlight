<?php $this->load->view('public/incl/header')?>

<section class="login-main" id="form-rec">
  <div class="login-head">
        <img class="login-img" src="<?=base_url('assets/img/public/imgVarios/user-img.jpeg')?>" alt="user">
        <h2 class="login-title"><?=$title?></h2>
        <hr class="login-hr">
        <span class="title-secondary">Ingresá tu correo</span>
    </div>

    <form onsubmit="recuperar(event)" class="form">
        <div class="form-group">
            <input class="mail" type="mail" name="correo_r" placeholder="Correo electrónico">
        </div>
        <button type="submit" class="btn-login">Enviar</button>
    </form>
</section>

<?php $this->load->view('public/incl/footer')?>