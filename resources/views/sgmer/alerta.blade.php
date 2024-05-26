@extends("home")
@section("title","painel de control -> alerta")
@section("tema", "Pagina de alerta")
@section("content")

<table class="table">
    <thead>
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

@endsection