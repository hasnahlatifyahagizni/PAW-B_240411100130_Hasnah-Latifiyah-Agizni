<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $tahun = $_POST['tahun'];
    $gambar = $_FILES['gambar']['name'];
    $target = 'uploads/' . basename($gambar);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
        $sql = "INSERT INTO kendaraan (merk, tipe, tahun, gambar) VALUES ('$merk', '$tipe', '$tahun', '$gambar')";
        if (mysqli_query($conn, $sql)) {
            header("Location: index.php");
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal upload gambar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kendaraan</title>
</head>
<body>
<center>
    <fieldset style="width:50%">
        <legend><h3>📝 Tambah Kendaraan Baru</h3></legend>
        <form method="POST" enctype="multipart/form-data">
            <table cellpadding="5">
                <tr>
                    <td>Merk</td>
                    <td><input type="text" name="merk" required></td>
                </tr>
                <tr>
                    <td>Tipe</td>
                    <td><input type="text" name="tipe" required></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td><input type="number" name="tahun" min="1980" max="2025" required></td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td><input type="file" name="gambar" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit" name="submit">Simpan</button>
                        <a href="index.php">Kembali</a>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
</center>
</body>
</html>