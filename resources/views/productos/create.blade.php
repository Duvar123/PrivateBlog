@extends('layouts.dashboard')

@section('title', 'Nuevo producto')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'productos'])

        <main class="adm-main adm-main--form-page">
            <div class="adm-form-shell">
                <header class="adm-form-header">
                    <h1 class="adm-main-title">Nuevo producto</h1>
                </header>

                <div class="adm-form-card">
                    @if ($errors->any())
                        <div class="mm-alert" role="alert">{{ $errors->first() }}</div>
                    @endif

                    @if ($categorias->isEmpty())
                        <div class="mm-alert" role="alert">Primero crea al menos una categoría.</div>
                        <p><a href="{{ route('categorias.create') }}" class="learn-more learn-more--sm learn-more--gold" style="text-decoration:none;display:inline-block;">Ir a crear categoría</a></p>
                    @else
                    <form method="POST" action="{{ route('productos.store') }}" class="adm-crud-form">
                        @csrf
                        <div class="mm-field">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required maxlength="180" autocomplete="off">
                        </div>
                        <div class="mm-field">
                            <label for="categoria_id">Categoría</label>
                            <select id="categoria_id" name="categoria_id" required>
                                <option value="">— Elige —</option>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('categoria_id') == $cat->id)>{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="adm-crud-form-actions">
                            <button type="submit" class="learn-more learn-more--sm">Guardar</button>
                            <a href="{{ route('productos.index') }}" class="learn-more learn-more--sm learn-more--gold" style="text-decoration:none;display:inline-block;">Volver</a>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
