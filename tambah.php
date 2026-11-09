<?php
require "fungsi.php";
periksaLogin();
require "koneksi.php";

$judul = "Tambah Mobil";
$aksi = "tambah.php";

$nomor = "";
$jenis = "Sedan";
$pemilik = "";
$tahun = "";
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
                "INSERT INTO mobil011
                    (nomor_kendaraan, jenis_kendaraan, pemilik, tahun_pembuatan)
                 VALUES (?, ?, ?, ?)"
            );

            $stmt->bind_param("ssss", $nomor, $jenis, $pemilik, $tahun);
            $stmt->execute();

            $_SESSION["pesan"] = [
                "tipe" => "success",
                "teks" => "Data mobil berhasil ditambahkan."
            ];

            header("Location: index.php");
            exit;
        } catch (mysqli_sql_exception $kesalahan) {
            error_log($kesalahan->getMessage());
            $error = "Penyimpanan gagal. Silakan coba kembali.";
        }
    }
}

require "form_mobil.php";