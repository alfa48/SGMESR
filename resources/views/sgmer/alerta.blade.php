@extends("home")
@section("title","painel de control -> alerta")
@section("tema", "Pagina de alerta")
@section("content")

<table class="table">
    <thead>
      <div class="text-center">
        <form method="GET" id="form1" action="192.168.1.1/setOff_buzzer">
        <label for="">desligar o alarme</label>
        <button id="button1" class="btn btn-primary btn-sm" style="width: 200px; height:50px; border-radius:8px;">OFF</button><br><br>
        </form>
      </div>
      <tr>
        <th>Mensagem</th>
        <th>Tipo</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($alertas as $alerta )
        <tr class="">
            <td>{{ $alerta->mensagem }}</td>
            <td>{{ $alerta->tipo}}</td>
            <td>{{ $alerta->created_at }}</td>
          </tr>
        @endforeach
     
   
    </tbody>
  </table>
  <script>

    document.getElementById("form1").addEventListener("submit", function(event) {
            event.preventDefault(); // Impede o envio do formulário padrão
            
            // Faça a requisição AJAX
            var xhr = new XMLHttpRequest();
          xhr.open("GET", "http://192.168.1.1/setOff_buzzer", true);
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
