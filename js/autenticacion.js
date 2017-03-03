var url = "./";

function validar(){
	
	nick = document.getElementById("nickname").value;
	pass = document.getElementById("password").value;	
	msg = verificar(nick, pass);
	console.log("nick : " + nick + " pass : " + pass);
	if(msg.length <= 0){
		$.post(url, {
			controlador: 'Autenticacion',
			accion: 'validar',
			nickname: nick,
			password: pass},
			enviarFormulario,
			"json"
		);
	}else{
		document.getElementById("idmsg").innerHTML = msg;
		$('#messsageModal').modal('show');
	}
}
function verificar(nick, pass){
	msg="";

	if(nick.length <= 0)
		msg = "Ingrese nombre de usuario </br>";
	if(pass.length <= 0)
		msg += "Ingrese una contraseña </br>";

	return msg;
}
function enviarFormulario(data){
	console.log("llegue como resultado js");
	if(data.status == "error"){		
		document.getElementById("idmsg").innerHTML = "Usuario o contraseña incorrectas!!";
		$('#messsageModal').modal('show');		
	}else{
		console.log("Se valido correctamente");
		$("#formlogin").submit();
	}
}