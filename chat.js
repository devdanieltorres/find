document.addEventListener("DOMContentLoaded", function() {
    var messageList = document.getElementById("message-list");
    var messageInput = document.getElementById("message-input");
    var sendButton = document.getElementById("send-button");
    var username = sendButton.getAttribute("data-id-Nome");
    var groupname = sendButton.getAttribute("data-id-Grupo");

    sendButton.addEventListener("click", function() {
      var message = messageInput.value;
      if (message !== "") {
        sendMessage(username, message, groupname); // Passa o nome do usuário, mensagem e nome do grupo
        messageInput.value = "";
      }
    });

    function sendMessage(username, message, groupname) {
      var agora = new Date();
      var horas = agora.getHours();
      var minutos = agora.getMinutes();
      
      var messageWithTime = message + " (" + horas + ":" + minutos + ")";
      
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "chat.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        }
      };
      xhr.send("username=" + encodeURIComponent(username) + "&message=" + encodeURIComponent(messageWithTime) + "&groupname=" + encodeURIComponent(groupname));
    }

    function receiveMessages() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "chat.php?groupname=" + encodeURIComponent(groupname), true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          renderMessages(response.messages);
        }
      };
      xhr.send();
    }

    function renderMessages(messages) {
      messageList.innerHTML = "";
      messages.forEach(function(message) {
        var li = document.createElement("li");
        li.textContent = message;
        messageList.appendChild(li);
      });
    }

    setInterval(receiveMessages, 2000); // Atualiza as mensagens a cada 2 segundos
});
