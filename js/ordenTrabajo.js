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
	$("#OTGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#OTRetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "OrdenTrabajo",
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
		var e = document.getElementById("OTEstado");
		$("#principal").load(url, {
			controlador: "OrdenTrabajo",
			accion: "guardar",
			pkOrdenTrabajo	: document.getElementById("OTPkOrdenTrabajo").value,
			codigo 			: document.getElementById("OTCodigo").value,
			fkGestion 		: document.getElementById("IDGestion").value,
			nombre 			: document.getElementById("OTNombre").value,
			supervisor 		: document.getElementById("OTSupervisor").value,
			areaEstimada 	: document.getElementById("OTAreaEstimada").value,
			estado			: e.options[e.selectedIndex].value,
			data 			: document.getElementById("OTCodigo").value + '-' + document.getElementById("OTGestion").value
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	if((document.getElementById("OTCodigo").value).length <= 0){
		msg += "Ingrese codigo de Orden de Trabajo </br>";
	}
	if((document.getElementById("OTNombre").value).length <= 0){
		msg += "Ingrese nombre de Orden de Trabajo </br>";
	}
	if(document.getElementById("IDGestion").value <= 0){
		msg += "No se encontró Gestion Activa </br>";
	}
	return msg;
}
// list vist improductiva
function editar(pkOrdenTrabajo){
	// nesecito cargar mi vista de edicion!!
	
	if(pkOrdenTrabajo > 0){
		$("#principal").load(url, {
			controlador: "OrdenTrabajo",
			accion: "editar",
			pkOrdenTrabajo: pkOrdenTrabajo
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione una Orden de Trabajo!!";
		$('#messsageModal').modal('show')
	}
}

function eliminar(pkOrdenTrabajo, data){
	console.log("eliminar en OrdenTrabajo.js");
	if(confirm("Esta seguro de eliminar la Orden de Trabajo [" + data + "]?")){
		if(pkOrdenTrabajo > 0){
			$("#principal").load(url, {
				controlador: "OrdenTrabajo",
				accion: "eliminar",
				pkOrdenTrabajo: pkOrdenTrabajo
			});
		}

	}

}

function nuevo(){

	$("#principal").load(url, {
		controlador: "OrdenTrabajo",
		accion: "nuevo"
	});

}