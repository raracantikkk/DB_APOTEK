<?php
include "../src/koneksi.php";

if (!isset($_GET['id_petugas'])) {
    die("ID petugas tidak ditemukan!");
}

$id = (int) $_GET['id_petugas'];

$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM petugas WHERE id_petugas = ?"
);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus petugas. Data mungkin masih digunakan transaksi.";
}
?>