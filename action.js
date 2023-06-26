// mapa interativo

/**
 * @param  {H.Map} map      Uma instância do HERE Map dentro do aplicativo
 */
function setInteractive(map) {
  // obtém o provedor de vetor da camada base
  var provider = map.getBaseLayer().getProvider();

  // obtém o objeto de estilo para a camada base
  var style = provider.getStyle();

  var changeListener = (evt) => {
    if (style.getState() === H.map.Style.State.READY) {
      style.removeEventListener('change', changeListener);

      // ativa interações para os recursos de mapa desejados
      style.setInteractive(['places', 'places.populated-places'], true);

      // adiciona um event listener que é responsável por capturar o
      // evento 'tap' no recurso e mostrando a infobubble
      provider.addEventListener('tap', onTap);
    }
  };
  style.addEventListener('change', changeListener);
}

//O código de inicialização do mapa clichê começa abaixo:
//inicializar a comunicação com a plataforma
var platform = new H.service.Platform({
  apikey: 'D-VNDM0nJRdGehPgcdtiRx6ozxye7AYVYdslh8Y101M'
});
var defaultLayers = platform.createDefaultLayers();

//inicializar um mapa
var map = new H.Map(document.getElementById('map'),
  defaultLayers.vector.normal.map, {
  center: { lat: -15.8234, lng: -10.1158 },
  zoom: 3,
  pixelRatio: window.devicePixelRatio || 1
});

// adiciona um ouvinte de redimensionamento para garantir que o mapa ocupe todo o contêiner
window.addEventListener('resize', () => map.getViewPort().resize());

// tornar o mapa interativo
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// Cria os componentes de IU padrão
var ui = H.ui.UI.createDefault(map, defaultLayers);

var bubble;
/**
 * @param {H.mapevents.Event} e The event object
 */
function onTap(evt) {
  // calcula a posição da infobubble a partir das coordenadas da tela do cursor
  let position = map.screenToGeo(
    evt.currentPointer.viewportX,
    evt.currentPointer.viewportY
  );
  // lê as propriedades associadas ao recurso de mapa que acionou o evento
  let props = evt.target.getData().properties;

  // cria um conteúdo para a infobubble
  let content = '<div style="width:250px">It is a ' + props.kind + ' ' + (props.kind_detail || '') +
    (props.population ? '<br /> population: ' + props.population : '') +
    '<br /> local name is ' + props['name'] +
    (props['name:ar'] ? '<br /> name in Arabic is ' + props['name:ar'] : '') + '</div>';

  // Cria uma bolha, se ainda não foi criada
  if (!bubble) {
    bubble = new H.ui.InfoBubble(position, {
      content: content
    });
    ui.addBubble(bubble);
  } else {
    // Reutiliza o objeto bolha existente
    bubble.setPosition(position);
    bubble.setContent(content);
    bubble.open();
  }
}

// Agora use o mapa
setInteractive(map);

// adiciona opção de zoom e mapa de satelite:
var ui = H.ui.UI.createDefault(map, defaultLayers, 'pt-BR');


//----------------------------------------------------
// Obtém uma instância do serviço de busca de localização
var service = platform.getSearchService();

const form = document.getElementById('form')
form.addEventListener("submit", function (event) {
  // remove todos os marcadores antigos do mapa
  map.removeObjects(map.getObjects());

  event.preventDefault();
  const input = document.getElementById("endereco").value + ", Brasil";
  service.geocode({
    q: input
  }, (result) => {
    // Adiciona um marcador para cada local encontrado
    result.items.forEach((item) => {
      map.addObject(new H.map.Marker(item.position));
      map.setCenter(item.position);
      map.setZoom(16);
    });
  });
});

//-------------------botão atualizar---------------------
function atualizarPagina() {
  location.reload();
}

//-------------------sair---------------------
// Faz um redirecionamento sem adicionar a página original ao histórico de navegação do browser.
document.getElementById("sair").addEventListener("click", function () {
  location.replace("login.php");

});

//-------------------popup grupo---------------------
const buttonGroup = document.querySelector('#group')

const popupGroup = document.querySelector('.popup-wrapper-group')

buttonGroup.addEventListener('click', () => {
  popupGroup.style.display = 'block'
})

