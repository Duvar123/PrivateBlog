@extends('layouts.dashboard')

@section('title', 'Nueva categoría')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'categorias'])

        <main class="adm-main adm-main--form-page">
            <div class="adm-form-shell">
                <header class="adm-form-header">
                    <h1 class="adm-main-title">Nueva categoría</h1>
                </header>

                <div class="adm-form-card">
                    @if ($errors->any())
                        <div class="mm-alert" role="alert">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('categorias.store') }}" class="adm-crud-form">
                        @csrf
                        <div class="mm-field">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required maxlength="120" autocomplete="off">
                        </div>
                        <div class="adm-crud-form-actions">
                            <button type="submit" class="learn-more learn-more--sm">Guardar</button>
                            <a href="{{ route('categorias.index') }}" class="learn-more learn-more--sm learn-more--gold" style="text-decoration:none;display:inline-block;">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
