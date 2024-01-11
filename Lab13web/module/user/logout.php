<?php
session_destroy();
header('location: ' . site_url('/'));
?>