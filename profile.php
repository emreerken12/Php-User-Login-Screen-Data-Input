<?php
// profile.php

include "settings.php";
session_start();

// Oturum kontrolü yap
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

// Veritabanından kullanıcı bilgilerini al
$user_id = $_SESSION["user_id"];
$sql = "SELECT id, username, email FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Kullanıcı ID: " . $row["id"] . "<br>";
    echo "Kullanıcı Adı: " . $row["username"] . "<br>";
    echo "Email: " . $row["email"] . "<br>";
    echo "Asp sistemi veya jquery sistemi kurulmadığı için gelen veriyi görmek için refresh atmanız gerekli <hr>";

    // Kullanıcının kendine gönderilen mesajları çek
    $sqlMessages = "SELECT * FROM user_messages WHERE user_id='$user_id'";
    $resultMessages = $conn->query($sqlMessages);

    if ($resultMessages->num_rows > 0) {
        echo "<h3>Kendine Gönderilen Mesajlar</h3>";
        while ($messageRow = $resultMessages->fetch_assoc()) {
            echo "Mesaj ID: " . $messageRow["id"] . "<br>";
            echo "Mesaj İçeriği: " . $messageRow["message"] . "<br>";
            echo "<hr>";
        }
    } else {
        echo "<br> Kendine gönderilmiş veri bulunamadı.";
    }
} else {
    echo "Kullanıcı bulunamadı.";
}

$conn->close();
?>


