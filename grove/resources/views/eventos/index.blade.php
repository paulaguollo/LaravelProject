@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Eventos — {{ $iniciativa->nome }}</h2>
    @auth
        @if(Auth::user()->user_type == 1)
            <a href="{{ route('eventos.create', $iniciativa->id) }}" class="btn btn-dark">+ Novo Evento</a>
        @endif
    @endauth
</div>

@if($eventos->isEmpty())
    <p>Ainda não há eventos para esta iniciativa.</p>
@else
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Data</th>
                @auth
                    <th>Ações</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td>
                    @if($evento->imagem)
                        <img src="{{ asset('storage/' . $evento->imagem) }}" width="80">
                    @else
                        Sem imagem
                    @endif
                </td>
                <td>{{ $evento->nome }}</td>
                <td>{{ $evento->data_realizacao }}</td>
                @auth
                <td>
                    <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    @if(Auth::user()->user_type == 1)
                        <form method="POST" action="{{ route('eventos.destroy', $evento->id) }}" style="display:inline" onsubmit="return confirm('Tem a certeza?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Apagar</button>
                        </form>
                    @endif
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
@endif

<a href="{{ route('iniciativas.index') }}" class="btn btn-outline-dark mt-3">← Voltar</a>
@endsection
