<?php
include "../src/koneksi.php";

if (!isset($_GET['id_petugas'])) {
    die("ID petugas tidak ditemukan!");
}

$id = (int) $_GET['id_petugas'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM petugas WHERE id_petugas = $id"
);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data petugas tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string(
        $koneksi, $_POST['nama_petugas']
    );
    $username = mysqli_real_escape_string(
        $koneksi, $_POST['username']
    );

    $sql = "UPDATE petugas SET
            nama_petugas = '$nama',
            username = '$username'
            WHERE id_petugas = $id";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengedit data petugas.";
    }
}
?>

<h2>Edit Petugas</h2>

<form method="POST">
    <label>Nama Petugas</label><br>
    <input type="text" name="nama_petugas"
        value="<?= htmlspecialchars($data['nama_petugas']) ?>"
        required><br><br>

    <label>Username</label><br>
    <input type="text" name="username"
        value="<?= htmlspecialchars($data['username']) ?>"
        required><br><br>

    <button type="submit" name="update">Simpan Perubahan</button>
    <a href="index.php">Kembali</a>
</form>