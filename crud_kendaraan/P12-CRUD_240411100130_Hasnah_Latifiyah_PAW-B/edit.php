<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM kendaraan WHERE id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $tahun = $_POST['tahun'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target = 'uploads/' . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    } else {
        $gambar = $data['gambar'];
    }

    $update = "UPDATE kendaraan SET merk='$merk', tipe='$tipe', tahun='$tahun', gambar='$gambar' WHERE id=$id";
    if (mysqli_query($conn, $update)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kendaraan</title>
</head>
<body>
<center>
    <fieldset style="width:50%">
        <legend><h3>✏️ Edit Data Kendaraan</h3></legend>
        <form method="POST" enctype="multipart/form-data">
            <table cellpadding="5">
                <tr>
                    <td>Merk</td>
                    <td><input type="text" name="merk" value="<?php echo $data['merk']; ?>" required></td>
                </tr>
                <tr>
                    <td>Tipe</td>
                    <td><input type="text" name="tipe" value="<?php echo $data['tipe']; ?>" required></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td><input type="number" name="tahun" value="<?php echo $data['tahun']; ?>" required></td>
                </tr>
                <tr>
                    <td>Gambar Saat Ini</td>
                    <td><img src="uploads/<?php echo $data['gambar']; ?>" width="100"></td>
                </tr>
                <tr>
                    <td>Ganti Gambar</td>
                    <td><input type="file" name="gambar"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit" name="submit">Simpan Perubahan</button>
                        <a href="index.php">Kembali</a>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
</center>
</body>
</html>