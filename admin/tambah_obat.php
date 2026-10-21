<?php
include "../src/koneksi.php";

// Ambil data kategori dan supplier
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$supplier = mysqli_query($koneksi, "SELECT * FROM supplier");

if (isset($_POST['simpan'])) {
    $nama_obat = mysqli_real_escape_string(
        $koneksi, $_POST['nama_obat']
    );
    $stok = (int) $_POST['stok'];
    $harga = (float) $_POST['harga'];
    $tanggal = $_POST['tanggal_kadaluarsa'];
    $id_kategori = (int) $_POST['id_kategori'];
    $id_supplier = (int) $_POST['id_supplier'];

    $query = mysqli_query($koneksi, "INSERT INTO obat
        (nama_obat, stok, harga, tanggal_kadaluarsa,
         id_kategori, id_supplier)
        VALUES
        ('$nama_obat', $stok, $harga, '$tanggal',
         $id_kategori, $id_supplier)");

    if ($query) {
        header("Location: halaman_admin.php?open=data_obat");
        exit;
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>

<h2>Tambah Obat</h2>

<form method="POST">
    <label>Nama Obat</label><br>
    <input type="text" name="nama_obat" required>
    <br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" min="0" required>
    <br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" min="0" step="0.01" required>
    <br><br>

    <label>Tanggal Kedaluwarsa</label><br>
    <input type="date" name="tanggal_kadaluarsa" required>
    <br><br>

    <label>Kategori</label><br>
    <select name="id_kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <?php while ($k = mysqli_fetch_assoc($kategori)) { ?>
            <option value="<?= $k['id_kategori'] ?>">
                <?= htmlspecialchars($k['nama_kategori']) ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Supplier</label><br>
    <select name="id_supplier" required>
        <option value="">-- Pilih Supplier --</option>
        <?php while ($s = mysqli_fetch_assoc($supplier)) { ?>
            <option value="<?= $s['id_supplier'] ?>">
                <?= htmlspecialchars($s['nama_supplier']) ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <button type="submit" name="simpan">Simpan</button>
    <a href="halaman_admin.php?open=data_obat">Kembali</a>
</form>