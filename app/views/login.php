<?php 
$hideNavbar = true;
ob_start(); 
?>

<div class="d-flex flex-column align-items-center justify-content-center min-vh-100">

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-danger alert-dismissible fade show text-center mb-4" style="width: 400px;" role="alert">
            <?= htmlspecialchars($_SESSION['flash']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

        <div class="card login-card p-4 bg-white ">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            <form method="POST" action="?url=login">
                
                <div class="mb-3">
                    <label class="form-label">Email ou Username</label>
                    <input type="text" name="email_user" class="form-control" placeholder="Digite seu email ou username" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Entrar
                </button>
                <div class="d-flex justify-content-center gap-4 mt-3 login-links">
                    <a href="/forgot">Esqueceu a senha?</a>
                    <a href="/register">Cadastre-se</a>
                    
                </div>
            </form>
        </div>
    </div>
</div>




<?php
$content = ob_get_clean();
require __DIR__ . "/layout.php";
?>
