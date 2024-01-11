<?php
include_once('template/header.php');
include("koneksi.php");

$sql = 'SELECT * FROM artikel';
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style>
        th {
            background-color: pink;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 16px;
            font-weight: normal;
        }

        .tambah-button {
            background-color: pink;
            border: none;
            color: white;
            padding: 10px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 8px 6px;
            cursor: pointer;
            font-weight: normal;
        }
    </style>
    <title>Data Artikel</title>
</head>
<body>
    <div class="container">
        <h1>Data Artikel</h1>
        <a href="/lab12_php_login/module/artikel/add.php" class="tambah-button">Tambah Artikel</a>

        <div class="main">
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
                <?php if ($result): ?>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><?= $row['judul']; ?></td>
                            <td><?= substr($row['isi'], 0, 200); ?></td>
                            <td><?= $row['slug']; ?></td>
                            <td>
                                <a href="/lab12_php_login/module/artikel/ubah.php?id=<?= $row['id']; ?>">Ubah</a>
                                <a href="/lab12_php_login/module/artikel/hapus.php?id=<?= $row['id']; ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php include_once('template/footer.php'); ?>
