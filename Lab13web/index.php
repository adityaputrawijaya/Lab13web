<?php
include("koneksi.php");

// Pagination configuration
$records_per_page = 2;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// query to fetch data with pagination
$sql = "SELECT * FROM data_barang LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $sql);

// query to get total number of records
$total_records_sql = "SELECT COUNT(*) FROM data_barang";
$total_records_result = mysqli_query($conn, $total_records_sql);
$total_records = mysqli_fetch_array($total_records_result)[0];
$total_pages = ceil($total_records / $records_per_page);

$q = isset($_GET['q']) ? $_GET['q'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Data Barang</title>
</head>
<body>
    <div class="container">
        <h1>Data Barang</h1>
        <a href="tambah.php">Tambah Barang</a>

        <form>
            <div class="form-group" action="" method="get">
                <label for="q">Cari Barang</label>
                <input type="text" placeholder="Masukkan Pencarian" id="q" name="q" class="input-q" value="<?php echo $q ?>">
                <button type="submit" name="submit" class="btn btn-primary" style="background-color: pink;">Cari</button>
            </div>
        </form>

        <div class="main">
            <table>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
                <?php if ($result): ?>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><img src="gambar/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>"></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['kategori']; ?></td>
                            <td><?= $row['harga_beli']; ?></td>
                            <td><?= $row['harga_jual']; ?></td>
                            <td><?= $row['stok']; ?></td>
                            <td>
                                <a href="ubah.php?id=<?= $row['id_barang']; ?>">ubah</a>
                                <a href="hapus.php?id=<?= $row['id_barang']; ?>">hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; else: ?>
                    <tr>
                        <td colspan="7">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </table>

            <!-- Pagination links -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>&q=<?php echo $q; ?>">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&q=<?php echo $q; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>&q=<?php echo $q; ?>">></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
