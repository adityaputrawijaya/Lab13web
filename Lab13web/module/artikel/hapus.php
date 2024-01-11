<?php
include("koneksi.php");

$id = $_GET['id'];

// Hapus data dari database
$sql = "DELETE FROM artikel WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    $message = "Artikel telah dihapus.";
} else {
    $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Hapus Artikel</title>
</head>
<body>
    <div class="container">
        <h1>Hapus Artikel</h1>
        <p><?= $message; ?></p>
    </div>
</body>
</html>
