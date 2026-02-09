<?php
session_start();

/* =======================
   KONEKSI DATABASE
======================= */
$conn = mysqli_connect("localhost", "root", "", "penjahit_db");
if (!$conn) {
    die("Koneksi database gagal");
}

/* =======================
   PROSES LOGIN
======================= */
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // login sederhana (untuk tugas)
    if ($username == "admin" && $password == "admin") {
        $_SESSION['login'] = true;
    } else {
        $error = "Username atau password salah";
    }
}

/* =======================
   LOGOUT
======================= */
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Website Penjahit & Toko Baju</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f3;
            margin: 40px;
        }
        h2 {
            color: #556b2f;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            background: white;
        }
        th {
            background-color: #6b8e23;
            color: white;
            padding: 10px;
        }
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        input {
            padding: 8px;
            width: 250px;
        }
        button {
            padding: 8px 15px;
            background-color: #556b2f;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #6b8e23;
        }
        a {
            color: #556b2f;
            text-decoration: none;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['login'])) { ?>

    <!-- =======================
         HALAMAN LOGIN
    ======================== -->
    <h2>Login Admin</h2>

    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>

<?php } else { ?>

    <!-- =======================
         HALAMAN KATALOG
    ======================== -->
    <h2>Katalog Baju</h2>
    <p><a href="?logout=true">Logout</a></p>

    <table>
        <tr>
            <th>Nama Baju</th>
            <th>Jenis Kain</th>
            <th>Ukuran</th>
            <th>Harga</th>
        </tr>

        <?php
        $query = mysqli_query($conn, "SELECT * FROM produk");
        while ($data = mysqli_fetch_assoc($query)) {
            echo "<tr>
                    <td>{$data['nama']}</td>
                    <td>{$data['kain']}</td>
                    <td>{$data['ukuran']}</td>
                    <td>Rp {$data['harga']}</td>
                  </tr>";
        }
        ?>
    </table>

<?php } ?>

</body>
</html>
