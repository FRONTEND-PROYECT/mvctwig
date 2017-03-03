var url = "./";


$(document).ready(function(){
	$("#idFImproductiva").click(function(evento){
		cargarForumulario(evento, "Improductiva", "listar");	
	});
	$("#idFOt").click(function(evento){
		cargarForumulario(evento, "OrdenTrabajo", "listar");	
	});
	$("#idFPersonal").click(function(evento){
		cargarForumulario(evento, "Personal", "listar");
	});
	$("#idFProductiva").click(function(evento){
		cargarForumulario(evento, "ItemObra", "listar")
	});

	$("#idFEquipo").click(function(evento){
		cargarForumulario(evento, "Equipo", "listar")
	});

	$("#idFGestion").click(function(evento){
		cargarForumulario(evento, "Gestion", "listar")
	});


	$("#idFTransfPersonal").click(function(evento){
		cargarForumulario(evento, "TransfPersonal", "listar")
	});

	$("#idFTransfEquipo").click(function(evento){
		cargarForumulario(evento, "TransfEquipo", "listar")
	});

	$("#inicio").click(function(evento){
		cargarForumulario(evento, "Autenticacion", "inicio")
	})


	// deshabilitamos los links
    var navItems = $('.admin-menu li > a');
    var navListItems = $('.admin-menu li');
    var allWells = $('.admin-content');
    var allWellsExceptFirst = $('.admin-content:not(:first)');
    
    allWellsExceptFirst.hide();
    navItems.click(function(e)
    {

	e.preventDefault();
	        navListItems.removeClass('active');
	        $(this).closest('li').addClass('active');
    });

})

function cargarForumulario(evento, controll, action){
	
	evento.preventDefault();
	console.log("controlador : " + controll);
	console.log("Accion : " +action);

	$("#principal").load( url, {
				    controlador: controll,
					accion: action}, 
					function(response, status, xhr){
						console.log("algo paso : " + status);
						console.log("algo paso : " + response);
					}
	);
}