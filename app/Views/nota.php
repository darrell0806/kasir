<!-- app/Views/penjualan/print_nota.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Penjualan</title>
    <style>
        /* Tambahkan CSS sesuai dengan kebutuhan desain Anda */
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nota Penjualan</h2>
        <p>Nama Perusahaan</p>
        <p>Alamat Perusahaan</p>
    </div>

    <h3>Detail Penjualan</h3>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $no = 1;
    $grandTotal = 0; // Initialize the grand total
    foreach ($penjualan as $row) : ?>
        <tr>
            <td><?= (int)($no++) ?></td>
            <td><?= $row['nama_brg'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td><?= $row['subtotal'] ?></td>
        </tr>
        <?php
            $grandTotal += $row['subtotal']; // Add the subtotal to the grand total
        ?>
    <?php endforeach; ?>

    <!-- Display the total in a separate row -->
    <tr>
        <td colspan="3" style="text-align: right;"><strong>Total Penjualan:</strong></td>
        <td><?= $grandTotal ?></td>
    </tr>
</tbody>

    </table>

    
</body>
</html>