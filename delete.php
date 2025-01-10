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

    // Hapus data alat medis berdasarkan ID
    $sql = "DELETE FROM alat_medis WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Terjadi kesalahan dalam penghapusan!";
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>