<?php
include "src/koneksi.php";

$hasil = null;
$nama = "";

if (isset($_GET['nama'])) {
    $nama = trim($_GET['nama']);

    if ($nama !== "") {
        $query = mysqli_prepare(
            $koneksi,
            "SELECT nama_obat, harga, stok
             FROM obat
             WHERE nama_obat LIKE ?"
        );

        $cari = "%" . $nama . "%";
        mysqli_stmt_bind_param($query, "s", $cari);
        mysqli_stmt_execute($query);
        $hasil = mysqli_stmt_get_result($query);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Obat</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eaf7f0;
            margin: 0;
            padding: 25px;
        }

        .kotak {
            max-width: 800px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
        }

        h2 {
            color: #198754;
            text-align: center;
        }

        input {
            width: 70%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 15px;
            background: #198754;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #999;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #198754;
            color: white;
        }

        .kembali {
            display: inline-block;
            margin-top: 20px;
            color: #198754;
        }
    </style>
</head>

<body>
<div class="kotak">

    <h2>CEK OBAT</h2>

    <form method="GET" action="cek_obat.php">
        <label>Masukkan Nama Obat</label><br><br>

        <input
            type="text"
            name="nama"
            value="<?= htmlspecialchars($nama) ?>"
            required
        >

        <button type="submit">Cari Obat</button>
    </form>

    <?php if ($hasil !== null): ?>

        <?php if (mysqli_num_rows($hasil) > 0): ?>

            <table>
                <tr>
                    <th>Nama Obat</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>

                <?php while ($obat = mysqli_fetch_assoc($hasil)): ?>
                    <tr>
                        <td><?= htmlspecialchars($obat['nama_obat']) ?></td>
                        <td>Rp <?= number_format((float)$obat['harga'], 0, ',', '.') ?></td>
                        <td><?= (int)$obat['stok'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

        <?php else: ?>
            <p>Obat tidak ditemukan. Periksa nama obat di database.</p>
        <?php endif; ?>

    <?php endif; ?>

    <a class="kembali" href="index.php">Kembali ke Login</a>

</div>
</body>
</html>