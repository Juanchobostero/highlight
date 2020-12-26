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


/*/--- NOVEDADES ---/*/
var elem = document.querySelector('.slider-novedades');
var flkty = new Flickity( elem, {
  //options
  cellAlign: 'center',
  contain: true,  
  groupCells: true, 
  pageDots: false, 
  wrapAround: true
});

/*/--- OFERTAS ---/*/
var elem = document.querySelector('.slider-ofertas');
var flkty = new Flickity( elem, {
  //options
  cellAlign: 'center',
  contain: true,  
  groupCells: true, 
  pageDots: false, 
  wrapAround: true
});

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