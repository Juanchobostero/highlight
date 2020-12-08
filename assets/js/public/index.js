// CAMBIAR EN SERVER
const baseUrl = 'http://localhost/highlight/';

const toggle = document.querySelector('.img-toggle');
const celNav = document.querySelector('.cel-nav');
const backdrop = document.querySelector('.backdrop');

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



/*/--- DESTACADOS ---/*/
var elem = document.querySelector('.slider-destacados');
var flkty = new Flickity( elem, {
  //options
  cellAlign: 'center',
  contain: true,  
  groupCells: true, 
  pageDots: false, 
  wrapAround: true,
  /* arrowShape: {
    x0: 20,
    x1: 40, y1: 20,
    x2: 80, y2: 20,
    x3: 100
  } */
});

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