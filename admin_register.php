<?php
// admin_register.php

include "settings.php";

$admin_username = "emre";
$admin_password = "emre123";

// Şifreyi hashle
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Veritabanına ekle
$sql = "INSERT INTO admins (username, password) VALUES ('$admin_username', '$hashed_password')";
if ($conn->query($sql) === TRUE) {
    echo "Yeni admin başarıyla eklendi.";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>