// atualiza a localização do usuário no banco de dados a cada 2 segundos
setInterval(function() {
  navigator.geolocation.getCurrentPosition(callback);

function callback(position) {
  const agora = new Date();
  const ano = agora.getFullYear();
  const mes = agora.getMonth() + 1;
  const dia = agora.getDate();
  const horas = agora.getHours();
  const minutos = agora.getMinutes();
  const segundos = agora.getSeconds();
  
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

    }
  };
  xhttp.open("GET", "inserirLocal.php?local=" + latitude +"/"+ longitude, true);
  xhttp.send();

  var xhttps = new XMLHttpRequest();
  xhttps.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
    }
  };
  xhttps.open("GET", "inserirHorario.php?horario=" + dia + "/" + mes + "/" + ano + " " + horas + ":" + minutos + ":" + segundos, true);

  xhttps.send();

}
  //console.log("Executando código...");
}, 2000);