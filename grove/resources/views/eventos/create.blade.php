@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <h2 class="mb-4">Novo Evento — {{ $iniciativa->nome }}</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('eventos.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="iniciativa_id" value="{{ $iniciativa->id }}">
            <div class="mb-3">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Data de Realização</label>
                <input type="date" name="data_realizacao" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Imagem</label>
                <input type="file" name="imagem" class="form-control" accept="image/*">
            </div>
            <button type="submit" class="btn btn-dark">Guardar</button>
            <a href="{{ route('eventos.index', $iniciativa->id) }}" class="btn btn-outline-dark ms-2">Cancelar</a>
        </form>
    </div>
</div>
@endsection
