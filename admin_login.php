<?php
// admin_login.php

include "settings.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = $_POST["admin_username"];
    $admin_password = $_POST["admin_password"];

    // Kullanıcı adına göre veritabanından bilgileri çek
    $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username=?");
    $stmt->bind_param("s", $admin_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($admin_id, $db_username, $db_password);
        $stmt->fetch();

        // Şifreyi doğrula
        if (password_verify($admin_password, $db_password)) {
            // Kullanıcı kimliğini oturuma sakla (gerekiyorsa)
            $_SESSION["admin_id"] = $admin_id;
            $_SESSION["admin_username"] = $db_username;
            header("Location: admin_panel.php");
            exit(); // Yönlendirmeden sonra kodun devam etmemesi için çıkış yapılıyor
        } else {
            echo "Şifre hatalı";
        }
    } else {
        echo "Admin bulunamadı";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Giriş Formu Emre Erken Final Projesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color: blue; /* Changed color to blue for better visibility */
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
    </style>
</head>
<body>
    <h2>Admin Giriş Formu</h2>
    <form method="post" action="admin_login.php">
        <label for="admin_username">Admin Kullanıcı Adı:</label>
        <input type="text" name="admin_username" required><br>

        <label for="admin_password">Admin Şifre:</label>
        <input type="password" name="admin_password" required><br>

        <input type="submit" value="Giriş Yap">
    </form>

    <h2 style="color: red;">admin_register.php dosyası 1 kere çalıştırılmıştır. Bir kere daha çalıştırmayın teşekkürler.</h2>
    <h2>Kullanıcı adı: emre</h2>
    <h2>şifre: emre123</h2>
</body>
</html>
