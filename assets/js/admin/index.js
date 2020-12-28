// CAMBIAR EN SERVER
const baseUrl = window.location.origin + '/highlight/';

// DEFINICION DE TOAST (alert)
const Toast = Swal.mixin({
	toast: true,
	position: 'top',
	showConfirmButton: false,
	timer: 6000,
})

//---------------------DA FORMATO A TABLA---------------------
function formatoTabla(tabla) {
	return $(tabla).DataTable({
		responsive: true,
		autoWidth: false,
		language: {
			processing: "Procesando...",
			search: "Buscar",
			lengthMenu: "Mostrar _MENU_ registros",
			info: "Desde _START_ a _END_ de _TOTAL_ registros",
			infoEmpty: "No existen datos",
			infoFiltered: "(Total filtrado de _MAX_ registros)",
			infoPostFix: "",
			loadingRecords: "Guardando...",
			zeroRecords: "Sin registros",
			emptyTable: "No hay datos disponibles",
			paginate: {
				first: "Inicio",
				previous: "Anterior",
				next: "Próximo",
				last: "Ultimo",
			},
			aria: {
				sortAscending: ": Activar para ordenar la columna en orden ascendente",
				sortDescending: ": Activar para ordenar la columna en orden descendente.",
			}
		}
	});
}

//--------------------CARGA DATOS EN UN TAB--------------------
function manageHashTab($tabs, $titulo, nomTab) {
	//se recorre los distitos tabs
	$tabs.each(function () {
		if (this.hash === window.location.hash) {
			$(this).tab('show');
			let hrefTab = $(this).attr('href').substr(1);
			let overlayWrap = $('#' + hrefTab).find('.overlay-wrapper');
			let overlay = $('#' + hrefTab).find('.overlay');

			$titulo.text(nomTab + ' (' + hrefTab + ')')
			overlayWrap.addClass('py-5');
			overlay.removeClass('d-none');

			let url = window.location.origin + window.location.pathname + '/' + hrefTab;
			$('.tabla').empty();
			$.post(url, function (data) {
				$('.tabla').html(data);
			}).done(() => {
				overlayWrap.removeClass('py-5');
				overlay.addClass('d-none');
				$("input[data-bootstrap-switch]").bootstrapSwitch();
				formatoTabla('table').columns.adjust();;
				// $('.table').DataTable()
				// $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
			});
		}
	})
}

