<?php
session_start();

// --- PENGATURAN PASSWORD ---
$password_benar = "ADMINZAKY"; // Ganti ini dengan password Anda
// ---------------------------

// Proses Login
if (isset($_POST['login'])) {
    if ($_POST['password'] == $password_benar) {
        $_SESSION['loggedin'] = true;
    } else {
        $error = "Password Salah!";
    }
}

// Proses Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Terproteksi</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; padding: 20px; display: flex; flex-direction: column; align-items: center; }
        .login-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; }
        input[type="password"] { padding: 10px; width: 200px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        table { width: 90%; max-width: 1000px; border-collapse: collapse; background: white; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-top: 20px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #007bff; color: white; }
        .btn-maps { padding: 8px 12px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; font-size: 13px; }
        .logout { margin-top: 20px; color: #dc3545; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['loggedin'])): ?>
    <div class="login-box">
        <h2>Login Dashboard</h2>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <input type="password" name="password" placeholder="Masukkan Password" required><br>
            <button type="submit" name="login">Masuk</button>
        </form>
    </div>

<?php else: ?>
    <h2>Riwayat Lokasi Pasangan</h2>
    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $file = 'log_lokasi.txt';
            if (file_exists($file)) {
                $data = file($file);
                foreach (array_reverse($data) as $line) {
                    $parts = explode('|', $line);
                    if (count($parts) >= 3) {
                        $waktu = str_replace('Waktu: ', '', $parts[0]);
                        $lat = str_replace(' Lat: ', '', $parts[1]);
                        $lon = str_replace(' Lon: ', '', $parts[2]);
                        echo "<tr>
                                <td>$waktu</td>
                                <td>$lat</td>
                                <td>$lon</td>
                                <td><a class='btn-maps' href='https://www.google.com/maps?q=$lat,$lon' target='_blank'>Lihat di Peta</a></td>
                              </tr>";
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <a href="?logout=1" class="logout">Keluar (Logout)</a>
<?php endif; ?>

</body>
</html>