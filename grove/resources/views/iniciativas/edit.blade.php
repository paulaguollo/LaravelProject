@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <h2 class="mb-4">Editar Iniciativa</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('iniciativas.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $iniciativa->id }}">
            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $iniciativa->nome }}" required>
            </div>
            <div class="mb-3">
                <label>Categoria</label>
                <input type="text" name="categoria" class="form-control" value="{{ $iniciativa->categoria }}" required>
            </div>
            <div class="mb-3">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" rows="4" required>{{ $iniciativa->descricao }}</textarea>
            </div>
            <div class="mb-3">
                <label>Imagem atual</label><br>
                @if($iniciativa->imagem)
<img src="{{ Storage::url($iniciativa->imagem) }}" width="100" class="mb-2">                @else
                    <p>Sem imagem</p>
                @endif
                <input type="file" name="imagem" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-dark">Atualizar</button>
            <a href="{{ route('iniciativas.index') }}" class="btn btn-outline-dark ms-2">Cancelar</a>
        </form>
    </div>
</div>
@endsection
