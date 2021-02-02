<?php $this->load->view('public/incl/header');?>

<section class="login main">

    <?php if(!empty($this->session->flashdata('flash_msg'))) {?> 
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('flash_msg'); ?>
        </div>
    <?php } ?>

    <div class="login-banner">
    </div>

    <div class="login-head">
        <img class="login-img" src="<?=base_url('assets/img/public/imgVarios/user-img.jpeg')?>" alt="user">
        <h2 class="login-title"><?=$title?></h2>
        <hr class="login-hr">
        <span class="title-secondary">Fácil y rápido</span>
    </div>

    <form onsubmit="completarPerfil(event)" class="form">
    <div class="form-group">
        
        <div class="form-group">
            <input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
        </div>
        <div class="form-group">
            <input class="name" type="text" name="nombre" placeholder="Nombre" value="<?=$usuario->nombreU?>">
        </div>
        <div class="form-group">
            <input class="mail" type="text" name="apellido" placeholder="Apellido" value="<?=$usuario->apellidoU?>">
        </div>
        <div class="form-group">
            <input class="telefono" type="text" name="telefono" placeholder="Teléfono" value="<?=$usuario->telefonoU?>">
        </div>
        <div class="form-group">
            <?php if($usuario->fotoU != null) {?> 
                <div class="foto-user">
                    <img class="img-user" src="<?=base_url($usuario->fotoU)?>" alt="foto-user">
                </div>
            <?php } ?>
            <input class="name" name="foto" placeholder="foto" type="file">
        </div>
        <div class="buttons">
            <button type="submit" class="btn-register">Guardar</button>
        </div>
    </form>

</section>

<?php $this->load->view('public/incl/footer');?>