<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<section class="nosotros-main">
    <div class="banner-nos">
        Inicio / Términos y condiciones
    </div>
    <div class="nosotros-title">
        <h3 class="h3-nos">Términos y condiciones</h3>
        <hr class="hr-nos">
    </div>
    
    <div class="nosotros-text">
        <p class="nosotros-txt">
            <?=$terminos->descripcion?>
        </p>
    </div>
</section>

<?php $this->load->view('public/incl/footer');?>