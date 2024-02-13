<?php
// register.php

include "settings.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];

    // Veritabanına ekle
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        // Kayıt başarılı, kullanıcıyı login.php'ye yönlendir
        header("Location: login.php");
        exit(); // Yönlendirme sonrası kodun çalışmasını engelle
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>







<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Formu Emre Erken Final Projesi</title>
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
        input[type="email"],
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 5px;
        }

        input[type="submit"] {
            width: auto;
        }

        .login-link {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Kayıt Formu</h2>
    <form method="post" action="register.php">
        Kullanıcı Adı: <input type="text" name="username" required><br>
        Şifre: <input type="password" name="password" required><br>
        Email: <input type="email" name="email" required><br>
        <input type="submit" value="Kayıt Ol">
    </form>

    <div class="login-link">
        Zaten bir hesabın var mı? <a href="login.php">Giriş'e Dön</a>
    </div>

	


</body>
</html>

