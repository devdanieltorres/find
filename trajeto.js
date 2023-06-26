
// esse código vai traçar uma rota até a localização do usuario selecionado

function trajeto(botao) {

    var latitude = botao.getAttribute("data-id-La");
    var longitude = botao.getAttribute("data-id-Lo");

    var minhalatitude = botao.getAttribute("data-id-MinhaLatitude");
    var minhalongitude = botao.getAttribute("data-id-MinhaLongitude");

    // cria rota de um local a outro com seta apontando o destino
    var routingParameters = {
        'routingMode': 'fast',
        'transportMode': 'car',
        'origin': minhalatitude + ',' + minhalongitude,
        'destination': latitude + ',' + longitude,
        'return': 'polyline'
    };

    // remove todos os marcadores antigos do mapa
    map.removeObjects(map.getObjects());

    // Define uma função de retorno de chamada para processar a resposta de roteamento
    var onResult = function (result) {

        // garante que pelo menos uma rota foi encontrada
        if (result.routes.length) {

            result.routes[0].sections.forEach((section) => {
                // Cria uma string de linha para usar como fonte de ponto para a linha de rota
                let linestring = H.geo.LineString.fromFlexiblePolyline(section.polyline);

                // Cria um marcador para o ponto inicial:
                let startMarker = new H.map.Marker(section.departure.place.location);

                // Cria um marcador para o ponto final:
                let endMarker = new H.map.Marker(section.arrival.place.location);

                // Cria um contorno para a polilinha da rota
                var routeOutline = new H.map.Polyline(linestring, {
                    style: {
                        lineWidth: 10,
                        strokeColor: 'rgba(0, 128, 255, 0.7)',
                        lineTailCap: 'arrow-tail',
                        lineHeadCap: 'arrow-head'
                    }
                });
                // Cria uma polilinha padronizada
                var routeArrows = new H.map.Polyline(linestring, {
                    style: {
                        lineWidth: 10,
                        fillColor: 'white',
                        strokeColor: 'rgba(255, 255, 255, 1)',
                        lineDash: [0, 2],
                        lineTailCap: 'arrow-tail',
                        lineHeadCap: 'arrow-head'
                    }
                }
                );

                var routeLine = new H.map.Group();
                routeLine.addObjects([routeOutline, routeArrows]);

                // Adicione a polilinha de rota e os dois marcadores ao mapa:
                map.addObjects([routeLine, startMarker, endMarker]);

                // Configura a viewport do mapa para tornar toda a rota visível:
                map.getViewModel().setLookAtData({ bounds: routeLine.getBoundingBox() });
            });
        }
    };
    // Obtenha uma instância do serviço de roteamento versão 8:
    var router = platform.getRoutingService(null, 8);

    router.calculateRoute(routingParameters, onResult);

}

// fecha o popup para mostrar a rota
function fecharPopupTrajeto(elemento) {
    var popup = elemento.closest('.popup-wrapper-trajeto');
    popup.style.display = 'none';
}