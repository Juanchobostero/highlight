<?php $this->load->view('public/incl/header');?>

<section class="login-main">

    <div class="login-banner">
           
    </div>

    <div class="contacto-head">
        <h3 class="contacto-title"><?=$title?></h3>
        <hr class="contacto-hr">
    </div>

    <form class="form">
        <div class="form-group">
            <input class="name" type="text" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <input class="mail" type="mail" name="correo" placeholder="Correo electrónico">
        </div>
        <div class="form-group">
            <input class="telefono" type="text" name="telefono" placeholder="Telefono">
        </div>
        <div class="form-group">
            <input class="password" type="password" name="pass" placeholder="Contraseña">
        </div>
        <div class="buttons">
            <button class="btn-register">Enviar</button>
        </div>
    </form>
</section>

<?php $this->load->view('public/incl/footer');?>