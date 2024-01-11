<?php
include("koneksi.php");

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses form tambah data artikel
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $slug = $_POST['slug'];

    // Lakukan validasi dan simpan data ke database
    $sql = "INSERT INTO artikel (judul, isi, slug) VALUES ('$judul', '$isi', '$slug')";

    if (mysqli_query($conn, $sql)) {
        $successMessage = 'Data berhasil ditambahkan.';
    } else {
        $errorMessage = 'Error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Tambah Artikel</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Artikel</h1>

        <?php if (!empty($successMessage)): ?>
            <p style="color: green;"><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label>Judul</label>
            <input type="text" name="judul" required>

            <label>Isi</label>
            <textarea name="isi" rows="4" required></textarea>

            <label>Slug</label>
            <input type="text" name="slug" required>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
