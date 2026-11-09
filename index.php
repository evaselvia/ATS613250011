<?php
session_start();
// sesi di mulai

if (isset($_SESSION['id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = $_SESSION['login_error'] ?? '';

$email = $_SESSION['login_email'] ?? '';
unset($_SESSION['login_error'], $_SESSION['login_email']);

?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Rental Mobil</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
        <section class="card login-card border-0 shadow-sm w-100" aria-labelledby="login-title">
            <div class="card-body p-4 p-sm-5">
                <h1 id="login-title" class="h3 text-center mb-2">Login</h1>
                <p class="text-secondary text-center mb-4">Silakan masuk ke Rental Mobil.</p>

                <?php if ($error !== ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="validasi.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="Masukkan email" autocomplete="username" maxlength="34"
                               value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Masukkan password" autocomplete="current-password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="submit">Masuk</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>