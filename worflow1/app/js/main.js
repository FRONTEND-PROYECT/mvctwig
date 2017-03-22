(function(){
  function nombrar(nombre){
    return nombre;
  }
  function saludar(nombre){
    console.info(nombre, 'un saludo desde el javaScript');
  }

  saludar(nombrar("juan jose y maria"));
})();
