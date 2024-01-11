<?php
include_once('template/header.php');
include_once 'koneksi.php';

$q = "";
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = "WHERE nama LIKE '{$q}%'"; 
}
$title = 'Data Barang';
$sql = 'SELECT * FROM data_barang ';
$sql_count = "SELECT COUNT(*) FROM data_barang";
if (isset($sql_where)) {
    $sql .= $sql_where;
    $sql_count .= $sql_where;
}
$result_count = mysqli_query($conn, $sql_count);
$count = 0;
if ($result_count) {
    $r_data = mysqli_fetch_row($result_count);
    $count = $r_data[0];
}
$per_page = 1;
$num_page = ceil ($count / $per_page);
$limit = $per_page;
if(isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * $per_page;
} else {
    $offset = 0;
    $page = 1;
}
$sql .= "LIMIT {$offset},{$limit}";
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

        ul.pagination {
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        ul.pagination li {
            display: inline;
            margin-right: 5px; /* Add margin between pagination items */
        }

        ul.pagination li a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        ul.pagination li a.active {
            background-color: pink;
            color: white;
        }

        ul.pagination li a:hover:not(.active) {
            background-color: pink;
        }
    </style>
    <title>Data Barang</title>
</head>

<body>
    <div class="container">
        <h1>Data Barang</h1>
        <a href="module/page/tambah.php?page=<?= $page ?>" class="tambah-button">Tambah Barang</a>

        <form>
                <div class="form-group" action="" method="get" >
                    <label for="q">Cari Barang</label>
                    <input type="text" placeholder="Masukkan Pencarian"  id="q" name="q" class="input-q" value="<?php echo $q ?>">
                    <button type="submit" name="submit" class="btn btn-primary" style="background-color: pink;">Cari</button>
                </div>
        </form>
        <div class="main">
            <?php if ($result) : ?>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                        <tr>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['kategori']; ?></td>
                            <td><?= $row['harga_beli']; ?></td>
                            <td><?= $row['harga_jual']; ?></td>
                            <td><?= $row['stok']; ?></td>
                            <td>
                                <a href="module/page/ubah.php?id=<?= $row['id_barang']; ?>">Ubah</a>
                                <a href="module/page/hapus.php?id=<?= $row['id_barang']; ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>

                <ul class="pagination">
                    <li><a href="?page=1">&laquo;</a></li>
                    <?php for ($i = 1; $i <= $num_page; $i++) : ?>
                        <?php
                        $link = "?page={$i}";
                        if (!empty($q)) $link .= "&q={$q}";
                        $class = ($page == $i ? 'active' : '');
                        ?>
                        <li><a class="<?= $class ?>" href="<?= $link ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li><a href="?page=<?= $num_page ?>">&raquo;</a></li>
                </ul>

            <?php else : ?>
                <p>Belum ada data</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
<?php include_once('template/footer.php'); ?>
