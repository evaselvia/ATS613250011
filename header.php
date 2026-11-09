<?php
require_once __DIR__ . '/fungsi.php';
periksaLogin();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Mobil</title>
    <link href="assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboard.php">
            Rental Mobil Eva Selvia
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menuNavigasi"
            aria-controls="menuNavigasi"
            aria-expanded="false"
            aria-label="Buka menu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuNavigasi">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="tambah.php">Tambah</a>
                </li>

                <li class="nav-item">
                    <span class="navbar-text small text-white-50">
                        <?= aman($_SESSION["nama"]) ?> (<?= aman($_SESSION["email"]) ?>)
                    </span>
                </li>

                <li class="nav-item">
                    <form action="logout.php" method="post" class="m-0">
                        <input
                            type="hidden"
                            name="csrf"
                            value="<?= aman($_SESSION["csrf"]) ?>"
                        >

                        <button
                            type="submit"
                            class="btn btn-outline-light btn-sm my-2 my-lg-0"
                        >
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <main class="container py-5">