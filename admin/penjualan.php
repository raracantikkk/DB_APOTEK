<?php
include "../src/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM penjualan");
?>

<style>
    .tabel-penjualan {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 20px;
        background: white;
    }

    .tabel-penjualan th,
    .tabel-penjualan td {
        border: 1px solid #333 !important;
        padding: 12px;
        text-align: left;
        overflow-wrap: break-word;
    }

    .tabel-penjualan th {
        background-color: #198754;
        color: white;
    }

    .tabel-penjualan tbody tr {
        height: 50px;
    }

    .btn-penjualan {
        display: inline-block;
        padding: 6px 10px;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin: 2px;
    }

    .btn-tambah {
        display: inline-block;
        padding: 8px 12px;
        background: #198754;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }

    .btn-edit {
        background: #0d6efd;
    }

    .btn-hapus {
        background: #dc3545;
    }
</style>

<h2>Data Penjualan</h2>

<a href="tambah_penjualan.php" class="btn-tambah">
    + Tambah Penjualan
</a>

<table class="tabel-penjualan">
    <thead>
        <tr>
            <th>ID Penjualan</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (!$query) {
            echo "<tr><td colspan='4'>Gagal mengambil data: " .
                htmlspecialchars(mysqli_error($koneksi)) .
                "</td></tr>";
        } elseif (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
                $id = (int)$data['id_penjualan'];

                echo "<tr>";

                echo "<td>" . $id . "</td>";

                echo "<td>" .
                    htmlspecialchars($data['tanggal_penjualan']) .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($data['total']) .
                    "</td>";

                echo "<td>
                    <a class='btn-penjualan btn-edit'
                       href='edit_penjualan.php?id=$id'>
                       Edit
                    </a>

                    <a class='btn-penjualan btn-hapus'
                       href='hapus_penjualan.php?id=$id'
                       onclick=\"return confirm('Yakin ingin menghapus penjualan ini?')\">
                       Hapus
                    </a>
                </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr>
                <td colspan='4'>Belum ada data penjualan.</td>
            </tr>";
        }
        ?>
    </tbody>
</table>