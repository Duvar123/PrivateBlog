@extends('layouts.dashboard')

@section('title', 'Editar rol')

@section('content')
<div class="adm-app">
    <div class="adm-body">
        @include('partials.adm-sidebar', ['navActive' => 'roles'])

        <main class="adm-main">
            @if ($errors->any())
                <div class="mm-alert" role="alert" style="margin-bottom:1rem;">{{ $errors->first() }}</div>
            @endif

            <form id="frmRole" method="POST" action="{{ route('roles.update', $rol) }}">
                @csrf
                @method('PUT')

                <div class="card" style="padding:20px;margin-bottom:20px;">
                    <h2 style="margin-bottom:20px;">Editar rol</h2>
                    <input type="text" name="name" value="{{ old('name', $rol->name) }}" class="form-control" style="width:350px;" required maxlength="64">
                </div>

                @include('partials.role-permissions-switches', ['modules' => $modules])

                <div style="margin-top:40px;">
                    <button type="submit" class="learn-more learn-more--blue">Guardar</button>
                    <a href="{{ route('roles.index') }}" class="learn-more">Volver</a>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
