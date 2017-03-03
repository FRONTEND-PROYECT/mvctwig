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
	$("#IMGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#IMRetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "Improductiva",
					accion: "listar"}, 
					function(response, status, xhr){
						console.log("algo paso : " + status);
						console.log(response);
					}
	);
}
function guardar(){
	// obtenemos los datos
	msg = validar();
	if(msg.length <= 0 ){

		$("#principal").load(url, {
			controlador: "Improductiva",
			accion: "guardar",
			pkImproductiva	: document.getElementById("IMPkImproductiva").value,
			codigo 			: document.getElementById("IMCodigo").value,
			descripcion 	: document.getElementById("IMDescripcion").value
		});

	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	if((document.getElementById("IMCodigo").value).length <= 0){
		msg += "Ingrese codigo de actividad </br>";
	}
	if((document.getElementById("IMDescripcion").value).length <= 0){
		msg += "Ingrese descripcion de actividad </br>";
	}
	return msg;
}
// list vist improductiva
function editar(pkImproductiva){
	// nesecito cargar mi vista de edicion!!
	
	if(pkImproductiva > 0){
		$("#principal").load(url, {
			controlador: "Improductiva",
			accion: "editar",
			pkImproductiva: pkImproductiva
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione una actividad improductiva!!";
		$('#messsageModal').modal('show');		
	}
}

function eliminar(pkImproductiva, data){
	console.log("eliminar en improductiva.js");
	if(confirm("Esta seguro de eliminar la actividad [" + data + "]?")){
		
		if(pkImproductiva > 0){
			$("#principal").load(url, {
				controlador: "Improductiva",
				accion: "eliminar",
				pkImproductiva: pkImproductiva
			});
		}

	}

}


function nuevo(){

	$("#principal").load(url, {
		controlador: "Improductiva",
		accion: "nuevo"
	});

}