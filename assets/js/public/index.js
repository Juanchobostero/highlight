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

  /* let total_pages = document.querySelector('.total-destacados').dataset.total;
  let page = 1;
  let url = 'api/destacados'; */

  const sliderDestacados = new Flickity( destacados, {
    cellAlign: 'center',
    contain: true,  
    groupCells: true, 
    pageDots: false, 
    wrapAround: true,
  });

  /* sliderDestacados.on( 'change', function(index) {
    if(index === desFlkty.slides.length - 1){
      if(page < total_pages){
        cargarMasCells(url, page, desFlkty);
        page++;
      }else{
        console.log('no hay mas datos...');
        console.log('total cells destacados:', desFlkty.cells.length);
      }
    }
  }); */

  /* desFlkty.on( 'staticClick', function( event, pointer, cellElement ) {
    window.location.href = baseUrl + 'producto/'+ cellElement.dataset.idproducto;
  });
 */
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