//--------------------------SUBIR FOTO--------------------------
function subirFoto(input) {
	if (validarFile(input)) return;

	if (input.files && input.files[0]) {
		let reader = new FileReader();

		reader.onload = function (e) {
			$('#foto').attr('src', e.target.result);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

//-----------------VALIDAR EXTENSION DE ARCHIVO-----------------
function validarFile(all) {
	$('#noFoto').addClass('d-none');
	//EXTENSIONES Y TAMANO PERMITIDO.
	let extensiones_permitidas = [".png", ".bmp", ".jpg", ".jpeg"];
	//let tamano = 8; // EXPRESADO EN MB.
	let rutayarchivo = all.value;
	let ultimo_punto = all.value.lastIndexOf(".");
	let extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);

	if (rutayarchivo == '') return false;

	if (extensiones_permitidas.indexOf(extension) == -1) {
		$('#noFoto').removeClass('d-none');
		$('#noFoto > small').text("Extensión de archivo no valida");
		document.getElementById(all.id).value = "";
		setTimeout(function () {
			$("#noFoto").fadeOut(1500);
		}, 4000);
		return true; // Si la extension es no válida ya no chequeo lo de abajo.
	}
	// if ((all.files[0].size / 1048576) > tamano) {
	// 	alert("El archivo no puede superar los " + tamano + "MB");
	// 	document.getElementById(all.id).value = "";
	// 	return true;
	// }
	return false;
}

//----------------CREAR MINIATURA AB PRODUCTO----------------
function crearThumbnail(file, posicion, thumbnail_id) {
	let container = document.createElement('div');
	let capa = document.createElement('div');
	let quitar = document.createElement('span');
	let icon = document.createElement('i');

	container.id = thumbnail_id;
	container.classList.add('grid-item');
	container.setAttribute('style', `background-image: url(${URL.createObjectURL(file.files[posicion])})`);

	capa.classList.add('capa');
	quitar.onclick = () => eliminarFoto(thumbnail_id);
	icon.classList.add('fas', 'fa-trash');

	quitar.appendChild(icon);
	capa.appendChild(quitar);
	container.append(capa);
	document.getElementById('imagenes').appendChild(container);
}

//-------------------ELIMINAR FOTO PRODUCTO-------------------
function eliminarFotoBD(id) {
	$.post(baseUrl + 'eliminarFoto/' + id, function (data) {
		if (data.result === 1) {
			$('#' + id).fadeOut();
			mostrarToast('success', data.titulo, data.msj);
		} else {
			mostrarToast('error', data.titulo, data.msj);
		}
	}, 'json').fail(ajaxErrors);
}

//--------------------OBTENER SUBCATEGORIAS--------------------
function getSubcategorias(id = '') {
	let categ = $('#categoria').val();
	let subcat = $('#subcategoria');
	subcat.empty();
	subcat.append('<option disabled value="0">Seleccione una...</option>');

	if (categ == 0) return;

	$.post(baseUrl + 'getSubcategorias', {
		id_cat: categ
	}, function (data) {
		if (data != false) {
			data.forEach(ele => {
				let selec = (id == ele.id_cat) ? 'selected' : '';

				subcat.append('<option value=' + ele.id_subcategoria + ' ' + selec + '>' + ele.descripcionSC + '</option>');
			});
		}
	}, 'json').fail(ajaxErrors);
};

//----------------CARGA VISTA MODAL DE FORMULARIO---------------
function cargarForm(metodo, modal, selector) {
	$.post(metodo, function (data) {
		$('#' + selector).html(data);
		$('#' + modal).modal();
	}).fail(ajaxErrors);
}

//-----------------ALTA-UPDATE FORMULARIO MODAL-----------------
function validFormMod(e, metodo, form = '') {
	e.preventDefault();
	const formData = (form == '') ? new FormData(e.target) : form;

	$.ajax({
		url: metodo,
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,

		beforeSend: function () {
			$('#btnForm').prop('disabled', true);
			$('#cargandoSpinner').removeClass('d-none');
			$('#nomForm').addClass('d-none');
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			if (data.result === 1) {
				let reDirigir = $('#' + data.tabs + ' a[href="#' + data.tab + '"]');
				reDirigir.click();
				reDirigir.tab('show');

				mostrarToast('success', data.titulo, data.msj);
				$('#cerrarModal').click();
			}
			else {
				mostrarErrors('Oops... verifique los datos', data.errores);
			}
		},
		error: ajaxErrors,
		complete: function () {
			$('#btnForm').prop('disabled', false);
			$('#cargandoSpinner').addClass('d-none');
			$('#nomForm').removeClass('d-none');
		}
	});
};

//------------------ALTA-UPDATE FORMULARIO PAGE------------------
function validFormPage(e, metodo) {
	e.preventDefault();
	const formData = new FormData(e.target);

	$.ajax({
		url: metodo,
		method: "POST",
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		beforeSend: function () {
			$('#btnForm').prop('disabled', true);
			$('#cargandoSpinner').removeClass('d-none');
			$('#nomForm').addClass('d-none');
		},
		success: function (resp) {
			let data = JSON.parse(resp);
			if (data.result === 1) {
				mostrarToast('success', data.titulo, data.msj);
				setTimeout(() => window.location.href = data.url, 1500);
			}
			else {
				mostrarErrors('Oops... verifique los datos', data.errores);
			}
		},
		error: ajaxErrors,
		complete: function () {
			$('#btnForm').prop('disabled', false);
			$('#cargandoSpinner').addClass('d-none');
			$('#nomForm').removeClass('d-none');
		},
	});
}

//---------------------------HABILITAR---------------------------
function habilitar(e, metodo) {
	habDes(e, metodo, 1, 'Habilitar', 'habilitará')
}

//--------------------------INHABILITAR--------------------------
function deshabilitar(e, metodo) {
	habDes(e, metodo, 0, 'Deshabilitar', 'deshabilitará')
}

//----------------------------ELIMINAR----------------------------
function eliminar(e, metodo) {
	habDes(e, metodo, 0, 'Eliminar', 'eliminará')
}

//----------------HABILITAR-DESHABILITAR RESPONSE----------------
function habDes(e, metodo, est, titulo, msj) {
	// let nom = $(e).closest('tr').children('td:first').text();

	Swal.fire({
		title: '¿' + titulo + '?',
		// html: '<strong>' + nom + '</strong> se ' + msj + '.',
		text: 'El registro se ' + msj,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#2c9faf',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sí!',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
		if (result.value) {
			$.post(baseUrl + metodo, { est: est }, function (data) {
				if (data.result === 1) {
					mostrarToast('success', data.titulo, data.msj);
					$(e).closest('tr').fadeOut(1200);
				}
				else {
					mostrarError(data.titulo, data.msj);
				}
			}, 'json').fail(ajaxErrors);
		}
	});
}

//---------------------MANEJO SWITCH (SI-NO)---------------------
function manejoSwitch(e, id, metodo, del = true) {
	$.post(metodo, {
		id: id,
		prom: e.checked
	}, function (data) {
		if (data.result === 1) {
			mostrarToast('success', data.titulo, data.msj);
			if (del) $(e).closest('tr').fadeOut(1200);
			return;
		}
	}, 'json')
		.fail(ajaxErrors);
}

//-------------------QUITAR PRODUCTO DESTACADO-------------------
function dejarDestacar(e, metodo, del = true) {
	$.post(metodo, function (data) {
		if (data.result === 1) {
			mostrarToast('success', data.titulo, data.msj);
			if (del) $(e).closest('tr').fadeOut(1200);
			return;
		}
	}, 'json')
		.fail(ajaxErrors);
}

//---------------------MUESTRA MENSAJE TOAST---------------------
function mostrarToast(icon, titulo, msj) {
	Toast.fire({
		icon: icon,
		title: titulo,
		text: msj
	})
}

//------------------------MUESTRA ERRORES------------------------
function mostrarErrors(titulo, errores) {
	let div = document.createElement('div');
	let ul = document.createElement('ul');

	for (let error in errores) {
		let li = document.createElement("li");
		let text = document.createTextNode(errores[error]);
		li.appendChild(text);
		ul.appendChild(li);
	}

	ul.style.setProperty('list-style', 'none');
	ul.classList.add('p-0', 'my-1');
	div.appendChild(ul);
	div.classList.add('alert', 'alert-danger', 'text-sm', 'text-left', 'py-1');

	Swal.fire({
		icon: 'error',
		title: titulo,
		html: div,
		confirmButtonColor: '#5bc0de',
		confirmButtonText: 'Aceptar'
	});
}

//------------------------ERRORES DE AJAX------------------------
function ajaxErrors(jqXHR, textStatus) {
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
