<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_pembeli = $_GET['id'];

    $query = "SELECT pembeli_mochi.*, transaksi_mochi.jenis_mochi, transaksi_mochi.harga, transaksi_mochi.tanggal
              FROM pembeli_mochi
              LEFT JOIN transaksi_mochi ON pembeli_mochi.pembeli_id = transaksi_mochi.id_pembeli
              WHERE pembeli_mochi.pembeli_id = '$id_pembeli'";

    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data not found.";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pembeli = $_POST['id_pembeli'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_mochi = $_POST['jenis_mochi'];
    $tanggal = $_POST['tanggal'];

    $sqlUpdatePembeli = "UPDATE pembeli_mochi SET nama='$nama', alamat='$alamat' WHERE pembeli_id='$id_pembeli'";

    if ($mysqli->query($sqlUpdatePembeli) === TRUE) {
        // Update transaksi_mochi table
        $harga = getHargaByJenisMochi($jenis_mochi);
        $sqlUpdateTransaksi = "UPDATE transaksi_mochi SET jenis_mochi='$jenis_mochi', harga='$harga', tanggal='$tanggal' WHERE id_pembeli='$id_pembeli'";

        if ($mysqli->query($sqlUpdateTransaksi) === TRUE) {
            header("Location: read.php");
            exit;
        } else {
            echo "Error updating transaksi: " . $mysqli->error;
        }
    } else {
        echo "Error updating pembeli: " . $mysqli->error;
    }
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
    <title>Edit Pembeli dan Transaksi Mochi</title>
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
    <h2>Edit Transaksi Mochi</h2>
    <form action="edit_delete_pembeli_transaksi.php" method="POST">
        <input type="hidden" name="id_pembeli" value="<?php echo $row['pembeli_id']; ?>">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>" required>

        <label for="jenis_mochi">Jenis Mochi:</label>
        <select name="jenis_mochi" required onchange="updateHarga()">
            <option value="coklat" <?php if ($row['jenis_mochi'] == 'coklat') echo 'selected'; ?>>Coklat</option>
            <option value="stroberi" <?php if ($row['jenis_mochi'] == 'stroberi') echo 'selected'; ?>>Stroberi</option>
            <option value="macha" <?php if ($row['jenis_mochi'] == 'macha') echo 'selected'; ?>>Macha</option>
        </select>

        <label for="tanggal">Tanggal Transaksi:</label>
        <input type="date" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>

        <div id="harga-container">Harga: Rp <?php echo $row['harga']; ?></div>

        <input type="submit" value="Update">
    </form>

    <script>
        function updateHarga() {
            var jenisMochi = document.querySelector('select[name="jenis_mochi"]').value;
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
