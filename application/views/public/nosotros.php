<?php $this->load->view('public/incl/header');?>
<?php $this->load->view('public/incl/search');?>

<section class="nosotros-main">
    <div class="banner-nos">
        Inicio / Nosotros
    </div>
    <div class="nosotros-title">
        <h3 class="h3-nos">Nosotros</h3>
        <hr class="hr-nos">
    </div>
    
    <div class="nosotros-text">
        <p class="nosotros-txt">
            <?=$nosotros->descripcion?>
        </p>
    </div>
</section>

<?php $this->load->view('public/incl/footer');?>