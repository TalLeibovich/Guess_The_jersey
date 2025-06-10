<?php
// db_connect.php

// הצגת שגיאות (רק בזמן פיתוח)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// פרטי החיבור למסד הנתונים (ByetHost)
$db_host =   // Host של MySQL
$db_user =            // שם המשתמש למסד
$db_pass =             // הסיסמה למסד הנתונים
$db_name =      // שם מסד הנתונים

// יצירת חיבור
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// בדיקה האם החיבור הצליח
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
