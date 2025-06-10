<?php
// submit_score.php
// מקבל POST עם { username, score } ומכניס לטבלת highscores

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

// קריאת גוף הבקשה (JSON)
$rawBody = file_get_contents('php://input');
$data = json_decode($rawBody, true);

if (!isset($data['username'], $data['score'])) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Missing parameters. Expected {username, score}.'
    ]);
    exit;
}

$username = trim($data['username']);
$score    = (int)$data['score'];

if ($username === '' || $score < 0) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Invalid username or score.'
    ]);
    exit;
}

include 'db_connect.php';

// שימוש ב-prepared statement למניעת SQL Injection
$stmt = $conn->prepare("INSERT INTO highscores (username, score) VALUES (?, ?)");
if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Prepare failed: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param("si", $username, $score);
if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Score inserted successfully.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'error' => 'Execute failed: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
exit;
?>
