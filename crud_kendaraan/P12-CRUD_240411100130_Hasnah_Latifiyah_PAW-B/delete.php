<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus gambar dari folder
    $get = mysqli_query($conn, "SELECT gambar FROM kendaraan WHERE id = $id");
    $data = mysqli_fetch_assoc($get);
    if ($data && file_exists('uploads/' . $data['gambar'])) {
        unlink('uploads/' . $data['gambar']);
    }

    // Hapus data
    $sql = "DELETE FROM kendaraan WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}
?>