// CAMBIAR EN SERVER
const baseUrl = 'http://localhost/highlight/';

const toggle = document.querySelector('.img-toggle');
const celNav = document.querySelector('.cel-nav');
const navLinks = document.querySelectorAll('.nav-link');
const backdrop = document.querySelector('.backdrop');
const closeToggle = document.querySelector('.nav-close');
const pageLoader = document.querySelector('.page-loader');
const menu = document.querySelector('.dropdown-content');
const userMenu = document.querySelector('.sub-nav-links');
const carritoNumbers = document.querySelectorAll('.cart-number');
const modal = document.querySelector("#modal-producto");


$(document).ready(() => {
  //controlar total items
  actualizarTotalHeader();
});

///////////////////////////PRODUCTO MODAL//////////////////////////////////////
function showModalImg(e){
  modal.style.display = "block";
  modal.style.visibility = "visible";
  document.querySelector("#modal-img").src = e.target.src;
  document.querySelector("#modal-download").href = e.target.src;
}

function closeModalImg(){
  modal.style.display = "none";
}

//ABRIR MENU TOGGLE
toggle.addEventListener('click', e => {
  celNav.style.display = 'block';
  backdrop.style.display = 'block';
  setTimeout(() => {
    backdrop.classList.add('open-backdrop')
  }, 100);
});


//CERRAR MENU TOGGLE
backdrop.addEventListener('click', e => {
  celNav.style.display = 'none';
  backdrop.style.display = 'none';
  setTimeout(() => {
    backdrop.classList.remove('open-backdrop')
  }, 100);
});

closeToggle.addEventListener('click', e => {
  celNav.style.display = 'none';
  backdrop.style.display = 'none';
  setTimeout(() => {
    backdrop.classList.remove('open-backdrop')
  }, 100);
});



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
    //wrapAround: true,
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
    //wrapAround: true,
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
    //wrapAround: true,
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
if(prodImages){
  new Flickity( prodImages, {
    cellAlign: 'center',
    contain: true,
    pageDots: false,
  });
}
  


const change = src => {
  document.getElementById('img-main').src = src;
}

/*/--- SUBCATEGORIAS ---/*/
const subcats = document.querySelector('.subcategoria-slider');
if(subcats){
  new Flickity( subcats, {
    cellAlign: 'center',
    contain: true,
    draggable: true,
    selectedAttraction: 0.1,
    pageDots: false,
  });
}
  


function myFunction() {
  menu.classList.toggle("show");
}

function showMenu() {
  userMenu.classList.toggle("show-nav");
}

