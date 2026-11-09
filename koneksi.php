<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "ATS613250011";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$koneksi = new mysqli($host, $user, $pass, $database);
$koneksi->set_charset('utf8mb4');