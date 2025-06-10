<?php
include 'db_connect.php';

// נשלוף את כל השאלות
$sql = "SELECT id, player, team, year, number, image_url FROM questions ORDER BY id ASC";
$result = $conn->query($sql);

if ($result === false) {
    echo "שגיאה בשאילתה: " . $conn->error;
    exit;
}

// הדפס כל שאלה בשורה חדשה (לא JSON!)
while ($row = $result->fetch_assoc()) {
    echo $row['id'] . " | " .
         $row['player'] . " | " .
         $row['team'] . " | " .
         $row['year'] . " | " .
         $row['number'] . " | " .
         $row['image_url'] . "<br>";
}
$conn->close();
?>
