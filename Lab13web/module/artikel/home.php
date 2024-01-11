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
        /* Tambahkan gaya CSS sesuai kebutuhan */
    </style>
    <title>Home</title>
</head>
<body>
    <div class="container">
        <h1>Artikel Terbaru</h1>

        <div class="main">
            <?php if ($result): ?>
                <?php while ($row = mysqli_fetch_array($result)): ?>
                    <article class="entry">
                        <h2><a href="detail_artikel.php?id=<?= $row['id']; ?>"><?= $row['judul']; ?></a></h2>
                        <p><?= substr($row['isi'], 0, 200); ?></p>
                    </article>
                    <hr class="divider" />
                <?php endwhile; ?>
            <?php else: ?>
                <p>Belum ada artikel.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php include_once('template/footer.php'); ?>
