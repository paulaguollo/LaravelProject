@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <h2 class="mb-4">Editar Evento</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('eventos.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $evento->id }}">
            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $evento->nome }}" required>
            </div>
            <div class="mb-3">
                <label>Data de Realização</label>
                <input type="date" name="data_realizacao" class="form-control" value="{{ $evento->data_realizacao }}" required>
            </div>
            <div class="mb-3">
                <label>Imagem atual</label><br>
                @if($evento->imagem)
<img src="{{ Storage::url($evento->imagem) }}" width="100" class="mb-2">                @else
                    <p>Sem imagem</p>
                @endif
                <input type="file" name="imagem" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-dark">Atualizar</button>
            <a href="{{ route('eventos.index', $evento->iniciativa_id) }}" class="btn btn-outline-dark ms-2">Cancelar</a>
        </form>
    </div>
</div>
@endsection
