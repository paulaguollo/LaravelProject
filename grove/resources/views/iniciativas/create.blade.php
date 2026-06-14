@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <h2 class="mb-4">Nova Iniciativa</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('iniciativas.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Categoria</label>
                <input type="text" name="categoria" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label>Imagem</label>
                <input type="file" name="imagem" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-dark">Guardar</button>
            <a href="{{ route('iniciativas.index') }}" class="btn btn-outline-dark ms-2">Cancelar</a>
        </form>
    </div>
</div>
@endsection
