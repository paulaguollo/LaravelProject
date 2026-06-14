@extends('layouts.app')

@section('content')
<h2>Dashboard</h2>

@if(Auth::user()->user_type == 1)
    <div class="alert alert-warning mt-3">
        <strong>Conta de Administrador</strong>
    </div>
@endif

<div class="alert alert-success mt-3">
    Olá, {{ Auth::user()->name }}!
</div>

<div class="mt-4">
    <a href="{{ route('iniciativas.index') }}" class="btn btn-dark">Ver Iniciativas</a>
</div>
@endsection
