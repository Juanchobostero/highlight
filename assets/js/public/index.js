// CAMBIAR EN SERVER
const baseUrl = 'http://localhost/highlight/';

const toggle = document.querySelector('.img-toggle');
const celNav = document.querySelector('.cel-nav');
const backdrop = document.querySelector('.backdrop');
const closeToggle = document.querySelector('.nav-close');

//ABRIR MENU TOGGLE
toggle.addEventListener('click', e => {
  celNav.style.display = 'block';
  backdrop.style.display = 'block';
  setTimeout(() => {
    backdrop.classList.add('open-backdrop')
  }, 100);
})

//CERRAR MENU TOGGLE
backdrop.addEventListener('click', e => {
  celNav.style.display = 'none';
  backdrop.style.display = 'none';
  setTimeout(() => {
    backdrop.classList.remove('open-backdrop')
  }, 100);
})

closeToggle.addEventListener('click', e => {
  celNav.style.display = 'none';
  backdrop.style.display = 'none';
  setTimeout(() => {
    backdrop.classList.remove('open-backdrop')
  }, 100);
})



/*/--- DESTACADOS ---/*/
const destacados = document.querySelector('.slider-destacados');
if (destacados){

  let total_pages = document.querySelector('.total-destacados').dataset.total;
  let page = 1;
  let url = 'api/destacados'; 

  const sliderDestacados = new Flickity( destacados, {
    cellAlign: 'center',
    contain: true,  
    groupCells: true, 
    pageDots: false, 
    wrapAround: true,
  });

  sliderDestacados.on('change', function(index) {
    if(index === sliderDestacados.slides.length - 1){
      if(page < total_pages){
        cargarMasCells(url, page, sliderDestacados);
        page++;
      }else{
        console.log('no hay mas datos...');
        console.log('total cells destacados:', sliderDestacados.cells.length);
      }
    }
  }); 

  sliderDestacados.on( 'staticClick', function( event, pointer, cellElement ) {
    window.location.href = baseUrl + 'producto/'+ cellElement.dataset.idproducto;
  });
 
}


/*/--- NOVEDADES ---/*/
const novedades = document.querySelector('.slider-novedades');
if (novedades){

  let total_pages = document.querySelector('.total-novedades').dataset.total;
  let page = 1;
  let url = 'api/novedades'; 

  const sliderNovedades = new Flickity( novedades, {
    cellAlign: 'center',
    contain: true,  
    groupCells: true, 
    pageDots: false, 
    wrapAround: true,
  });

  sliderNovedades.on('change', function(index) {
    if(index === sliderNovedades.slides.length - 1){
      if(page < total_pages){
        cargarMasCells(url, page, sliderNovedades);
        page++;
      }else{
        console.log('no hay mas datos...');
        console.log('total cells novedades:', sliderNovedades.cells.length);
      }
    }
  }); 

  sliderNovedades.on( 'staticClick', function( event, pointer, cellElement ) {
    window.location.href = baseUrl + 'producto/'+ cellElement.dataset.idproducto;
  });
 
}


/*/--- OFERTAS ---/*/
const ofertas = document.querySelector('.slider-ofertas');
if (ofertas){

  let total_pages = document.querySelector('.total-ofertas').dataset.total;
  let page = 1;
  let url = 'api/ofertas'; 

  const sliderOfertas = new Flickity( ofertas, {
    cellAlign: 'center',
    contain: true,  
    groupCells: true, 
    pageDots: false, 
    wrapAround: true,
  });

  sliderOfertas.on('change', function(index) {
    if(index === sliderOfertas.slides.length - 1){
      if(page < total_pages){
        cargarMasCells(url, page, sliderOfertas);
        page++;
      }else{
        console.log('no hay mas datos...');
        console.log('total cells ofertas:', sliderOfertas.cells.length);
      }
    }
  }); 

  sliderOfertas.on( 'staticClick', function( event, pointer, cellElement ) {
    window.location.href = baseUrl + 'producto/'+ cellElement.dataset.idproducto;
  });
 
}

/*/--- IMAGENES-MINIATURAS ---/*/
const prodImages = document.querySelector('.slider-images');
if (prodImages){

  new Flickity( prodImages, {
    cellAlign: 'center',
    contain: true,
  });
}

const change = src => {
  document.getElementById('img-main').src = src;
}


function cargarMasCells(url, page, slider){
  $.ajax({
    method: "GET",
    url: baseUrl + url,
    data: { page: page }
  })
  .done(( content ) => {
    data = JSON.parse(content);
    if(data.result === 1){
      slider.append($(data.html));
    }else{
      console.log('no hay mas datos....');
    }
  })
  .fail(ajaxErrors);
}



 

function ajaxErrors( jqXHR, textStatus) {
  /* pageLoader.classList.remove('page-loader--show'); */
  if (jqXHR.status === 0) {
    Swal.fire("Sin Conexion", "Verifique su conexion a internet!", "error");
  } else if (jqXHR.status == 404) {
    Swal.fire("Error (404)", "No se encontro la pagina solicitada!", "error");
  } else if (jqXHR.status == 500) {
    Swal.fire("Error (500)", "Hubo un Error en el Servidor!", "error");
  } else if (textStatus === 'parsererror') {
    Swal.fire("Error", 'Requested JSON parse failed.', "error");
  } else if (textStatus === 'timeout') {
    Swal.fire("Error", 'Time out error.', "error");
  } else if (textStatus === 'abort') {
    Swal.fire("Error", 'Ajax request aborted.', "error");
  } else {
    Swal.fire("Error", 'Uncaught Error: ' + jqXHR.responseText, "error");
  }

}