<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

$id = filter_var(
    $_GET["id"] ?? null,
    FILTER_VALIDATE_INT,
    ["options" => ["min_range" => 1]]
);

if ($id === false || $id === null) {
    $_SESSION["pesan"] = [
        "tipe" => "danger",
        "teks" => "ID mobil tidak valid."
    ];

    header("Location: index.php");
    exit;
}

try {
    $stmt = $koneksi->prepare(
        "SELECT nomor_kendaraan, jenis_kendaraan, pemilik, tahun_pembuatan
         FROM mobil011
         WHERE no_id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $data = $stmt->get_result()->fetch_assoc();
} catch (mysqli_sql_exception $kesalahan) {
    error_log($kesalahan->getMessage());

    $_SESSION["pesan"] = [
        "tipe" => "danger",
        "teks" => "Data mobil belum dapat dimuat."
    ];

    header("Location: index.php");
    exit;
}

if (!$data) {
    $_SESSION["pesan"] = [
        "tipe" => "danger",
        "teks" => "Mobil yang dipilih tidak ditemukan."
    ];

    header("Location: index.php");
    exit;
}

$judul = "Edit Mobil";
$aksi = "edit.php?id=" . $id;

$nomor = $data["nomor_kendaraan"];
$jenis = $data["jenis_kendaraan"];
$pemilik = $data["pemilik"];
$tahun = $data["tahun_pembuatan"];
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    periksaToken();

    $nomor = strtoupper(inputTeks("nomor_kendaraan"));
    $jenis = inputTeks("jenis_kendaraan");
    $pemilik = inputTeks("pemilik");
    $tahun = inputTeks("tahun_pembuatan");

    $error = validasiMobil($nomor, $jenis, $pemilik, $tahun);

    if ($error === "") {
        try {
            $stmt = $koneksi->prepare(
                "UPDATE mobil011
                 SET nomor_kendaraan = ?, jenis_kendaraan = ?,
                     pemilik = ?, tahun_pembuatan = ?
                 WHERE no_id = ?"
            );

            $stmt->bind_param(
                "ssssi",
                $nomor,
                $jenis,
                $pemilik,
                $tahun,
                $id
            );

            $stmt->execute();

            $_SESSION["pesan"] = [
                "tipe" => "success",
                "teks" => "Data mobil berhasil disimpan."
            ];

            header("Location: index.php");
            exit;
        } catch (mysqli_sql_exception $kesalahan) {
            error_log($kesalahan->getMessage());
            $error = "Perubahan gagal disimpan. Silakan coba kembali.";
        }
    }
}

require "form_mobil.php";