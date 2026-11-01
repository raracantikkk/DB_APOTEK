<?php
include "../src/koneksi.php";

// Ambil ID penjualan
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("ID penjualan tidak ditemukan.");
}

// Pastikan data penjualan tersedia
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id_penjualan FROM penjualan WHERE id_penjualan = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);

if (!$hasil || mysqli_num_rows($hasil) == 0) {
    die("Data penjualan tidak ditemukan.");
}

// Hapus data penjualan
$hapus = mysqli_prepare(
    $koneksi,
    "DELETE FROM penjualan WHERE id_penjualan = ?"
);

mysqli_stmt_bind_param($hapus, "i", $id);

if (mysqli_stmt_execute($hapus)) {
    header("Location: halaman_admin.php?open=data_penjualan");
    exit;
} else {
    echo "Gagal menghapus data penjualan. Data mungkin masih terhubung dengan detail penjualan.";
}
?>