var url = "./";

$(function ()
	{
		$('#GEFechaIni').datetimepicker({
			locale : 'es'
		});
		$('#GEFechaFin').datetimepicker({
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
	$("#GEGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#GERetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "Gestion",
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
		var t = document.getElementById("GEEstado");
		
		$("#principal").load(url, {
			controlador		: "Gestion",
			accion			: "guardar",
			pkGestion		: document.getElementById("GEPkGestion").value,
			codigo 			: document.getElementById("GECodigo").value,
			fechaIni		: document.getElementById("GEFechaIni").value,
			fechaFin		: document.getElementById("GEFechaFin").value,
			estado			: t.options[t.selectedIndex].value			
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show')
	}
}
function validar(){
	msg = "";
	
	if((document.getElementById("GECodigo").value).length <= 0){
		msg += "Ingrese Codigo de Gestion </br>";
	}

	var t = document.getElementById("GEEstado");
	if(t.options[t.selectedIndex].value < 0){
		msg += "Seleccione Estado de Gestion </br>";
	}

	return msg;
}
// list vist improductiva
function editar(pkGestion){
	// nesecito cargar mi vista de edicion!!
	
	if(pkGestion > 0){
		$("#principal").load(url, {
			controlador: "Gestion",
			accion: "editar",
			pkGestion: pkGestion
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione Gestion!!";
		$('#messsageModal').modal('show');		
	}
}
function eliminar(pkGestion, data){
	
	if(confirm("Esta seguro de eliminar la gestion [" + data + "]?")){
		if(pkGestion > 0){
			$("#principal").load(url, {
				controlador: "Gestion",
				accion: "eliminar",
				pkGestion: pkGestion
			});
		}

	}

}

function nuevo(){

	$("#principal").load(url, {
		controlador: "Gestion",
		accion: "nuevo"
	});

}