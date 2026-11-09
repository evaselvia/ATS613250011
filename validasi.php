<?php
// Aktifkan session untuk menyimpan pesan kesalahan dan data pengguna yang login.
session_start();

// Ambil input hanya jika berupa string untuk menolak kiriman berbentuk array.
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!is_string($email) || !is_string($password)) {
    $_SESSION['login_error'] = "Format input tidak valid";
    header('Location: index.php');
    exit;
}

// Password di tabel varchar(32), jadi disimpan dalam bentuk md5
$password = md5($password);

include "koneksi.php";

// Mencocokkan email dan password, hanya akun aktif (aktive = 1)
$stmt = $koneksi->prepare(
    "SELECT id, email, nama
     FROM member_011
     WHERE email = ? AND password = ? AND aktive = '1'
     LIMIT 1"
);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
$koneksi->close();

if ($user) {
    session_regenerate_id(true);
    // Simpan id, email dan nama untuk pemeriksaan akses dan tampilan dashboard.
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['nama'] = $user['nama'];
    header('Location: dashboard.php');
    exit;
} else {
    $_SESSION['login_error'] = "Email atau password salah";
    $_SESSION['login_email'] = $email;
    header('Location: index.php');
    exit;
}