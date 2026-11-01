<?php
include "../src/koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("ID penjualan tidak ditemukan.");
}

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id_penjualan, tanggal_penjualan, total
     FROM penjualan
     WHERE id_penjualan = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$hasil = mysqli_stmt_get_result($stmt);

if (!$hasil || mysqli_num_rows($hasil) == 0) {
    die("Data penjualan tidak ditemukan.");
}

$data = mysqli_fetch_assoc($hasil);
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST["tanggal_penjualan"] ?? "";
    $total = (int) ($_POST["total"] ?? 0);

    if ($tanggal == "" || $total < 0) {
        $pesan = "Periksa kembali data yang diisi.";
    } else {
        $update = mysqli_prepare(
            $koneksi,
            "UPDATE penjualan
             SET tanggal_penjualan = ?, total = ?
             WHERE id_penjualan = ?"
        );

        mysqli_stmt_bind_param(
            $update,
            "sii",
            $tanggal,
            $total,
            $id
        );

        if (mysqli_stmt_execute($update)) {
            mysqli_stmt_close($update);
            header("Location: halaman_admin.php?open=data_penjualan");
            exit;
        } else {
            $pesan = "Gagal mengubah data: "
                   . mysqli_stmt_error($update);
        }

        mysqli_stmt_close($update);
    }
}
?>

<h2>Edit Data Penjualan</h2>

<?php if ($pesan != ""): ?>
    <p style="color:red;">
        <?= htmlspecialchars($pesan) ?>
    </p>
<?php endif; ?>

<form method="POST" action="edit_penjualan.php?id=<?= $id ?>">

    <label>ID Penjualan</label><br>
    <input type="text" value="<?= $id ?>" readonly>
    <br><br>

    <label>Tanggal Penjualan</label><br>
    <input
        type="date"
        name="tanggal_penjualan"
        value="<?= htmlspecialchars($data["tanggal_penjualan"]) ?>"
        required
    >
    <br><br>

    <label>Total Harga</label><br>
    <input
        type="number"
        name="total"
        value="<?= htmlspecialchars((string)$data["total"]) ?>"
        min="0"
        step="1"
        required
    >
    <br><br>

    <button type="submit">Simpan Perubahan</button>
    <a href="halaman_admin.php?open=data_penjualan">Batal</a>

</form>