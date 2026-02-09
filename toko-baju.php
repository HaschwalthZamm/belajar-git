<?php
$conn = mysqli_connect("localhost", "root", "", "toko_baju");

if (isset($_POST['simpan'])) {
    $id_pelanggan   = $_POST['id_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $jenis_baju     = $_POST['jenis_baju'];
    $jenis_kain     = $_POST['jenis_kain'];
    $ukuran         = $_POST['ukuran'];

    mysqli_query($conn, "INSERT INTO pesanan VALUES (
        NULL,
        '$id_pelanggan',
        '$nama_pelanggan',
        '$jenis_baju',
        '$jenis_kain',
        '$ukuran'
    )");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toko Baju</title>
    <style>
        body {
            background: #f3f5f1;
            font-family: Arial, sans-serif;
        }
        .card {
            width: 420px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #556b2f;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
        }
        input, select, button {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
        }
        button {
            margin-top: 20px;
            background: #6b8e23;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #556b2f;
        }
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #6b8e23;
            color: white;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Form Pemesanan Baju</h2>

    <form method="post">
        <label>ID Pelanggan</label>
        <input type="text" name="id_pelanggan" required>

        <label>Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" required>

        <label>Jenis Baju</label>
        <select name="jenis_baju" required>
            <option value="">-- Pilih --</option>
            <option>Kaos</option>
            <option>Kemeja</option>
            <option>Jaket</option>
            <option>Hoodie</option>
            <option>Sweater</option>
        </select>

        <label>Jenis Kain</label>
        <select name="jenis_kain" required>
            <option value="">-- Pilih --</option>
            <option>Katun</option>
            <option>Satin</option>
            <option>Polyester</option>
            <option>Denim</option>
            <option>Rayon</option>
        </select>

        <label>Ukuran</label>
        <select name="ukuran" required>
            <option value="">-- Pilih --</option>
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>XL</option>
            <option>XXL</option>
        </select>

        <button name="simpan">Simpan Pesanan</button>
    </form>
</div>

<div class="card">
    <h2>Data Pesanan</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Jenis Baju</th>
            <th>Kain</th>
            <th>Ukuran</th>
        </tr>

        <?php
        $data = mysqli_query($conn, "SELECT * FROM pesanan");
        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?= $d['id_pelanggan'] ?></td>
            <td><?= $d['nama_pelanggan'] ?></td>
            <td><?= $d['jenis_baju'] ?></td>
            <td><?= $d['jenis_kain'] ?></td>
            <td><?= $d['ukuran'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
