<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_pembeli = $_GET['id'];

    $sqlDeleteTransaksi = "DELETE FROM transaksi_mochi WHERE id_pembeli='$id_pembeli'";

    if ($mysqli->query($sqlDeleteTransaksi) === TRUE) {
        $sqlDeletePembeli = "DELETE FROM pembeli_mochi WHERE pembeli_id='$id_pembeli'";

        if ($mysqli->query($sqlDeletePembeli) === TRUE) {
            header("Location: read.php");
            exit;
        } else {
            echo "Error deleting pembeli: " . $mysqli->error;
        }
    } else {
        echo "Error deleting transaksi: " . $mysqli->error;
    }
}
?>
