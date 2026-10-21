<?php
include "../src/koneksi.php";

$id = (int)($_GET['id_pelanggan'] ?? 0);

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM pelanggan WHERE id_pelanggan = $id"
);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data pelanggan tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string(
        $koneksi, $_POST['nama_pelanggan']
    );
    $alamat = mysqli_real_escape_string(
        $koneksi, $_POST['alamat']
    );
    $telepon = mysqli_real_escape_string(
        $koneksi, $_POST['no_telepon']
    );

    $sql = "UPDATE pelanggan SET
            nama_pelanggan = '$nama',
            alamat = '$alamat',
            no_telepon = '$telepon'
            WHERE id_pelanggan = $id";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
        exit;
    }

    echo "Gagal mengedit pelanggan.";
}
?>

<h2>Edit Pelanggan</h2>

<form method="POST">
    Nama Pelanggan<br>
    <input type="text" name="nama_pelanggan"
        value="<?= htmlspecialchars($data['nama_pelanggan']) ?>"
        required><br><br>

    Alamat<br>
    <textarea name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea><br><br>

    No. Telepon<br>
    <input type="text" name="no_telepon"
        value="<?= htmlspecialchars($data['no_telepon']) ?>"
        required><br><br>

    <button type="submit" name="update">Simpan Perubahan</button>
    <a href="index.php">Kembali</a>
</form>