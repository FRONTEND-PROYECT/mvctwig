var url = "./";

// funcion de los data time
$(function ()
	{
		$('#PEFechaIngreso').datetimepicker({
			locale : 'es'
		});
		$('#PEFechaNac').datetimepicker({
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
	$("#PEGuardar").click(function(evento){
		guardar();
	});
})
$(document).ready(function(){
	$("#PERetornar").click(function(evento){
		retornar();
	});
})

function retornar(){
	$("#principal").load( url, {
				    controlador: "Personal",
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
		var e = document.getElementById("PECargo");
		$("#principal").load(url, {
			controlador: "Personal",
			accion: "guardar",
			pkPersonal		: document.getElementById("PEPkPersonal").value,
			fechaIngreso 	: document.getElementById("PEFechaIngreso").value,
			nombreComp 		: document.getElementById("PENombre").value,
			apellidos 		: document.getElementById("PEApellidos").value,
			direccion 		: document.getElementById("PEDireccion").value,
			telefono 		: document.getElementById("PETelefono").value,
			ci 				: document.getElementById("PECi").value,
			fechaNac 		: document.getElementById("PEFechaNac").value,
			fkCargo			: e.options[e.selectedIndex].value,
			fkOrdenTrabajo 	: document.getElementById("PEIDOt").value,
			email 			: document.getElementById("PEEmail").value
		});
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function validar(){
	msg = "";
	if(document.getElementById("PEIDOt").value <= 0){
		msg += "Ingrese codigo de Orden de Trabajo </br>";
	}

	if((document.getElementById("PENombre").value).length <= 0){
		msg += "Ingrese nombre de personal  </br>";
	}

	var e = document.getElementById("PECargo");
	if(e.options[e.selectedIndex].value < 0){
		msg += "Seleccione un cargo de empleado </br>";
	}

	return msg;
}
// list vist improductiva
function editar(pkPersonal){
	// nesecito cargar mi vista de edicion!!
	
	if(pkPersonal > 0){
		$("#principal").load(url, {
			controlador: "Personal",
			accion: "editar",
			pkPersonal: pkPersonal
		});
	}else{		
		document.getElementById("idmsg").innerHTML = "Seleccione una Orden de Trabajo!!";
		$('#messsageModal').modal('show');		
	}
}
function eliminar(pkPersonal, data){
	
	if(confirm("Esta seguro de eliminar el personal [" + data + "]?")){
		if(pkPersonal > 0){
			$("#principal").load(url, {
				controlador: "Personal",
				accion: "eliminar",
				pkPersonal: pkPersonal
			});
		}

	}

}

function nuevo(){

	$("#principal").load(url, {
		controlador: "Personal",
		accion: "nuevo"
	});

}

function salidafoco(){

	$.post(
				url, 
				{ 
				  controlador: "Personal",
				  accion: "getOrdenTrabajo",
				  data : document.getElementById("PEOrdenTrabajo").value
				},
				function(datos){
					
					console.log("status : " + datos.status);

					if(datos.status == "error"){
						document.getElementById("PEIDOt").value = 0;
						document.getElementById("PEOrdenTrabajo").value = "";
						document.getElementById("PENombreOt").innerHTML  = "INGRESE ORDEN DE TRABAJO";

					}else{
						document.getElementById("PEIDOt").value = datos.pkordentrabajo;
						document.getElementById("PEOrdenTrabajo").value = datos.data;
						document.getElementById("PENombreOt").innerHTML  = datos.nombre;
					}
				}, "json"
		  );
}