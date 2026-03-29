<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Módulo de Usuarios</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f4f6f9;
        }
        .header {
            height: 60px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid #ddd;
        }
        .main {
            display: flex;
            height: calc(100vh - 60px);
        }
        .sidebar {
            width: 220px;
            background: #f07c2f;
            color: white;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            margin: 0;
        }
        .menu-item {
            padding: 15px 20px;
            background: #e6d1c2;
            color: #333;
            cursor: pointer;
            border-bottom: 1px solid #ccc;
        }
        .menu-item:hover { background: #d4b8a3; }
        .content { flex: 1; padding: 20px; }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn {
            background: #3b82f6;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn:hover { background: #2563eb; }
        .search { margin-bottom: 15px; }
        .search input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td { padding: 12px; text-align: left; }
        th { background: #f1f1f1; }
        tr:nth-child(even) { background: #fafafa; }
        .btn-edit {
            background: #f59e0b;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .btn-delete {
            background: #ef4444;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

{{-- HEADER --}}
<div class="header">
    <div>Administrador > Usuarios</div>
    <div>👤 {{ auth()->user()->name ?? 'Usuario' }}</div>
</div>

{{-- MAIN --}}
<div class="main">

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <h2>Usuarios</h2>
        <div class="menu-item">Ver lista de usuarios</div>
        <div class="menu-item">Crear usuario</div>
        <div class="menu-item">Editar usuario</div>
        <div class="menu-item">Eliminar usuario</div>
    </div>

    {{-- CONTENIDO --}}
    <div class="content">

        <div class="content-header">
            <h2>Lista de Usuarios</h2>
            <button class="btn">Crear Usuario +</button>
        </div>

        {{-- BUSCADOR --}}
        <div class="search">
            <input type="text" placeholder="Buscar usuario...">
        </div>

        {{-- TABLA --}}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Cuando conectemos la BD los usuarios vendrán aquí --}}
                {{-- @foreach($usuarios as $usuario) --}}
                <tr>
                    <td>1</td>
                    <td>Juan Pérez</td>
                    <td>juan@email.com</td>
                    <td>Administrador</td>
                    <td>Activo</td>
                    <td>
                        <button class="btn-edit">Editar</button>
                        <button class="btn-delete">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ana Torres</td>
                    <td>ana@email.com</td>
                    <td>Bodeguero</td>
                    <td>Activo</td>
                    <td>
                        <button class="btn-edit">Editar</button>
                        <button class="btn-delete">Eliminar</button>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
