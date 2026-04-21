<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mini Market</title>
    <link rel="stylesheet" href="{{ asset('css/pagina_principal.css') }}">
</head>
<body>

    <!-- HEADER -->
    <header>
        <h1>Mini Market 🛒</h1>
        <nav>
    <a href="#">Inicio</a>
    <a href="#">Productos</a>
    <a href="#">Ofertas</a>
    <a href="#">Contacto</a>

@auth
<div class="user-menu">
    <div class="user-name" onclick="toggleMenu()">
        👤 {{ Auth::user()->name }}
    </div>

    <div id="dropdown" class="dropdown">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>
</div>
@endauth

@guest
<a href="/login">Login</a>
@endguest
</nav>
    </header>

    <!-- HERO -->
    <section class="hero">
        <h2>Todo lo que necesitas, en un solo lugar</h2>
        <p>Productos frescos, precios bajos y atención rápida.</p>
        <button>Ver Productos</button>
    </section>

    <!-- PRODUCTOS -->
    <section class="productos">
        <h2>Productos Destacados</h2>
        <div class="grid">

      <a href="#" class="card link-card">
        <img src="https://images.unsplash.com/photo-1567306226416-28f0efdc88ce" alt="Frutas">
        <h3>Frutas</h3>
        <p>Frescas y saludables</p>
    </a>

    <a href="#" class="card link-card">
        <img src="https://images.unsplash.com/photo-1581009137042-c552e485697a" alt="Bebidas">
        <h3>Bebidas</h3>
        <p>Refrescantes opciones</p>
    </a>

    <a href="#" class="card link-card">
        <img src="https://images.unsplash.com/photo-1599490659213-e2b9527bd087" alt="Snacks">
        <h3>Snacks</h3>
        <p>Para cualquier momento</p>
    </a>

    <a href="#" class="card link-card">
        <img src="{{ asset('img/lacteos.webp') }}" alt="Lácteos">
        <h3>Lácteos</h3>
        <p>Calidad garantizada</p>
    </a>

</div>
    </section>

<div class="card">
    <img src="https://images.unsplash.com/photo-1608198093002-ad4e005484ec" alt="Panadería">
    <h3>Panadería</h3>
    <p>Pan fresco todos los días</p>
</div>

<div class="card">
    <img src="https://images.unsplash.com/photo-1607623814075-e51df1bdc82f" alt="Carnes">
    <h3>Carnes</h3>
    <p>Cortes frescos y de calidad</p>
</div>

<div class="card">
    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e" alt="Verduras">
    <h3>Verduras</h3>
    <p>Directo del campo</p>
</div>

<div class="card">
 <img src="{{ asset('img/congelados.webp') }}" alt="Congelados">
    <h3>Congelados</h3>
    <p>Listos para preparar</p>
</div>

<div class="card">
    <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952" alt="Limpieza">
    <h3>Limpieza</h3>
    <p>Todo para tu hogar</p>
</div>

<div class="card">
    <img src="{{ asset('img/facial.png') }}" alt="Aseo Personal">
    <h3>Aseo Personal</h3>
    <p>Cuidado diario</p>
</div>

<div class="card">
    <img src="{{ asset('img/enlatados.jpg') }}" alt="Enlatados">
    <h3>Enlatados</h3>
    <p>Fáciles y prácticos</p>
</div>

<div class="card">
     <img src="{{ asset('img/dulces.jpg') }}" alt="Dulces">
    <h3>Dulces</h3>
    <p>Para darte un gusto</p>
</div>
<footer>
        <p>© 2026 Mini Market - Todos los derechos reservados</p>
    </footer>
    <script>
function toggleMenu() {
    const menu = document.getElementById("dropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
</script>
</body>
</html>
