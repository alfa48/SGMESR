@extends("home")
@section("title","painel de control -> configurar")
@section("tema","Dados da Casa")
@section("content")
   
<div class="text-center">
  <form method="GET" id="form1" action="192.168.1.1/swhich_led1">
  <label for="">Status do Circuito 1</label>
  <button id="button1" class="btn btn-primary btn-sm" style="width: 200px; height:50px; border-radius:8px;">OFF</button><br><br>
  </form>
  <p></p>

  <form method="GET" id="form2" action="192.168.1.1/swhich_led2">
  <label for="">Status do Circuito 2</label>
  <button id="button2" class="btn btn-primary btn-sm" style="width: 200px;height:50px; border-radius:8px;">OFF</button>
  </form>

  <form method="GET" id="form3" action="192.168.1.1/onledYellow">
    <label for="">Status do Circuito 2</label>
    <button id="button3" class="btn btn-primary btn-sm" style="width: 200px;height:50px; border-radius:8px;">OFF</button>
    </form>
</div>

<script>
 // Função para alternar o texto do botão e armazenar o estado
function toggleButton(button) {
    if (button.textContent === "OFF") {
        button.textContent = "ON";
        sessionStorage.setItem('button1State', 'ON'); // Armazena o estado no sessionStorage
    } else {
        button.textContent = "OFF";
        sessionStorage.setItem('button1State', 'OFF'); // Armazena o estado no sessionStorage
    }
}

// Selecionar o botão pelo ID
const button1 = document.getElementById('button1');

// Verificar se o estado do botão foi armazenado e definir o texto do botão de acordo
if (sessionStorage.getItem('button1State') === 'ON') {
    button1.textContent = "ON";
}

// Adicionar evento de clique ao botão
button1.addEventListener('click', function() {
    toggleButton(button1);
});

  button2.addEventListener('click', function() {
    toggleButton(button2);
  });
  button3.addEventListener('click', function() {
    toggleButton(button3);
  });

    document.getElementById("form1").addEventListener("submit", function(event) {
        event.preventDefault(); // Impede o envio do formulário padrão
        
        // Faça a requisição AJAX
        var xhr = new XMLHttpRequest();
      xhr.open("GET", "http://192.168.1.1/swhich_led1", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
           if (xhr.readyState == 4 && xhr.status == 200) {
                // Redireciona para a página atual
                window.location.href = window.location.href;
           }
        };
        xhr.send(); // Envia a requisição
    });
    
    document.getElementById("form2").addEventListener("submit", function(event) {
        event.preventDefault(); // Impede o envio do formulário padrão
        
        // Faça a requisição AJAX
        var xhr = new XMLHttpRequest();
      xhr.open("GET", "http://192.168.1.1/swhich_led2", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
           if (xhr.readyState == 4 && xhr.status == 200) {
                // Redireciona para a página atual
                window.location.href = window.location.href;
           }
        };
        xhr.send(); // Envia a requisição
    });

    document.getElementById("form3").addEventListener("submit", function(event) {
        event.preventDefault(); // Impede o envio do formulário padrão
        
        // Faça a requisição AJAX
        var xhr = new XMLHttpRequest();
      xhr.open("GET", "http://192.168.1.1/onledYellow", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
           if (xhr.readyState == 4 && xhr.status == 200) {
                // Redireciona para a página atual
                window.location.href = window.location.href;
           }
        };
        xhr.send(); // Envia a requisição
    });

</script>
@endsection