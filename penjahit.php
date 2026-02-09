<?php
$conn = mysqli_connect("localhost", "root", "", "penjahit_db");
if (!$conn) {
    die("Koneksi database gagal");
}

/* =======================
   SIMPAN PESANAN
======================= */
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_baju'];
    $kain = $_POST['jenis_kain'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];

    mysqli_query($conn, 
        "INSERT INTO pesanan VALUES (NULL,'$nama','$kain','$ukuran','$harga')"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toko Baju & Penjahit</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f3;
            margin: 40px;
        }
        h2 { color: #556b2f; }
        input, select {
            padding: 8px;
            width: 250px;
        }
        button {
            background: #556b2f;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            background: white;
            margin-top: 20px;
        }
        th {
            background: #6b8e23;
            color: white;
            padding: 10px;
        }
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }
    </style>
</head>
<body>

<h2>Form Pemesanan Baju</h2>

<form method="post">
    <input name="nama_baju" placeholder="Nama Baju" required><br><br>

    <input name="jenis_kain" placeholder="Jenis Kain" required><br><br>

    <select name="ukuran" required>
        <option value="">Pilih Ukuran</option>
        <option>S</option>
        <option>M</option>
        <option>L</option>
        <option>XL</option>
        <option>XXL</option>
    </select><br><br>

    <input type="number" name="harga" placeholder="Harga" required><br><br>

    <button name="simpan">Simpan Pesanan</button>
</form>

<h2>Daftar Pesanan Pelanggan</h2>

<table>
    <tr>
        <th>Nama Baju</th>
        <th>Jenis Kain</th>
        <th>Ukuran</th>
        <th>Harga</th>
    </tr>

    <?php
    $q = mysqli_query($conn, "SELECT * FROM pesanan");
    while ($d = mysqli_fetch_assoc($q)) {
        echo "<tr>
            <td>{$d['nama_baju']}</td>
            <td>{$d['jenis_kain']}</td>
            <td>{$d['ukuran']}</td>
            <td>Rp {$d['harga']}</td>
        </tr>";
    }
    ?>
</table>

</body>
</html>
