<?php
include 'db.php';

// Pencarian
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Pagination
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data
$countSql = "SELECT COUNT(*) AS total FROM kendaraan WHERE merk LIKE '%$search%' OR tipe LIKE '%$search%'";
$countResult = mysqli_query($conn, $countSql);
$countRow = mysqli_fetch_assoc($countResult);
$total = $countRow['total'];
$pages = ceil($total / $limit);

// Ambil data kendaraan
$sql = "SELECT * FROM kendaraan WHERE merk LIKE '%$search%' OR tipe LIKE '%$search%' LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kendaraan</title>
</head>
<body>
<center>
    <h2>📋 DATA KENDARAAN</h2>
    <form method="GET">
        <input type="text" name="search" placeholder="Cari merk atau tipe..." value="<?php echo $search; ?>">
        <input type="submit" value="Cari">
        <a href="index.php">Tampilkan Semua</a> | 
        <a href="add.php">+ Tambah Kendaraan</a>
    </form>

    <hr>

    <table border="1" cellpadding="6" cellspacing="0" width="80%">
        <tr bgcolor="#f2f2f2" align="center">
            <th width="5%">ID</th>
            <th width="20%">Merk</th>
            <th width="20%">Tipe</th>
            <th width="10%">Tahun</th>
            <th width="20%">Gambar</th>
            <th width="25%">Aksi</th>
        </tr>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr align="center">
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['merk']; ?></td>
                <td><?php echo $row['tipe']; ?></td>
                <td><?php echo $row['tahun']; ?></td>
                <td><img src="uploads/<?php echo $row['gambar']; ?>" width="120"></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="6" align="center">Tidak ada data ditemukan</td></tr>
        <?php } ?>
    </table>

    <br>
    Halaman:
    <?php for ($i = 1; $i <= $pages; $i++) { ?>
        <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
    <?php } ?>
</center>
</body>
</html>