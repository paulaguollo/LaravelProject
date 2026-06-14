@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Iniciativas</h2>
    @auth
        @if(Auth::user()->user_type == 1)
            <a href="{{ route('iniciativas.create') }}" class="btn btn-dark">+ Nova Iniciativa</a>
        @endif
    @endauth
</div>

<form method="GET" action="{{ route('iniciativas.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Pesquisar iniciativa..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-dark">Pesquisar</button>
    </div>
</form>

@if($iniciativas->isEmpty())
    <p>Ainda não há iniciativas registadas.</p>
@else
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Eventos</th>
                @auth
                    <th>Ações</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach($iniciativas as $iniciativa)
            <tr>
                <td>
                    @if($iniciativa->imagem)
                        <img src="{{ asset('storage/' . $iniciativa->imagem) }}" width="80">
                    @else
                        Sem imagem
                    @endif
                </td>
                <td>{{ $iniciativa->nome }}</td>
                <td>{{ $iniciativa->categoria }}</td>
                <td>
                    <a href="{{ route('eventos.index', $iniciativa->id) }}" class="btn btn-sm btn-outline-dark">Ver Eventos</a>
                </td>
                @auth
                <td>
                    <a href="{{ route('iniciativas.edit', $iniciativa->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    @if(Auth::user()->user_type == 1)
                        <form method="POST" action="{{ route('iniciativas.destroy', $iniciativa->id) }}" style="display:inline" onsubmit="return confirm('Tem a certeza?')">
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
@endsection
