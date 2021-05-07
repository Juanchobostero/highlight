<?php $this->load->view('public/incl/header')?>

<section class="login-main" id="form-rec">
  <div class="login-head">
        <img class="login-img" src="<?=base_url('assets/img/public/imgVarios/user-img.jpeg')?>" alt="user">
        <h2 class="login-title"><?=$title?></h2>
        <hr class="login-hr">
        <span class="title-secondary">Nueva contraseña</span>
    </div>

    <form onsubmit="nuevaContrasena(event, '<?=$id_user?>')" class="form" id="form_nuevacontrasena">
        <div class="form-group">
            <input class="mail" type="text" name="nc" placeholder="Ingrese nueva contrasena">
        </div>
        <div class="form-group">
            <input class="mail" type="text" name="rc" placeholder="Confirme contrasena">
        </div>
        <button type="submit" class="btn-login">Enviar</button>
    </form>
</section>

<?php $this->load->view('public/incl/footer')?>