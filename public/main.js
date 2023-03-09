var socket = io.connect("http://localhost:3000", { forceNew: true });

socket.on("mensajeAlarma", function (data) {
  console.log(data);
  render(data);
});

function render(data) {
  /*var html = data
    .map(function (elem, index) {
      return `<div>
              <strong>${elem.author}</strong>:
              <em>${elem.text}</em>
            </div>`;
    })
    .join(" ");*/

  document.getElementById("messages").innerHTML = data;
}

function addMessage(e) {
  var message = {
    author: document.getElementById("username").value,
    text: document.getElementById("texto").value,
  };

  socket.emit("new-message", message);
  return false;
}

