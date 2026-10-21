<?php
include "../src/koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    die("ID obat tidak valid.");
}

$query = mysqli_query(
    $koneksi,
    "DELETE FROM obat WHERE id_obat = $id"
);

if ($query && mysqli_affected_rows($koneksi) > 0) {
    header("Location: halaman_admin.php?open=data_obat");
    exit;
}

if (!$query) {
    echo "Gagal menghapus obat. Data mungkin masih digunakan "
       . "oleh transaksi lain.<br>";
    echo htmlspecialchars(mysqli_error($koneksi));
} else {
    echo "Data obat tidak ditemukan.";
}

echo '<br><a href="halaman_admin.php?open=data_obat">Kembali</a>';
?>