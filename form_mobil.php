<?php
require "header.php";
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="mb-4">
            <h1 class="h3 fw-bold mb-1"><?= aman($judul) ?></h1>
            <p class="text-secondary mb-0">
                Lengkapi informasi kendaraan di bawah ini.
            </p>
        </div>

        <section class="card border-0">
            <div class="card-body p-4">
                <?php if ($error !== ""): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= aman($error) ?>
                    </div>
                <?php endif; ?>

                <form action="<?= aman($aksi) ?>" method="post">
                    <input
                        type="hidden"
                        name="csrf"
                        value="<?= aman($_SESSION["csrf"]) ?>"
                    >

                    <div class="mb-3">
                        <label for="nomor_kendaraan" class="form-label">
                            Nomor Kendaraan
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="nomor_kendaraan"
                            name="nomor_kendaraan"
                            maxlength="12"
                            value="<?= aman($nomor) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kendaraan" class="form-label">
                            Jenis Kendaraan
                        </label>
                        <select
                            class="form-select"
                            id="jenis_kendaraan"
                            name="jenis_kendaraan"
                            required
                        >
                            <?php foreach (["Sedan", "Pickup", "Truk", "Bemo"] as $pilihan): ?>
                                <option
                                    value="<?= aman($pilihan) ?>"
                                    <?= $jenis === $pilihan ? "selected" : "" ?>
                                >
                                    <?= aman($pilihan) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pemilik" class="form-label">Pemilik</label>
                        <input
                            type="text"
                            class="form-control"
                            id="pemilik"
                            name="pemilik"
                            maxlength="50"
                            value="<?= aman($pemilik) ?>"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label for="tahun_pembuatan" class="form-label">
                            Tahun Pembuatan
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="tahun_pembuatan"
                            name="tahun_pembuatan"
                            inputmode="numeric"
                            pattern="[0-9]{4}"
                            maxlength="4"
                            value="<?= aman($tahun) ?>"
                            required
                        >
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            Simpan
                        </button>
                        <a href="dashboard.php" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>

<?php require "footer.php"; ?>
