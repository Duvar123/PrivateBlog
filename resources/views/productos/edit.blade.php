@extends('layouts.dashboard')

@section('title', 'Editar producto')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'productos'])

        <main class="adm-main adm-main--form-page">
            <div class="adm-form-shell">
                <header class="adm-form-header">
                    <h1 class="adm-main-title">Editar producto</h1>
                </header>

                <div class="adm-form-card">
                    @if ($errors->any())
                        <div class="mm-alert" role="alert">{{ $errors->first() }}</div>
                    @endif

                    @if ($categorias->isEmpty())
                        <div class="mm-alert" role="alert">No hay categorías disponibles.</div>
                    @else
                    <form method="POST" action="{{ route('productos.update', $producto) }}" class="adm-crud-form">
                        @csrf
                        @method('PUT')
                        <div class="mm-field">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required maxlength="180" autocomplete="off">
                        </div>
                        <div class="mm-field">
                            <label for="categoria_id">Categoría</label>
                            <select id="categoria_id" name="categoria_id" required>
                                @foreach ($categorias as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('categoria_id', $producto->categoria_id) == $cat->id)>{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="adm-crud-form-actions">
                            <button type="submit" class="learn-more learn-more--sm">Actualizar</button>
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
