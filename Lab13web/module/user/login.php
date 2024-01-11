<?php

include_once('class/database.php');
include_once('class/form.php'); 

$errorMsg = null;
if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database($config);

    $login = $db->query("SELECT * FROM user WHERE username='{$user}'");
    if ($login) {
        $data = $login->fetch_assoc();
        if ($data) {
            if ($data['password'] === md5($password)) {
                $_SESSION['isLogin'] = true;
                $_SESSION['user'] = $data;
                header('location: ' . site_url('/'));
            } else {
                $errorMsg = "Password tidak cocok!.";
            }
        } else {
            $errorMsg = "Username tidak terdaftar!.";
        }
    }
}


include_once('template/header.php');

echo $errorMsg;

$form = new Form(site_url('/user/login'), "Login", "form-login");
$form->addField("username", "Username");
$form->addField("password", "Password", "password");
$form->displayForm();

include_once('template/footer.php');
?>