@extends("home")
@section("title", "painel de control -> ajuda")
@section("tema", "Ajuda e Suporte")
@section("content")

<div>


@foreach ($perguntas as $pergunta )
<details class="accordion" close>
    <summary class="accordion-header">
        {{ $pergunta->Pergunta }}
    </summary>
    <div class="accordion-body">
        {{ $pergunta->Resposta }}
    </div>
</details>


@endforeach  

@if ($perguntas->previousPageUrl())
    <a href="{{ $perguntas->previousPageUrl() }}" class="pagination-link">&lsaquo; Anterior</a>
@endif

@if ($perguntas->nextPageUrl())
    <a href="{{ $perguntas->nextPageUrl() }}" class="pagination-link">Próximo &rsaquo;</a>
@endif

</div>


@endsection 