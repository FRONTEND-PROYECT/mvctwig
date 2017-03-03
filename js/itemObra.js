var url = "./";

// funcion de tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
// funcion de vista List improductiva <nuevo>
$(document).ready(function(){
	$("#idbtnNuevo").click(function(evento){
		nuevo();
	});
})

// funciones de la vista improductiva
$(document).ready(function(){
	$("#IOGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#IORetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "ItemObra",
					accion: "listar"}, 
					function(response, status, xhr){
						console.log("algo paso : " + status);
					}
	);
}
function guardar(){
	// obtenemos los datos

	msg = validar();
	if(msg.length <= 0 ){
		var p = document.getElementById("IOPoligono");
		var a = document.getElementById("IOActividad");
		
		$("#principal").load(url, {
			controlador		: "ItemObra",
			accion			: "guardar",
			pkItemObra		: document.getElementById("IOPkItemObra").value,
			fkOrdenTrabajo 	: document.getElementById("IOIDOt").value,
			fkPoligono		: p.options[p.selectedIndex].value,
			fkActividad		: a.options[a.selectedIndex].value,
			codigo 			: document.getElementById("IOCodigo").value,
			descripcion 	: document.getElementById("IODescripcion").value,
			areaTrab 		: document.getElementById("IOArea").value,
			rendimiento 	: document.getElementById("IORendimiento").value
			
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	if(document.getElementById("IOIDOt").value <= 0){
		msg += "Ingrese codigo de Orden de Trabajo </br>";
	}

	if((document.getElementById("IODescripcion").value).length <= 0){
		msg += "Ingrese descripcion de actividad </br>";
	}

	if((document.getElementById("IOCodigo").value).length <= 0){
		msg += "Ingrese Codigo de Item Obra </br>";
	}

	var p = document.getElementById("IOPoligono");
	if(p.options[p.selectedIndex].value < 0){
		msg += "Seleccione Poligono </br>";
	}

	var p = document.getElementById("IOActividad");
	if(p.options[p.selectedIndex].value < 0){
		msg += "Seleccione Actividad </br>";
	}

	return msg;
}
// list vist improductiva
function editar(pkItemObra){
	// nesecito cargar mi vista de edicion!!
	
	if(pkItemObra > 0){
		$("#principal").load(url, {
			controlador: "ItemObra",
			accion: "editar",
			pkItemObra: pkItemObra
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione Item obra!!";
		$('#messsageModal').modal('show');
	}
}
function eliminar(pkItemObra, data){
	
	if(confirm("Esta seguro de eliminar la actividad [" + data + "]?")){
		if(pkItemObra > 0){
			$("#principal").load(url, {
				controlador: "ItemObra",
				accion: "eliminar",
				pkItemObra: pkItemObra
			});
		}

	}

}

function nuevo(){

	$("#principal").load(url, {
		controlador: "ItemObra",
		accion: "nuevo"
	});

}

function salidafoco(){

	$.post(
				url, 
				{ 
				  controlador: "ItemObra",
				  accion: "getOrdenTrabajo",
				  data : document.getElementById("IOOrdenTrabajo").value
				},
				function(datos){
					
					console.log("status : " + datos.status);

					if(datos.status == "error"){
						document.getElementById("IOIDOt").value = 0;
						document.getElementById("IOOrdenTrabajo").value = "";
						document.getElementById("IONombreOt").innerHTML  = "";
						cargarControles(null, null);
					}else{
						document.getElementById("IOIDOt").value = datos.pkordentrabajo;
						document.getElementById("IOOrdenTrabajo").value = datos.data;
						document.getElementById("IONombreOt").innerHTML  = datos.nombre;
						cargarControles(datos.actividades, datos.poligonos);
					}
				}, "json"
		  );
}

function cargarControles(actividades, poligonos){

	if(poligonos !== null){
		var spoligono = document.getElementById('IOPoligono');
		spoligono.length = 0;
		for (var i = 0; i < poligonos.length; i++){		
			spoligono[i] = new Option(poligonos[i].codigo + ' ' + poligonos[i].descripcion, poligonos[i].pkpoligono);
		}
		spoligono.selectedIndex = -1;
	}else{
		document.getElementById('IOPoligono').length = 0;
	}

	if(actividades !== null){
		var sactividad = document.getElementById('IOActividad');
		sactividad.length = 0;
		for (var i = 0; i < actividades.length; i++){		
			sactividad[i] = new Option(actividades[i].codigo + ' ' + actividades[i].descripcion, actividades[i].pkactividad);
		}
		sactividad.selectedIndex = -1;
	}else{
		document.getElementById('IOActividad').length = 0;
	}
}


function selectedCodigo(){
	var poligonos = document.getElementById("IOPoligono");
	var actividades = document.getElementById("IOActividad");
	var aux = "";
	if(poligonos.selectedIndex >= 0){
		aux = poligonos.options[poligonos.selectedIndex].text;
		aux = aux.split(" ");
		var data = document.getElementById("IOCodigo").value;
		// www-ww
		// 0    1
		data = data.split("-");
		document.getElementById("IOCodigo").value = aux[0] + "-" + data[1];
	}else{
		var data = document.getElementById("IOCodigo").value;
		data = data.split("-");
		document.getElementById("IOCodigo").value = "   -" + data[1];
	}

	if(actividades.selectedIndex >= 0){
		aux = actividades.options[actividades.selectedIndex].text;
		aux = aux.split(" ");
		var data = document.getElementById("IOCodigo").value;
		// www-ww
		// 0    1
		data = data.split("-");
		document.getElementById("IOCodigo").value = data[0] + "-" + aux[0];
	}else{
		var data = document.getElementById("IOCodigo").value;
		data = data.split("-");
		document.getElementById("IOCodigo").value = data[0] + "-  ";
	}
}