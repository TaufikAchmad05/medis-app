<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

// Tambah alat medis
if (isset($_POST['tambah'])) {
    $nama_alat = $_POST['nama_alat'];
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];

    $sql = "INSERT INTO alat_medis (nama_alat, merk, tipe) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nama_alat, $merk, $tipe);
    $stmt->execute();
}

// Ambil data alat medis
$sql = "SELECT * FROM alat_medis";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="daftar.php">Daftar Harga</a></li>
            <li><a href="logout.php">Logout</a></li>
            
        </ul>
    </div>
    
    <div class="content">
        <h1>Masukan Data Alat</h1>
        <form method="POST">
            <input type="text" name="nama_alat" placeholder="Nama Alat" required>
            <input type="text" name="merk" placeholder="Merk" required>
            <input type="text" name="tipe" placeholder="Tipe" required>
            <button type="submit" name="tambah">Tambahkan Alat</button>
        </form>

        <h2>Daftar Alat Medis</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['nama_alat'] ?></td>
                        <td><?= $row['merk'] ?></td>
                        <td><?= $row['tipe'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>