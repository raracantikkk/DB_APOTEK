<?php
include "../src/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM obat");
?>

<style>
    .tabel-obat {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 20px;
        background: white;
    }

    .tabel-obat th,
    .tabel-obat td {
        border: 1px solid #333 !important;
        padding: 12px;
        text-align: left;
        overflow-wrap: break-word;
    }

    .tabel-obat th {
        background-color: #198754;
        color: white;
    }

    .tabel-obat tbody tr {
        height: 50px;
    }

    .btn-obat {
        display: inline-block;
        padding: 6px 10px;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin: 2px;
    }

    .btn-edit {
        background: #0d6efd;
    }

    .btn-hapus {
        background: #dc3545;
    }

    .btn-tambah {
        display: inline-block;
        padding: 8px 12px;
        background: #198754;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }
</style>

<h2>Data Obat</h2>

<a href="tambah_obat.php" class="btn-tambah">
    + Tambah Obat
</a>

<table class="tabel-obat">
    <thead>
        <tr>
            <th>Nama Obat</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Tanggal Kadaluarsa</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (!$query) {
            echo "<tr><td colspan='5'>Gagal mengambil data obat.</td></tr>";
        } elseif (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>";

                echo "<td>" .
                    htmlspecialchars($data['nama_obat']) .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($data['stok']) .
                    "</td>";

                echo "<td>Rp " .
                    number_format((float)$data['harga'], 0, ',', '.') .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($data['tanggal_kadaluarsa']) .
                    "</td>";

                echo "<td>
                    <a class='btn-obat btn-edit'
                       href='edit_obat.php?id=" .
                       (int)$data['id_obat'] . "'>Edit</a>

                    <a class='btn-obat btn-hapus'
                       href='hapus_obat.php?id=" .
                       (int)$data['id_obat'] . "'
                       onclick=\"return confirm('Yakin ingin menghapus obat ini?')\">
                       Hapus
                    </a>
                </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>Belum ada data obat.</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>