function hideDiv() {
  menu.style.display = 'none';
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

///////////////////////////LOGIN//////////////////////////////////////
function login(e){
  e.preventDefault();
  pageLoader.classList.add('page-loader--show');
  const formData = new FormData(e.target);
  $.ajax({
    method: "POST",
    url: baseUrl + 'api/user/login',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(( resp ) => {
    pageLoader.classList.remove('page-loader--show');
    data = JSON.parse(resp);
    if(data.result === 1){
      Swal.fire("Bienvenido!", data.msg , "success")
      .then(() => {
        window.location.href = data.url;
      });
    }else{
      showErrors(data.errors);
    }
  })
  .fail(ajaxErrors);
}


///////////////////////////REGISTRO//////////////////////////////////////
function registrarse(e){
  e.preventDefault();
  pageLoader.classList.add('page-loader--show');
  const formData = new FormData(e.target);
  $.ajax({
    method: "POST",
    url: baseUrl + 'api/user/signin',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(( resp ) => {
    pageLoader.classList.remove('page-loader--show');
    data = JSON.parse(resp);
    if(data.result === 1){
      Swal.fire("Bien!", data.msg , "success")
      .then(() => {
        window.location.href = data.url;
      });
    }else if(data.result === 2){
      Swal.fire("Error!", data.msg , "error")
    }else{
      showErrors(data.errors);
    }
  })
  .fail(ajaxErrors);
}

///////////////////////////REGISTRO//////////////////////////////////////
function completarPerfil(e){
  e.preventDefault();
  pageLoader.classList.add('page-loader--show');
  const formData = new FormData(e.target);
  $.ajax({
    method: "POST",
    url: baseUrl + 'api/user/complete_profile',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(( resp ) => {
    pageLoader.classList.remove('page-loader--show');
    data = JSON.parse(resp);
    if(data.result === 1){
      Swal.fire("Bien!", data.msg , "success")
      .then(() => {
        window.location.href = data.url;
      });
    }else if(data.result === 2){
      Swal.fire("Error!", data.msg , "error")
    }else{
      showErrors(data.errors);
    }
  })
  .fail(ajaxErrors);
}

///////////////////////////ENVIAR CONSULTA/MENSAJE//////////////////////////////////////
function enviarConsulta(e){
  e.preventDefault();
  pageLoader.classList.add('page-loader--show');
  const formData = new FormData(e.target);
  $.ajax({
    method: "POST",
    url: baseUrl + 'message',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
  })
  .done(( resp ) => {
    pageLoader.classList.remove('page-loader--show');
    data = JSON.parse(resp);
    if(data.result === 1){
      Swal.fire("Bien!", data.msg , "success")
      .then(() => {
        window.location.href = data.url;
      });
    }else if(data.result === 2){
      Swal.fire("Error!", data.msg , "error")
    }else{
      showErrors(data.errors);
    }
  })
  .fail(ajaxErrors);
}

//muestra un arreglo de errores en un alert
function showErrors(errors){
  ul = document.createElement('ul');
  for(error in errors){
    li = document.createElement("li");
    li.classList.add("list-group-item");
    li.classList.add("list-group-item-danger");
    text = document.createTextNode(errors[error]);
    li.appendChild(text);
    ul.appendChild(li);
  }
 
  ul.classList.add("list-group");
  Swal.fire({
    title: "Error",
    html: ul,
    icon: 'error'
  });

}

function getLocalidades(e) {
  let id_prov = e.target.value;
  pageLoader.classList.add('page-loader--show');
  $.ajax({
    method: "POST",
    url: baseUrl + 'api/user/localidades',
    data: { id_prov }
  })
  .done(( content ) => {
    pageLoader.classList.remove('page-loader--show');
    data = JSON.parse(content);
    if(data.result === 1){
      $("#localidad").html(data.html);
      $( "#localidad" ).prop( "disabled", false );
    }else{
      console.log('Error....');
    }
  })
  .fail(ajaxErrors);
}

//Variables globales para paginado ajax
let continuePag = true;
let currentPage = 1;

if(history.state){
  currentPage = history.state.page;
  $(".productos-wrapper").html(history.state.contenido);
}

const loaderProds = document.querySelector('.gooey');

///////////////////////////AJAX PRODUCTOS//////////////////////////////////////
const datosProductos = document.querySelector('.datos-paginado-productos');
if(datosProductos){
  //se ejecuta solo si se esta en la pagina productos
  if(datosProductos.hasAttribute('data-categoria') && datosProductos.hasAttribute('data-subcategoria')){

    var total_pages = datosProductos.dataset.total;
    var categoria = datosProductos.dataset.categoria;
    var categoria = datosProductos.dataset.subcategoria;
    var pageUrl = baseUrl + 'productos/' + categoria + '/' + subcategoria;
  }
  if(!datosProductos.hasAttribute('data-categoria') && !datosProductos.hasAttribute('data-subcategoria')){

    var categoria = null;
    var subcategoria = null;
    var total_pages = datosProductos.dataset.total;

    var pageUrl = baseUrl + 'productos';
  }
  
  window.addEventListener('scroll', () => {
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
    if ((scrollTop + clientHeight >= scrollHeight - 400) && continuePag) {
      continuePag = false;
      if(currentPage <= total_pages){
        loaderProds.classList.add('show');
        loadData(pageUrl);
      }
    }
  });
}

function loadData(pageUrl) {
  $.ajax({
    method: "GET",
    url: pageUrl,
    data: { page: currentPage },
  })
  .done(( content ) => {
    data = JSON.parse(content);
    if(data.result === 1){
      console.log(`Cargando Pagina ${currentPage}`);

      $(".productos-wrapper").append(data.html);
      currentPage++;
      continuePag = true;
      history.replaceState({contenido: $(".productos-wrapper").html(), page: currentPage}, null, window.location.href);
    }else{
      continuePag = false;
      console.log('no hay mas datos....');
      if(datosProductos){
        console.log(`Total paginas: ${datosProductos.dataset.total}`);
      }else{
        console.log(`Total paginas: ${datosProductos.dataset.total}`);
      }
    }
    loaderProds.classList.remove('show');
  })
  .fail(ajaxErrors);
}



///////////////////////////PRODUCTO//////////////////////////////////////
const productoDatos = document.querySelector('#producto-datos');
const cantidadProducto = document.querySelector('#cantidad');
const carritoItems = document.querySelector('.carrito-items');
const carritoTotal = document.getElementById('total-cart');
const btnSave = document.querySelector('.carrito-continuar');
let itemsCarrito = document.querySelectorAll('.carrito-item');
let qtyWaitTimer;
let qtyPrevValue = "";



function addToCart(){
  let idproducto = productoDatos.dataset.idproducto;
  let stock = productoDatos.dataset.stock;
  let cantidad = parseInt(cantidadProducto.value);
  let precioVenta = productoDatos.dataset.precioventa;

  // validaciones
  if(isNaN(cantidad)){
    Swal.fire("Error!", "Ingrese una Cantidad!", "error");
    return;
  }

  if(cantidad <= 0){
    Swal.fire("Error!", "La Cantidad debe ser mayor a Cero!", "error");
    return;
  }

  //loaderProds.classList.add('show');

  $.ajax({
    method: "POST",
    url: baseUrl + 'api/carrito/add',
    data: { idproducto, stock, cantidad, precioVenta }
  })
  .done(( resp ) => {
    //loaderProds.classList.remove('show');
    data = JSON.parse(resp);
    if(data.result === 1){
      Swal.fire("Bien!", "Se Agrego al Carrito!", "success");
      actualizarTotalHeader();
    }else{
      Swal.fire("Error!", data.msg, "error");
    }
  })
  .fail(ajaxErrors);
    
}

function actualizarTotalHeader(){
  console.log(baseUrl+'api/carrito/gettotal/');
  fetch(baseUrl+'api/carrito/gettotal/')
  .then((response)=> {
    return response.json();
  })
  .then((myJson) => {
    if( myJson.total > 0 ){
      //actualizo tanto para cel como pc
      carritoNumbers.forEach(carritoNumber => {
        carritoNumber.innerHTML = myJson.total;
        carritoNumber.style.display = "flex";
      })
    }else{
      carritoNumbers.forEach(carritoNumber => {
        carritoNumber.style.display = "none";
      })
    }
  });
}

/* function updateCantidad(e, id) {
  checkStockItems();
  var precio = document.getElementById("precio-valor-" + id).innerHTML;
  var cantidad = e.target.value;
  var newPrice = precio * cantidad;
  document.getElementById("sub-valor-" + id).innerText = newPrice;
  

} */

if(itemsCarrito){
  checkStockItems();
}

function updateCantidad(e, rowid){
  checkStockItems();
  let qty = parseInt(e.target.value);

  if(isNaN(qty)){
    clearTimeout(qtyWaitTimer);
  }
  
  if(!isNaN(qty) && qty != qtyPrevValue && qty > 0){
    clearTimeout(qtyWaitTimer);
    btnSave.disabled = true;
    qtyWaitTimer = setTimeout(() => sendUpdateQty(rowid, qty), 1000);
  }
  qtyPrevValue = qty;
}

function sendUpdateQty(rowid, qty){
  let subtotal = document.querySelector('#sub-valor-'+ rowid);
  let itemStock = document.querySelector('#producto-stock-'+rowid);
  console.log('ejecutando ajax');
  $.ajax({
    method: "POST",
    url: baseUrl + 'api/carrito/update/qty',
    data: {qty, rowid}
  })
  .done(( resp ) => {
    data = JSON.parse(resp);
    if(data.result === 1){
      subtotal.innerHTML = qty * data.price;
      carritoTotal.innerHTML = data.newtotal;
      itemStock.innerHTML = data.newStock;
      actualizarTotalHeader();
      btnSave.disabled = false;
    }else if(data.result === 2){
      itemStock.innerHTML = data.newStock;
      checkStockItems();
      btnSave.disabled = false;
    }else{
      Swal.fire("Error!", data.msg , "error");
    }

  })
  .fail(ajaxErrors);
}

function vaciar(){
  $.ajax({
    method: "POST",
    url: baseUrl + 'api/carrito/vaciar',
  })
  .done(( resp ) => {
    data = JSON.parse(resp);
    if(data.result === 1){
      Swal.fire("Bien!", data.msg , "success")
      .then(() => {
        carritoItems.innerHTML = data.html;
        carritoTotal.innerHTML = data.newTotal;
      });
      actualizarTotalHeader();
    }else{
      Swal.fire("Error!", data.msg , "error");
    }

  })
}


function checkStockItems(){
  let flagError = false;
  itemsCarrito = document.querySelectorAll('.carrito-item');
  itemsCarrito.forEach(item => {
   
    let itemStock = document.getElementById('producto-stock-' + item.id);
    let itemCantidad = document.querySelector('#cant-item-'+item.id);
    let stock = parseInt(itemStock.innerHTML);
    let cantidad = parseInt(itemCantidad.value);
    if(isNaN(cantidad) || cantidad <= 0 || stock < cantidad){
      itemCantidad.classList.add('error');
      flagError = true;
    }else{
      itemCantidad.classList.remove('error');
    }
  });
  return flagError;
}


function delFromCart(id) {
  //pageLoader.classList.add('page-loader--show');
  $.ajax({
    method: "POST",
    url: baseUrl + 'api/carrito/delete',
    data: { id }
  })
  .done(( resp ) => {
    //pageLoader.classList.remove('page-loader--show');
    data = JSON.parse(resp);
    if(data.result === 1){
      Swal.fire("Bien!", data.msg , "success")
      .then(() => {
        carritoItems.innerHTML = data.html
        carritoTotal.innerHTML = data.total;
      });
      actualizarTotalHeader();
    }else{
      Swal.fire("Error!", data.msg , "error");
    }
  })
  .fail(ajaxErrors);
}

// /////////////////////////////SEARCH//////////////////////////////////
const btnLupa = document.querySelector('.btn-lupa');
const btnClose = document.querySelector('.btn-x');
const searchLoader = document.querySelector('.circle-loader');
const searchContainer = document.querySelector('.search-container');
const inputSearch = document.querySelector('.header-input');
const search = document.querySelector('.search');
let searchWaitTimer;
let previousValue = "";

inputSearch.addEventListener('keyup', () => keyPressHandler());

btnClose.addEventListener('click', () => clearSearch());


function clearSearch(){
  searchContainer.classList.remove('search-visible');
  searchLoader.classList.remove('loader-show');
  btnClose.classList.remove('btn-x-show');
  $(searchContainer).html("");
  inputSearch.value = "";
}

function keyPressHandler(){
  let value = inputSearch.value;

  if(value == ""){
    clearTimeout(searchWaitTimer);
    searchLoader.classList.remove('loader-show');
    btnClose.classList.remove('btn-x-show');
    searchContainer.classList.remove('search-visible');
  }
  
  if(value != "" && value != previousValue){
    clearTimeout(searchWaitTimer);
    btnClose.classList.remove('btn-x-show');
    searchLoader.classList.add('loader-show');
    searchContainer.classList.remove('search-visible');
    searchWaitTimer = setTimeout(() => sendRequest(), 750);
  }
  previousValue = value;
}

function sendRequest(){
  let value = inputSearch.value;
  $.ajax({
    method: "POST",
    url: baseUrl + 'api/search/get',
    data: {value}
  })
  .done(( content ) => {
    data = JSON.parse(content);
    $(searchContainer).html("");
    $(searchContainer).html(data.html);
    searchContainer.classList.add('search-visible');
    searchLoader.classList.remove('loader-show');
    btnClose.classList.add('btn-x-show');
  })
  .fail(ajaxErrors);
}


function openSearch() {
  search.classList.add('search-show');
} 

function closeSearch() {
  search.classList.remove('search-show');
} 

//Abrir y cerrar busqueda

$('#search').on('click', function () {
  if (!$(this).is(".step")) {
    // first click
    $(this).addClass('step');
    $('.search').fadeToggle();
    openSearch();
    
  } else {
    // second click
    $(this).removeClass('step');
    $('.search').fadeToggle();
    closeSearch();
  }
});

function guardarCompra(){
  let error = checkStockItems();
  console.log(error);
  if(error){
    Swal.fire("Error!", "Controle la cantidad de cada Producto!" , "error");
    return;
  }

  pageLoader.classList.add('page-loader--show');

  $.ajax({
    method: "POST",
    url: baseUrl + 'api/carrito/save',
    data: {}
  })
  .done(( resp ) => {
    pageLoader.classList.remove('page-loader--show');
    data = JSON.parse(resp);
    if(data.result === 1){
      window.location.href = data.url;
      actualizarTotalHeader();
    }else if(data.result === 2){
      Swal.fire("Error!", data.msg , "error")
      .then(() => {
        window.location.href = data.url;
      });
    }else if(data.result === 0){
      Swal.fire("Error!", data.msg , "error");
      return;
    }
    else{
      showErrors(data.errors);
      carritoItems.innerHTML = data.html
      checkStockItems();    
    }
  })
  .fail(ajaxErrors);
}

let check = document.getElementById("checkRetiro");

$('#checkRetiro').click(function() {
  if ($(this).is(':checked')) {
    check.value = 1;
    console.log(check.value);
    $(this).siblings('label').html('Retiro en local');
    
  } else {
    check.value = 0;
    console.log(check.value);
    $(this).siblings('label').html('Envío');
  }
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