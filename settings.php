<?php
// settings.php

$servername = "localhost"; // Hosting sağlayıcınızın MySQL sunucu adı
$username = "emreerken"; // MySQL kullanıcı adınız
$password = "120038eE.."; // MySQL şifreniz
$database = "emreerken"; // Kullanmak istediğiniz MySQL veritabanı adı

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>