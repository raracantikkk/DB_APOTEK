<?php
$open = $_GET['open'] ?? 'informasi_utama';

switch ($open) {
    case 'data_obat':
        include "obat.php";
        break;

    case 'data_petugas':
        include "petugas.php";
        break;
 
    case 'data_penjualan':
    include "penjualan.php";
    break;

    case 'data_pelanggan':
        include "pelanggan.php";
        break;

    case 'data_supplier':
        include "data_supplier.php";
        break;

    default:
        include "informasi_utama.php";
        break;
}
?>