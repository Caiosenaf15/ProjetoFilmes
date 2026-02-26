<?php
require_once __DIR__ . '/../helpers/helper.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CineTrack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* ================= LOGIN ================= */

.bg-login {
    background: linear-gradient(135deg, #7a528d, #255994);
    height: 100vh;
}

.login-container {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    width: 380px;
}

.login-card .form-control {
    border-radius: 12px;
}

.login-card .btn {
    border-radius: 12px;
    font-weight: 500;
}

/* ================= NAVBAR IOS ================= */

.ios-navbar {
    position: sticky;
    top: 0;
    z-index: 1000;

    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 14px 40px;

    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);

    background: rgba(255, 255, 255, 0.7);
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

/* Left */

.nav-left {
    display: flex;
    align-items: center;
    gap: 25px;
}

.logo {
    font-weight: 600;
    font-size: 20px;
    text-decoration: none;
    color: #000;
}

.nav-link-ios {
    text-decoration: none;
    color: #666;
    font-weight: 500;
    transition: 0.2s ease;
}

.nav-link-ios:hover {
    color: #000;
    transform: translateY(-1px);
}

/* Search */
/* ================= SEARCH IOS ================= */

.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.search-toggle {
    background: rgba(0,0,0,0.05);
    border: none;
    border-radius: 50%;
    width: 38px;
    height: 38px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.25s ease;
}

.search-toggle:hover {
    background: rgba(0,0,0,0.08);
    transform: scale(1.05);
}

.search-form {
    position: absolute;
    right: -220px;
    opacity: 0;
    transform: translateX(0px);
    pointer-events: none;
    transition: 0.3s ease;
}

.search-form.active {
    opacity: 1;
    transform: translateX(10%);
    pointer-events: auto;
}

.search-input-ios {
    width: 240px;
    padding: 8px 16px;
    border-radius: 10px;
    border: none;
    background: rgba(0,0,0,0.06);
    outline: none;
    transition: 0.2s ease;
}

.search-input-ios:focus {
    background: rgba(0,0,0,0.1);
}


.search-input {
    width: 260px;
    padding: 8px 16px;
    border-radius: 10px;
    border: none;
    background: rgba(0,0,0,0.05);
    outline: none;
    transition: 0.2s ease;
}

.search-input:focus {
    background: rgba(0,0,0,0.08);
}

/* Right */

.nav-right {
    display: flex;
    align-items: center;
    gap: 15px;
    color: black;
}

/* Avatar */

.user-menu {
    position: relative;
}

.avatar-btn {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: none;
    background: #000;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s ease;
}

.avatar-btn:hover {
    transform: scale(1.08);
}

/* Dropdown */

.dropdown-ios {
    position: absolute;
    right: 0;
    top: 55px;

    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);

    padding: 8px 0;
    min-width: 160px;

    opacity: 0;
    transform: translateY(-10px);
    pointer-events: none;
    transition: 0.2s ease;
}

.dropdown-ios.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.dropdown-ios a {
    display: block;
    padding: 10px 20px;
    text-decoration: none;
    color: #333;
    transition: 0.2s ease;
}

.dropdown-ios a:hover {
    background: #f5f5f7;
}

/* Toast */

.custom_toast {
    position: fixed;
    top: 30px;
    left: 50%;
    transform: translate(-50%, -20px) scale(0.95);
    opacity: 0;

    background: #3c64d7;
    color: white;
    padding: 12px 20px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);

    transition: 0.4s ease;
    z-index: 9999;
}

.custom_toast.show {
    opacity: 1;
    transform: translate(-50%, 0) scale(1);
}

.custom_toast.hide {
    opacity: 0;
    transform: translate(-50%, -30px) scale(0.85);
}

</style>
</head>

<body class="<?= !empty($hideNavbar) ? 'bg-login' : '' ?>">

<?php if (empty($hideNavbar)) : ?>

<nav class="ios-navbar">

    <div class="nav-left">
        <a href="/" class="logo">🍿 CineTrack</a>

        <a href="/categorias" class="nav-link-ios">Categorias</a>
        <a href="/filmesPopulares" class="nav-link-ios">Populares</a>
        <a href="/lancamentos" class="nav-link-ios">Próximos lançamentos</a>
        <div class="search-wrapper">
            <button class="search-toggle" onclick="toggleSearch()">🔍</button>
            <form method="GET" action="/buscar" class="search-form" id="searchForm">
                <input 
                    type="search" 
                    name="q" 
                    placeholder="Buscar filmes..."
                    class="search-input-ios"
                    id="searchInput"
                >
            </form>
        </div>
</div>

    <div class="nav-right">
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-menu">
                <button class="avatar-btn" onclick="toggleMenu()">
                    <?= strtoupper(substr($_SESSION['username'], 0, 1)) ?>
                </button>

                <div class="dropdown-ios" id="dropdownMenu">
                    <a href="/profile">Perfil</a>
                    <a href="/logout">Sair</a>
                </div>
            </div>
        <?php else: ?>
            <a href="/login">
                <button>Login</button>
            </a>
        <?php endif; ?>
    </div>

</nav>

<div class="container mt-4">

<?php else: ?>
<div class="login-container">
<?php endif; ?>

<?= $content ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleMenu() {
    const menu = document.getElementById("dropdownMenu");
    menu.classList.toggle("show");
}

document.addEventListener("click", function(e) {
    const menu = document.getElementById("dropdownMenu");
    const button = document.querySelector(".avatar-btn");

    if (!button?.contains(e.target) && !menu?.contains(e.target)) {
        menu?.classList.remove("show");
    }
});
</script>

<script>
function toggleSearch() {
    const form = document.getElementById("searchForm");
    const input = document.getElementById("searchInput");

    form.classList.toggle("active");

    if (form.classList.contains("active")) {
        setTimeout(() => input.focus(), 200);
    }
}

document.addEventListener("click", function(e) {
    const wrapper = document.querySelector(".search-wrapper");
    const form = document.getElementById("searchForm");

    if (!wrapper.contains(e.target)) {
        form.classList.remove("active");
    }
});
</script>


<script>
window.addEventListener("load", function() {
    const toast = document.getElementById("custom_toast");
    if (!toast) return;

    setTimeout(() => toast.classList.add("show"), 100);
    setTimeout(() => {
        toast.classList.remove("show");
        toast.classList.add("hide");
    }, 5000);
});
</script>

</body>
</html>
