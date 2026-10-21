<?php
include "../src/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM supplier");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Supplier</title>
</head>
<body>

<h2>Data Supplier</h2>

<a href="tambah.php">+ Tambah Supplier</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama Supplier</th>
        <th>No. Telepon</th>
    </tr>

    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($query)) {
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama_supplier']) ?></td>
        <td><?= htmlspecialchars($row['no_telepon']) ?></td>
    </tr>
    <?php } ?>

</table>

</body>
</html>