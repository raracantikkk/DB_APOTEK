<?php
include "../src/koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

$query = mysqli_query($koneksi,
    "SELECT * FROM obat WHERE id_obat = $id"
);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data obat tidak ditemukan.");
}

if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string(
        $koneksi, $_POST['nama_obat']
    );
    $stok = (int) $_POST['stok'];
    $harga = (float) $_POST['harga'];
    $tanggal = $_POST['tanggal_kadaluarsa'];

    $update = mysqli_query($koneksi, "
        UPDATE obat SET
            nama_obat = '$nama',
            stok = $stok,
            harga = $harga,
            tanggal_kadaluarsa = '$tanggal'
        WHERE id_obat = $id
    ");

    if ($update) {
        header("Location: halaman_admin.php?open=data_obat");
        exit;
    } else {
        echo "Gagal mengubah data: " .
             mysqli_error($koneksi);
    }
}
?>

<h2>Edit Obat</h2>

<form method="POST">
    Nama Obat<br>
    <input type="text" name="nama_obat"
        value="<?= htmlspecialchars($data['nama_obat']) ?>"
        required>
    <br><br>

    Stok<br>
    <input type="number" name="stok"
        value="<?= (int)$data['stok'] ?>"
        min="0" required>
    <br><br>

    Harga<br>
    <input type="number" name="harga"
        value="<?= htmlspecialchars($data['harga']) ?>"
        min="0" step="0.01" required>
    <br><br>

    Tanggal Kedaluwarsa<br>
    <input type="date" name="tanggal_kadaluarsa"
        value="<?= htmlspecialchars($data['tanggal_kadaluarsa']) ?>"
        required>
    <br><br>

    <button type="submit" name="simpan">Simpan Perubahan</button>
    <a href="halaman_admin.php?open=data_obat">Kembali</a>
</form>