popupGroup.addEventListener('click', event => {
  const classNameOfClickedElement = event.target.classList[0]
  const classNames = ['popup-close-group', 'popup-wrapper-group', 'popup-group-link']
  const shouldClosePopup = classNames.some(className => className === classNameOfClickedElement)

  if (shouldClosePopup) {
    popupGroup.style.display = 'none'
  }
})

//-------------------popup alterar---------------------
const buttonAlterar = document.querySelector('#alterar')

const popupAlterar = document.querySelector('.popup-wrapper-alterar')

buttonAlterar.addEventListener('click', () => {
  //fecha popupConfig
  popupConfig.style.display = 'none'

  event.preventDefault();
  popupAlterar.style.display = 'block'
})

popupAlterar.addEventListener('click', event => {
  const classNameOfClickedElement = event.target.classList[0]
  const classNames = ['popup-close-alterar', 'popup-wrapper-alterar', 'popup-alterar-link']
  const shouldClosePopup = classNames.some(className => className === classNameOfClickedElement)

  if (shouldClosePopup) {
    popupAlterar.style.display = 'none'
  }
})

//-------------------popup deletar---------------------
const buttonDeletar = document.querySelector('#deletar')

const popupDeletar = document.querySelector('.popup-wrapper-deletar')

buttonDeletar.addEventListener('click', () => {
  //fecha popupConfig
  popupConfig.style.display = 'none'

  event.preventDefault();
  popupDeletar.style.display = 'block'
})

popupDeletar.addEventListener('click', event => {
  const classNameOfClickedElement = event.target.classList[0]
  const classNames = ['popup-close-deletar', 'popup-wrapper-deletar', 'popup-deletar-link']
  const shouldClosePopup = classNames.some(className => className === classNameOfClickedElement)

  if (shouldClosePopup) {
    popupDeletar.style.display = 'none'
  }
})

//-------------------popup chat---------------------

const buttonChat = document.querySelector('#chat')

const popupChat = document.querySelector('.popup-wrapper-chat')

buttonChat.addEventListener('click', () => {
  popupChat.style.display = 'block'
})

popupChat.addEventListener('click', event => {
  const classNameOfClickedElement = event.target.classList[0]
  const classNames = ['popup-close-chat', 'popup-wrapper-chat', 'popup-chat-link']
  const shouldClosePopup = classNames.some(className => className === classNameOfClickedElement)

  if (shouldClosePopup) {
    popupChat.style.display = 'none'
  }
})

//-------------------popup config---------------------
const buttonConfig = document.querySelector('#config')

const popupConfig = document.querySelector('.popup-wrapper-conf')

buttonConfig.addEventListener('click', () => {
  popupConfig.style.display = 'block'
})

popupConfig.addEventListener('click', event => {
  const classNameOfClickedElement = event.target.classList[0]
  const classNames = ['popup-close-conf', 'popup-wrapper-conf', 'popup-conf-link']
  const shouldClosePopup = classNames.some(className => className === classNameOfClickedElement)

  if (shouldClosePopup) {
    popupConfig.style.display = 'none'
  }
})

//-------------------popup local---------------------
const buttonLocal = document.querySelector('#user-location')

const popupLocal = document.querySelector('.popup-wrapper-loc')

buttonLocal.addEventListener('click', () => {
  popupLocal.style.display = 'block'
})

popupLocal.addEventListener('click', event => {
  const classNameOfClickedElement = event.target.classList[0]
  const classNames = ['popup-close-loc', 'popup-wrapper-loc', 'popup-loc-link']
  const shouldClosePopup = classNames.some(className => className === classNameOfClickedElement)

  if (shouldClosePopup) {
    popupLocal.style.display = 'none'
  }
})

//-------------------popup trajeto---------------------
const buttonTrajeto = document.querySelector('#user-route')

const popupTrajeto = document.querySelector('.popup-wrapper-trajeto')

buttonTrajeto.addEventListener('click', () => {
  popupTrajeto.style.display = 'block'
})

popupTrajeto.addEventListener('click', event => {
  const classNameOfClickedElement = event.target.classList[0]
  const classNames = ['popup-close-trajeto', 'popup-wrapper-trajeto', 'popup-trajeto-link']
  const shouldClosePopup = classNames.some(className => className === classNameOfClickedElement)

  if (shouldClosePopup) {
    popupTrajeto.style.display = 'none'
  }
})

//-------------------enviar mensagem no enter---------------------

var messageInput = document.getElementById('message-input');
    var sendButton = document.getElementById('send-button');

    messageInput.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            sendButton.click();
        }
    });