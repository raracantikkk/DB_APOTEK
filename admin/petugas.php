<?php
include "../src/koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM petugas");
?>

<style>
    .tabel-petugas {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        margin-top: 20px;
        background: white;
    }

    .tabel-petugas th,
    .tabel-petugas td {
        border: 1px solid #333 !important;
        padding: 12px;
        text-align: left;
        overflow-wrap: break-word;
    }

    .tabel-petugas th {
        background-color: #198754;
        color: white;
    }

    .tabel-petugas tbody tr {
        height: 50px;
    }

    .btn-petugas {
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

<h2>Data Petugas</h2>

<a href="tambah_petugas.php" class="btn-tambah">
    + Tambah Petugas
</a>

<table class="tabel-petugas">
    <thead>
        <tr>
            <th>Username</th>
            <th>Nama Petugas</th>
            <th>Level</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (!$query) {
            echo "<tr><td colspan='4'>
                Gagal mengambil data petugas.
            </td></tr>";
        } elseif (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>";

                echo "<td>" .
                    htmlspecialchars($data['username']) .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($data['nama_petugas']) .
                    "</td>";

                echo "<td>" .
                    htmlspecialchars($data['level']) .
                    "</td>";

                echo "<td>
                    <a class='btn-petugas btn-edit'
                       href='edit_petugas.php?id=" .
                       (int)$data['id_petugas'] . "'>
                       Edit
                    </a>

                    <a class='btn-petugas btn-hapus'
                       href='hapus_petugas.php?id=" .
                       (int)$data['id_petugas'] . "'
                       onclick=\"return confirm('Yakin ingin menghapus petugas ini?')\">
                       Hapus
                    </a>
                </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr>
                <td colspan='4'>Belum ada data petugas.</td>
            </tr>";
        }
        ?>
    </tbody>
</table>