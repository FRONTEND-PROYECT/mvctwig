var url = "./";

$(function ()
	{
		$('#EQFechaIngreso').datetimepicker({
			locale : 'es'
		});
	}
);

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
	$("#EQGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#EQRetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "Equipo",
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
		var t = document.getElementById("EQTipo");
		var m = document.getElementById("EQModelo");
		var c = document.getElementById("EQContrato");
		
		$("#principal").load(url, {
			controlador		: "Equipo",
			accion			: "guardar",
			pkEquipo		: document.getElementById("EQPkEquipo").value,
			fkTipoEquipo	: t.options[t.selectedIndex].value,
			fkModelo		: m.options[m.selectedIndex].value,
			codigo 			: document.getElementById("EQCodigo").value,
			fkTipoContrato 	: c.options[c.selectedIndex].value,
			fechaIngreso	: document.getElementById("EQFechaIngreso").value,
			fkOrdenTrabajo 	: document.getElementById("EQIDOt").value,
			descripcion 	: document.getElementById("EQDescripcion").value,
			
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	if(document.getElementById("EQIDOt").value <= 0){
		msg += "Ingrese codigo de Orden de Trabajo </br>";
	}

	if((document.getElementById("EQDescripcion").value).length <= 0){
		msg += "Ingrese descripcion de actividad </br>";
	}

	if((document.getElementById("EQCodigo").value).length <= 0){
		msg += "Ingrese Codigo de Equipo </br>";
	}

	var t = document.getElementById("EQTipo");
	if(t.options[t.selectedIndex].value < 0){
		msg += "Seleccione Tipo de Equipo </br>";
	}

	var m = document.getElementById("EQModelo");
	if(m.options[m.selectedIndex].value < 0){
		msg += "Seleccione Modelo de Equipo </br>";
	}

	var c = document.getElementById("EQContrato");
	if(c.options[c.selectedIndex].value < 0){
		msg += "Seleccione Tipo de Contrato </br>";
	}

	return msg;
}
// list vist improductiva
function editar(pkEquipo){
	// nesecito cargar mi vista de edicion!!
	
	if(pkEquipo > 0){
		$("#principal").load(url, {
			controlador: "Equipo",
			accion: "editar",
			pkEquipo: pkEquipo
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione Equipo!!";
		$('#messsageModal').modal('show');		
	}
}
function eliminar(pkEquipo, data){
	
	if(confirm("Esta seguro de eliminar el Equipo [" + data + "]?")){
		if(pkEquipo > 0){
			$("#principal").load(url, {
				controlador: "Equipo",
				accion: "eliminar",
				pkEquipo: pkEquipo
			});
		}

	}

}

function nuevo(){

	$("#principal").load(url, {
		controlador: "Equipo",
		accion: "nuevo"
	});

}

function salidafoco(){

	$.post(
				url, 
				{ 
				  controlador: "Equipo",
				  accion: "getOrdenTrabajo",
				  data : document.getElementById("EQOrdenTrabajo").value
				},
				function(datos){
					
					console.log("status : " + datos.status);

					if(datos.status == "error"){
						document.getElementById("EQIDOt").value = 0;
						document.getElementById("EQOrdenTrabajo").value = "";
						document.getElementById("EQNombreOt").innerHTML  = "";
					}else{
						document.getElementById("EQIDOt").value = datos.pkordentrabajo;
						document.getElementById("EQOrdenTrabajo").value = datos.data;
						document.getElementById("EQNombreOt").innerHTML  = datos.nombre;
					}
				}, "json"
		  );
}

function selectedModelo(){
	var equipos = document.getElementById("EQTipo");
	var pkeqtipo = equipos.options[equipos.selectedIndex].value;
	$.post(
				url, 
				{ 
				  controlador: "Equipo",
				  accion: "getModelos",
				  tipo : pkeqtipo
				},
				function(datos){
					
					console.log("status : " + datos.status);

					if(datos.status == "error"){
						cargarControles(null);
					}else{
						cargarControles(datos.modelos);
					}
					selectedCodigo();
				}, "json"
		  );

}

function cargarControles(modelos){
	if(modelos !== null){
		var smodelo = document.getElementById('EQModelo');
		smodelo.length = 0;
		for (var i = 0; i < modelos.length; i++){
			smodelo[i] = new Option(modelos[i].codigo + ' - ' + modelos[i].descripcion, modelos[i].pkeqmodelo);
		}
		smodelo.selectedIndex = -1;
	}else{
		document.getElementById('EQModelo').length = 0;
	}
}

function selectedCodigo(){
	var tipos = document.getElementById("EQTipo");
	var modelos = document.getElementById("EQModelo");
	var aux = "";
	
	var data = document.getElementById("EQCodigo").value;
	data = data.split("-");
	console.log(data);
	if(tipos.selectedIndex >= 0){
		aux = tipos.options[tipos.selectedIndex].text;
		aux = aux.split(" ");	
		document.getElementById("EQCodigo").value = aux[0];

	}else{
		document.getElementById("EQCodigo").value = "";
	}

	var data = document.getElementById("EQCodigo").value;
	data = data.split("-");
	if(modelos.selectedIndex >= 0){
		aux = modelos.options[modelos.selectedIndex].text;
		aux = aux.split(" ");
		document.getElementById("EQCodigo").value = data[0] + "-" + 
													aux[0] + "-  ";

	}else{
		document.getElementById("EQCodigo").value = data[0] + "-" + 
													"  -  ";
	}
}
