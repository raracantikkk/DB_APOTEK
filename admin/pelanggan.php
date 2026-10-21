<?php
include "../src/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM pelanggan");
?>

<style>
    .tabel-pelanggan {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 20px;
        background: white;
    }

    .tabel-pelanggan th,
    .tabel-pelanggan td {
        border: 1px solid #333 !important;
        padding: 12px;
        text-align: left;
        overflow-wrap: break-word;
    }

    .tabel-pelanggan th {
        background-color: #198754;
        color: white;
    }

    .tabel-pelanggan tbody tr {
        height: 50px;
    }

    .btn-pelanggan {
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

<h2>Data Pelanggan</h2>

<a href="tambah_pelanggan.php" class="btn-tambah">
    + Tambah Pelanggan
</a>

<table class="tabel-pelanggan">
    <thead>
        <tr>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No. Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (!$query) {
            echo "<tr><td colspan='5'>
                Gagal mengambil data pelanggan.
            </td></tr>";
        } elseif (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>";

                echo "<td>" .
                    (int)$data['id_pelanggan'] .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($data['nama_pelanggan']) .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($data['alamat']) .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($data['no_telepon']) .
                    "</td>";

                echo "<td>
                    <a class='btn-pelanggan btn-edit'
                       href='edit_pelanggan.php?id=" .
                       (int)$data['id_pelanggan'] . "'>
                       Edit
                    </a>

                    <a class='btn-pelanggan btn-hapus'
                       href='hapus_pelanggan.php?id=" .
                       (int)$data['id_pelanggan'] . "'
                       onclick=\"return confirm('Yakin ingin menghapus pelanggan ini?')\">
                       Hapus
                    </a>
                </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr>
                <td colspan='5'>Belum ada data pelanggan.</td>
            </tr>";
        }
        ?>
    </tbody>
</table>