<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function periksaLogin() {
    if (!isset($_SESSION['id'])) {
        $_SESSION['login_error'] = 'Silakan login terlebih dahulu.';
        header('Location: index.php');
        exit;
    }
}

function aman($teks) {
    return htmlspecialchars(
        (string) $teks,
        ENT_QUOTES | ENT_SUBSTITUTE,
        "UTF-8"
    );
}

// Membuat token pelindung formulir
if (!isset($_SESSION["csrf"])) {
    $_SESSION["csrf"] = bin2hex(random_bytes(32));
}

function periksaToken() {
    $token = $_POST["csrf"] ?? "";

    if (
        !is_string($token) ||
        !hash_equals($_SESSION["csrf"], $token)
    ) {
        $_SESSION["pesan"] = [
            "tipe" => "danger",
            "teks" => "Formulir sudah tidak valid. Silakan buka kembali dan coba lagi."
        ];

        header("Location: index.php");
        exit;
    }
}

// Membaca input teks dari formulir
function inputTeks($namaKolom) {
    $nilai = $_POST[$namaKolom] ?? "";

    if (!is_string($nilai)) {
        exit("Format input tidak valid.");
    }

    return trim($nilai);
}

function validasiMobil($nomor, $jenis, $pemilik, $tahun) {
    if ($nomor === "") {
        return "Nomor kendaraan wajib diisi.";
    }

    if (mb_strlen($nomor, "UTF-8") > 12) {
        return "Nomor kendaraan maksimal 12 karakter.";
    }

    if (!in_array($jenis, ["Sedan", "Pickup", "Truk", "Bemo"], true)) {
        return "Jenis kendaraan tidak valid.";
    }

    if ($pemilik === "") {
        return "Pemilik wajib diisi.";
    }

    if (mb_strlen($pemilik, "UTF-8") > 50) {
        return "Pemilik maksimal 50 karakter.";
    }

    if (!preg_match('/^[0-9]{4}$/', $tahun)) {
        return "Tahun pembuatan harus 4 digit angka.";
    }

    return "";
}