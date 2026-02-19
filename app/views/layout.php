<?php
require_once __DIR__ . '/../helpers/helper.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CineTrack</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
            border-radius: 15px;
            box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.4);
            width: 380px;
        }

        .login-card .form-control {
            border-radius: 10px;
        }

        .login-card .btn {
            border-radius: 10px;
            font-weight: 500;
        }
        
        .login-links a {
            font-size: 0.9rem;
            color: #0d6efd;
            transition: 0.2s;
        }

        .login-links a:hover {
            opacity: 0.7;
        }
        .custom_toast {
            position: fixed;
            top: 30px;
            left: 50%;
            transform: translate(-50%, -20px) scale(0.95);
            opacity: 0;

            background: rgb(60, 100, 215);
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            box-shadow: 2px 2px 10px rgb(0,0,0,0.5);

            transition: 
                opacity 0.4s ease,
                transform 0.4s ease;

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
        .user-menu {
    position: relative;
    display: inline-block;
}

.avatar-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #4f46e5;
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.dropdown {
    display: none;
    position: absolute;
    right: 0;
    margin-top: 10px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 10px;
    min-width: 150px;
}

.dropdown a {
    display: block;
    padding: 8px;
    text-decoration: none;
    color: black;
}

.dropdown a:hover {
    background-color: #f3f4f6;
}
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background-color: #111;
    color: white;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 15px;
}


    </style>
</head>


<body class="<?= !empty($hideNavbar) ? 'bg-login' : '' ?>">

<?php if (empty($hideNavbar)) : ?>
<nav class="navbar">
    <div class="logo">
        <a href="/">Meu Logo</a>
    </div>

    <div class="nav-right">
        <?php if (isset($_SESSION['username'])): ?>
            <span class="welcome">
                Bem-vindo, <?= htmlspecialchars(userFormat($_SESSION['username'])) ?>
            </span>

            <div class="user-menu">
                <button class="avatar-btn" onclick="toggleMenu()">
                    <?= strtoupper(substr($_SESSION['username'], 0, 1)) ?>
                </button>

                <div class="dropdown" id="dropdownMenu">
                    <a href="/profile">Perfil</a>
                    <a href="/logout">Sair</a>
                </div>
            </div>
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
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

document.addEventListener("click", function(e) {
    const menu = document.getElementById("dropdownMenu");
    const button = document.querySelector(".avatar-btn");

    if (!button.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = "none";
    }
});
</script>

<script>
window.addEventListener("load", function() {

    const custom_toast = document.getElementById("custom_toast");
    if (!custom_toast) return;

    setTimeout(() => {
        custom_toast.classList.add("show");
    }, 100);

    setTimeout(() => {
        custom_toast.classList.remove("show");
        custom_toast.classList.add("hide");
    }, 5000);

});
</script>




</body>

</html>
