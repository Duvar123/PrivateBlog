@extends('layouts.dashboard')

@section('title', 'Nuevo rol')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'roles'])

        <main class="adm-main adm-main--form-page">
            @if ($errors->any())
                <div class="mm-alert" role="alert" style="margin-bottom:1rem;">{{ $errors->first() }}</div>
            @endif

            <form id="frmRole" method="POST" action="{{ route('roles.store') }}" class="adm-crud-form">
                @csrf

                <div class="card" style="padding:20px;margin-bottom:20px;">
                    <h2 style="margin-bottom:20px;">Nuevo rol</h2>
                    <div class="mm-field">
                        <label for="name">Nombre</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required maxlength="64" autocomplete="off">
                    </div>
                </div>

                @include('partials.role-permissions-switches', ['modules' => $modules])

                <div class="adm-crud-form-actions" style="margin-top:40px;">
                    <button type="submit" class="learn-more learn-more--sm">Guardar</button>
                    <a href="{{ route('roles.index') }}" class="learn-more learn-more--sm learn-more--gold" style="text-decoration:none;display:inline-block;">Volver</a>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
