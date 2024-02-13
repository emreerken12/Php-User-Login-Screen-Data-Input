<?php
// process_data.php

session_start();

// Admin oturum kontrolü yap
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $user_id = $_POST["user_id"];
    $message = $_POST["message"];

    // Veritabanına ekle
    include "settings.php";

    $sql = "INSERT INTO user_messages (user_id, message) VALUES ('$user_id', '$message')";
    if ($conn->query($sql) === TRUE) {
        // Bilgi gönderildi
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

