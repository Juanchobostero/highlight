<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<section class="nosotros-main">
    <div class="banner-nos">
        Inicio / Privacidad
    </div>
    <div class="nosotros-title">
        <h3 class="h3-nos">Privacidad</h3>
        <hr class="hr-nos">
    </div>
    
    <div class="nosotros-text">
        <p class="nosotros-txt">
            <?=$privacidad->descripcion?>
        </p>
    </div>
</section>

<?php $this->load->view('public/incl/footer');?>