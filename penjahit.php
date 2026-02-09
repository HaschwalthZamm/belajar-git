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
   REGISTER
======================= */
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    mysqli_query($conn, "INSERT INTO users VALUES(NULL,'$username','$password')");
    echo "<script>alert('Registrasi berhasil, silakan login');</script>";
}

/* =======================
   LOGIN USER
======================= */
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['user'] = $username;
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
    <title>Toko Baju & Penjahit</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f3;
            margin: 40px;
        }
        h2 { color: #556b2f; }
        button {
            background: #556b2f;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            background: white;
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
        a { color: #556b2f; }
        .error { color: red; }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['user']) && !isset($_GET['katalog'])) { ?>

    <!-- =======================
         HALAMAN AWAL
    ======================== -->
    <h2>Selamat Datang di Toko Baju</h2>

    <p>
        <a href="?login_page=true">Login</a> |
        <a href="?register_page=true">Daftar</a> |
        <a href="?katalog=true">Lihat Katalog</a>
    </p>

<?php } ?>

<?php if (isset($_GET['login_page'])) { ?>
    <h2>Login Pelanggan</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <input name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button name="login">Login</button>
    </form>
<?php } ?>

<?php if (isset($_GET['register_page'])) { ?>
    <h2>Daftar Pelanggan</h2>
    <form method="post">
        <input name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button name="register">Daftar</button>
    </form>
<?php } ?>

<?php if (isset($_GET['katalog'])) { ?>
    <h2>Katalog Baju</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Kain</th>
            <th>Ukuran</th>
            <th>Harga</th>
        </tr>
        <?php
        $q = mysqli_query($conn, "SELECT * FROM produk");
        while ($d = mysqli_fetch_assoc($q)) {
            echo "<tr>
                <td>{$d['nama']}</td>
                <td>{$d['kain']}</td>
                <td>{$d['ukuran']}</td>
                <td>Rp {$d['harga']}</td>
            </tr>";
        }
        ?>
    </table>
<?php } ?>

<?php if (isset($_SESSION['user'])) { ?>
    <p>Halo, <b><?= $_SESSION['user']; ?></b> |
       <a href="?logout=true">Logout</a></p>
<?php } ?>

</body>
</html>