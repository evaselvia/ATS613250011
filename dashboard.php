<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

$judul = "Daftar Mobil";
$pesan = $_SESSION["pesan"] ?? null;

// Pesan ditampilkan satu kali
unset($_SESSION["pesan"]);

$errorDatabase = "";
$hasil = null;

try {
    $hasil = $koneksi->query(
        "SELECT *
         FROM mobil011
         ORDER BY no_id DESC"
    );
} catch (mysqli_sql_exception $error) {
    error_log($error->getMessage());
    $errorDatabase = "Data mobil belum dapat dimuat. Silakan coba kembali.";
}

require "header.php";
?>

<div class="d-flex flex-wrap justify-content-between
            align-items-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Daftar Mobil</h1>
        <p class="text-secondary mb-0">
            Kelola data kendaraan rental.
        </p>
    </div>

    <a href="tambah.php" class="btn btn-primary px-4">
        + Tambah Mobil
    </a>
</div>

<?php if ($pesan): ?>
    <?php
    $warna = $pesan["tipe"] === "success" ? "success" : "danger";
    ?>
    <div
        class="alert alert-<?= $warna ?> alert-dismissible fade show"
        role="alert"
    >
        <?= aman($pesan["teks"]) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Tutup"
        ></button>
    </div>
<?php endif; ?>

<?php if ($errorDatabase !== ""): ?>
    <div class="alert alert-danger" role="alert">
        <?= aman($errorDatabase) ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h6 fw-bold mb-0">Data Mobil</h2>

            <?php if ($hasil !== null): ?>
                <span class="badge text-bg-primary">
                    <?= $hasil->num_rows ?> mobil
                </span>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nomor Kendaraan</th>
                        <th>Jenis Kendaraan</th>
                        <th>Pemilik</th>
                        <th>Tahun Pembuatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $nomor = 1; ?>

                    <?php if ($hasil !== null): ?>
                        <?php while ($data = $hasil->fetch_assoc()): ?>
                            <tr>
                                <td><?= $nomor++ ?></td>

                                <td class="fw-semibold">
                                    <?= aman($data["nomor_kendaraan"]) ?>
                                </td>

                                <td>
                                    <span class="badge text-bg-primary">
                                        <?= aman($data["jenis_kendaraan"]) ?>
                                    </span>
                                </td>

                                <td><?= aman($data["pemilik"]) ?></td>

                                <td><?= aman($data["tahun_pembuatan"]) ?></td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a
                                            href="edit.php?id=<?= aman($data["no_id"]) ?>"
                                            class="btn btn-outline-primary btn-sm"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="hapus.php"
                                            method="post"
                                            class="m-0"
                                            onsubmit="return confirm('Hapus data mobil ini?');"
                                        >
                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= aman($data["no_id"]) ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="csrf"
                                                value="<?= aman($_SESSION["csrf"]) ?>"
                                            >

                                            <button
                                                type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                        <?php if ($hasil->num_rows === 0): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-secondary">
                                    Belum ada data mobil. Klik Tambah Mobil untuk memulai.
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>