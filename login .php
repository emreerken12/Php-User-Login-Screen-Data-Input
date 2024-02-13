<?php
// login.php

include "settings.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Veritabanından kullanıcıyı kontrol et
    $sql = "SELECT id, username, password FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            header("Location: profile.php");
        } else {
            echo "Şifre hatalı";
        }
    } else {
        echo "Kullanıcı bulunamadı";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Giriş Formu Emre Erken Final Projesi </title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 5px;
        }

        input[type="submit"] {
            width: auto;
        }
    </style>
</head>
<body>
    <h2>Giriş Formu</h2>
    <form method="post" action="login.php">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" required><br>

        <label for="password">Şifre:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Giriş Yap">
    </form>

    <form method="get" action="register.php">
        <input type="submit" value="Kayıt Ol">
    </form>
<hr>
	
<div>
	<p> Kullanıcı 1: emre </p>
	<p> Kullanıcı 1 şifre: 123</p>
<hr>
	<p> Kullanıcı 2: ayşe </p>
	<p> Kullanıcı 2 şifre: 123</p>

    <hr>

	<h4> İçine hiç veri gönderilmemiş kullanıcı </h4>

<p> Kullanıcı 3: boş </p>
	<p> Kullanıcı 3 şifre: boş</p>
	
	<hr>
</div>






</body>
</html>

