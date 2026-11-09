<?php
session_start();

$_SESSION = [];
// Ganti ID session dan hapus session lama agar pesan logout tetap bisa disimpan.
session_regenerate_id(true);

$_SESSION['login_error'] = "Logout sukses";

header('Location: index.php');
exit;