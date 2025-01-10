<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Cek apakah ID alat medis ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data alat medis berdasarkan ID
    $sql = "SELECT * FROM alat_medis WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_alat = $_POST['nama_alat'];
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];

    $sql = "UPDATE alat_medis SET nama_alat = ?, merk = ?, tipe = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nama_alat, $merk, $tipe, $id);
    
    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Terjadi kesalahan dalam pengeditan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Alat Medis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Medis App</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    
    <div class="content">
        <h1>Edit Alat Medis</h1>
        <form method="POST">
            <input type="text" name="nama_alat" value="<?= $row['nama_alat'] ?>" placeholder="Nama Alat" required>
            <input type="text" name="merk" value="<?= $row['merk'] ?>" placeholder="Merk" required>
            <input type="text" name="tipe" value="<?= $row['tipe'] ?>" placeholder="Tipe" required>
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>