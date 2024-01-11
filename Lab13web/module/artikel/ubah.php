<?php
include("koneksi.php");

$id = $_GET['id'];
$successMessage = $errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses form ubah data artikel
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $slug = $_POST['slug'];

    // Lakukan validasi dan perbarui data di database
    $sqlUpdate = "UPDATE artikel SET judul='$judul', isi='$isi', slug='$slug' WHERE id=$id";

    if (mysqli_query($conn, $sqlUpdate)) {
        $successMessage = 'Data berhasil diubah.';
    } else {
        $errorMessage = 'Error updating data: ' . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM artikel WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Ubah Artikel</title>
</head>
<body>
    <div class="container">
        <h1>Ubah Artikel</h1>

        <?php
        if (!empty($successMessage)) {
            echo '<p style="color: green;">' . $successMessage . '</p>';
        }
        
        if (!empty($errorMessage)) {
            echo '<p style="color: red;">' . $errorMessage . '</p>';
        }
        ?>

        <form method="post" action="">
            <label>Judul</label>
            <input type="text" name="judul" value="<?= $row['judul']; ?>" required>

            <label>Isi</label>
            <textarea name="isi" rows="4" required><?= $row['isi']; ?></textarea>

            <label>Slug</label>
            <input type="text" name="slug" value="<?= $row['slug']; ?>" required>

            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
