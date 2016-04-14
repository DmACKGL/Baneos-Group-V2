function validar() {
  if (document.Form1.usuario.value == "") {
    alert("Por favor ingrese el nombre de usuario.");
    return false;
  }

  if(document.Form1.clave.value == "") {
    alert("Por favor ingrese la clave.");
    return false;
  }

  return true;
}
