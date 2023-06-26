// mostra a localização do usuario selecionado

function localizar(botao) {
    // Obtenha a latitude e longitude do botão clicado
    var latitude = botao.getAttribute("data-id-La");
    var longitude = botao.getAttribute("data-id-Lo");

    position = {
        lat: latitude,
        lng: longitude
    };
    
    // remove todos os marcadores antigos do mapa
    map.removeObjects(map.getObjects());

    // adiciona um novo marcador para a posição do novo usuário selecionado
    map.setCenter(position)
    marker = new H.map.Marker(position);
    map.addObject(marker);
    map.setZoom(16);
    return position;
}

// fecha o popup para mostrar a localização
function fecharPopupLocal(elemento) {
    var popup = elemento.closest('.popup-wrapper-loc');
    popup.style.display = 'none';
}
