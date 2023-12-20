<?php
include 'koneksi.php';

$query = "SELECT pembeli_mochi.*, transaksi_mochi.jenis_mochi, transaksi_mochi.harga, transaksi_mochi.tanggal
          FROM pembeli_mochi
          LEFT JOIN transaksi_mochi ON pembeli_mochi.pembeli_id = transaksi_mochi.id_pembeli";

$result = $mysqli->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mochi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e1d3bb;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color: #69bf64; 
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid #a09383;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #69bf64; 
            color: #fff;
        }

        a {
            color: #69bf64; 
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        #create-button {
            background-color: #69bf64; 
            color: #fff;
            padding: 10px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }

        #create-button:hover {
            background-color: #4f8d47; 
        }
    </style>
</head>

<body>
    <header>
        <h1 style="margin: 0;">MochiMoy</h1>
    </header>
    <table>
        <tr>
            <th>ID Pesanan</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Mochi</th>
            <th>Harga</th>
            <th>Tanggal Transaksi</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["pembeli_id"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["alamat"] . "</td>";
                echo "<td>" . $row["jenis_mochi"] . "</td>";
                echo "<td>" . formatCurrency($row["harga"]) . "</td>";
                echo "<td>" . $row["tanggal"] . "</td>";
                echo "<td>
                          <a href='edit_delete_pembeli_transaksi.php?id=" . $row["pembeli_id"] . "'>Edit</a> | 
                          <a href='delete_pembeli_transaksi.php?id=" . $row["pembeli_id"] . "'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data transaksi.</td></tr>";
        }

        function formatCurrency($amount)
        {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }
        ?>
    </table>

    <a id="create-button" href="create_pembeli_transaksi.php">Buat Pesanan Mochi</a>
</body>

</html>

<?php
$mysqli->close();
?>
