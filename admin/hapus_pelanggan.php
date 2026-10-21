<?php
include "../src/koneksi.php";

$id = (int)($_GET['id_pelanggan'] ?? 0);

if ($id <= 0) {
    die("ID pelanggan tidak valid!");
}

$stmt = mysqli_prepare(
    $koneksi,
    "DELETE FROM pelanggan WHERE id_pelanggan = ?"
);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
}

if (mysqli_errno($koneksi) == 1451) {
    echo "Pelanggan tidak bisa dihapus karena masih memiliki transaksi penjualan.";
} else {
    echo "Gagal menghapus pelanggan.";
}
?>
```

## 3. Penjualan — `edit.php`

File ini mengubah pelanggan, tanggal, dan total harga transaksi. Pastikan struktur tabel `penjualan` sesuai dengan asumsi kita.

<CodeBlock language="php" editable>
<?php
include "../src/koneksi.php";

$id = (int)($_GET['id_penjualan'] ?? 0);

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM penjualan WHERE id_penjualan = $id"
);
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data penjualan tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $pelanggan = (int)$_POST['id_pelanggan'];
    $tanggal = mysqli_real_escape_string(
        $koneksi, $_POST['tanggal_penjualan']
    );
    $total = (float)$_POST['total_harga'];

    $cek = mysqli_query(
        $koneksi,
        "SELECT id_pelanggan FROM pelanggan
         WHERE id_pelanggan = $pelanggan"
    );

    if (mysqli_num_rows($cek) == 0) {
        die("Pelanggan tidak ditemukan!");
    }

    $sql = "UPDATE penjualan SET
            id_pelanggan = $pelanggan,
            tanggal_penjualan = '$tanggal',
            total_harga = $total
            WHERE id_penjualan = $id";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
        exit;
    }

    echo "Gagal mengedit penjualan.";
}

$pelanggan = mysqli_query(
    $koneksi,
    "SELECT * FROM pelanggan ORDER BY nama_pelanggan"
);
?>

<h2>Edit Penjualan</h2>

<form method="POST">
    Pelanggan<br>
    <select name="id_pelanggan" required>
        <?php while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
            <option value="<?= $p['id_pelanggan'] ?>"
                <?= $p['id_pelanggan'] == $data['id_pelanggan'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($p['nama_pelanggan']) ?>
            </option>
        <?php } ?>
    </select><br><br>

    Tanggal Penjualan<br>
    <input type="date" name="tanggal_penjualan"
        value="<?= htmlspecialchars($data['tanggal_penjualan']) ?>"
        required><br><br>

    Total Harga<br>
    <input type="number" name="total_harga"
        min="0" step="0.01"
        value="<?= htmlspecialchars($data['total_harga']) ?>"
        required><br><br>

    <button type="submit" name="update">Simpan Perubahan</button>
    <a href="index.php">Kembali</a>
</form>