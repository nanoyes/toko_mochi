<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $sqlPembeli = "INSERT INTO pembeli_mochi (nama, alamat) VALUES ('$nama', '$alamat')";

    if ($mysqli->query($sqlPembeli) === TRUE) {
        $id_pembeli = $mysqli->insert_id;

        $jenis_mochi = $_POST['jenis_mochi'];
        $harga = getHargaByJenisMochi($jenis_mochi);
        $tanggal = $_POST['tanggal'];

        $sqlTransaksi = "INSERT INTO transaksi_mochi (id_pembeli, jenis_mochi, harga, tanggal) VALUES ('$id_pembeli', '$jenis_mochi', '$harga', '$tanggal')";

        if ($mysqli->query($sqlTransaksi) === TRUE) {
            header("Location: read.php");
            exit;
        } else {
            echo "Error: " . $sqlTransaksi . "<br>" . $mysqli->error;
        }
    } else {
        echo "Error: " . $sqlPembeli . "<br>" . $mysqli->error;
    }

    $mysqli->close();
}

function getHargaByJenisMochi($jenis_mochi)
{
    switch ($jenis_mochi) {
        case 'coklat':
            return 15000;
        case 'stroberi':
            return 17000;
        case 'macha':
            return 20000;
        default:
            return 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan dan Beli Mochi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e1d3bb;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #69bf64;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #69bf64;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #69bf64;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #69bf64;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4f8d47;
        }

        #harga-container {
            margin-top: 10px;
            font-weight: bold;
            color: #69bf64;
        }
    </style>
</head>

<body>
    <h2>Pesan Mochi</h2>
    <form action="create_pembeli_transaksi.php" method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" required>

        <label for="jenis_mochi">Jenis Mochi:</label>
        <select name="jenis_mochi" id="jenis_mochi" required onchange="updateHarga()">
            <option value="coklat">Coklat</option>
            <option value="stroberi">Stroberi</option>
            <option value="macha">Macha</option>
        </select>

        <label for="tanggal">Tanggal Transaksi:</label>
        <input type="date" name="tanggal" required>

        <div id="harga-container">Harga: Rp 15,000</div>

        <input type="submit" value="Pesan dan Beli">
    </form>

    <script>
        function updateHarga() {
            var jenisMochi = document.getElementById('jenis_mochi').value;
            var hargaContainer = document.getElementById('harga-container');
            var harga = 0;

            switch (jenisMochi) {
                case 'Chocolate':
                    harga = 15000;
                    break;
                case 'Strawberry':
                    harga = 17000;
                    break;
                case 'Matcha':
                    harga = 20000;
                    break;
            }

            hargaContainer.innerText = 'Harga: Rp ' + harga.toLocaleString();
        }
    </script>
</body>

</html>
