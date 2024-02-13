<?php
// admin_panel.php

session_start();

// Admin oturum kontrolü yap
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
}

// Veritabanından tüm kullanıcıları al
include "settings.php";

$sql = "SELECT id, username FROM users";
$result = $conn->query($sql);

$users = array();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Emre Erken Final Projesi</title>
    <style>
        body {
            text-align: center;
            padding: 20px;
        }

        form {
            display: inline-block;
            text-align: left;
        }

        label, input, select {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Admin Panel</h2>
    <form method="post" action="process_data.php">
        <label for="user_id">Kullanıcı Seç:</label>
        <select name="user_id" id="user_id" required>
            <?php foreach ($users as $user) : ?>
                <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="message">Veri Gönder:</label>
        <input type="text" name="message" id="message" required><br>

        <input type="submit" value="Gönder">
    </form>
</body>
</html>


