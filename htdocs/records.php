<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';

// סטטיסטיקות ב-PHP
function calculateStats($scores) {
    $count = count($scores);
    if ($count === 0) return [];

    sort($scores);
    $sum = array_sum($scores);
    $average = $sum / $count;
    $median = $scores[intval($count / 2)];
    $min = min($scores);
    $max = max($scores);

    // חישוב סטיית תקן
    $variance = 0;
    foreach ($scores as $s) {
        $variance += pow($s - $average, 2);
    }
    $std_dev = sqrt($variance / $count);

    return [
        'count' => $count,
        'average' => round($average, 2),
        'median' => $median,
        'min' => $min,
        'max' => $max,
        'std_dev' => round($std_dev, 2)
    ];
}

// שליפת הנתונים
$scoreData = [];
$resStats = $conn->query("SELECT score FROM highscores");
if ($resStats && $resStats->num_rows > 0) {
    while ($row = $resStats->fetch_assoc()) {
        $scoreData[] = intval($row['score']);
    }
}
$stats = calculateStats($scoreData);
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>שיאים</title>
  <link rel="stylesheet" href="style.css">
  <style>
    #stats, #phpStats {
      margin: 15px 0;
      padding: 10px;
      background: #e3f2fd;
      border-radius: 6px;
      font-weight: bold;
    }
    #showStatsBtn {
      padding: 8px 16px;
      margin-top: 20px;
      cursor: pointer;
    }
    #phpStats ul {
      list-style: square inside;
      line-height: 1.8;
    }
  </style>
  <script>
    function showStats() {
      let scores = Array.from(document.querySelectorAll("table tr td:nth-child(3)"))
                        .map(td => parseInt(td.textContent)).filter(n => !isNaN(n));
      
      let above5 = 0;
      let total = scores.length;

      for (let i = 0; i < scores.length; i++) {
        if (scores[i] > 5) {
          above5++;
        }
      }

      let msg = `מתוך ${total} שחקנים, ${above5} קיבלו יותר מ־5 נקודות.`;
      document.getElementById("stats").innerHTML = msg;
      console.log("סטטיסטיקות מוצגות");
    }
  </script>
</head>
<body>
  <nav>
    <ul class="nav-links">
      <li><a href="index.php">חידון</a></li>
      <li><a href="records.php">שיאים</a></li>
      <li><a href="contact.php">צור קשר</a></li>
      <li><a href="team.php">אודות וחוות דעת</a></li>
      <li><a href="member1.php">טל ליבוביץ</a></li>
      <li><a href="member2.php">שני רוזנפלד</a></li>
    </ul>
  </nav>

  <div class="container">
    <h2 id="blue-text">טבלת שיאים</h2>
    <table>
      <tr>
        <th>#</th>
        <th>שם</th>
        <th>ניקוד</th>
      </tr>
      <?php
      $res = $conn->query("SELECT username, score FROM highscores ORDER BY score DESC, id ASC LIMIT 50");
      $i = 1;
      if ($res && $res->num_rows > 0) {
          while ($row = $res->fetch_assoc()) {
              echo "<tr><td>{$i}</td><td>".htmlspecialchars($row['username'])."</td><td>".htmlspecialchars($row['score'])."</td></tr>";
              $i++;
          }
      } else {
          echo "<tr><td colspan='3'>אין עדיין שיאים.</td></tr>";
      }
      ?>
    </table>

    <button id="showStatsBtn" onclick="showStats()">📊 הצג סטטיסטיקות JS</button>
    <div id="stats"></div>

    <div id="phpStats">
      <h3>📈 ניתוח סטטיסטי (PHP):</h3>
      <?php if (!empty($stats)): ?>
        <ul>
          <li>סה"כ שחקנים: <?= $stats['count'] ?></li>
          <li>ממוצע ניקוד: <?= $stats['average'] ?></li>
          <li>חציון: <?= $stats['median'] ?></li>
          <li>מינימום: <?= $stats['min'] ?></li>
          <li>מקסימום: <?= $stats['max'] ?></li>
          <li>סטיית תקן: <?= $stats['std_dev'] ?></li>
        </ul>
      <?php else: ?>
        <p>אין נתונים לניתוח.</p>
      <?php endif; ?>
    </div>
    <div class="container" style="margin-top: 20px;">
  <h3>🧮 מחשבון ממוצע ציונים</h3>

  <?php
  // פונקציה לחישוב ממוצע של מערך ציונים
  function calculateAverage($grades) {
    $sum = array_sum($grades); // פעולה חישובית
    return round($sum / count($grades), 2);
  }

  $resultMessage = "";

  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['grades'])) {
    $gradesInput = trim($_POST['grades']); // פונקציית מחרוזת trim
    $gradesArray = explode(',', $gradesInput); // יצירת מערך

    // ניקוי הנתונים (הפיכת מחרוזות למספרים)
    $cleanGrades = [];
    foreach ($gradesArray as $grade) { // לולאה
      $grade = floatval(trim($grade)); // ניקוי כל ציון
      if ($grade >= 0 && $grade <= 100) { // בדיקת תקינות הציון
        $cleanGrades[] = $grade;
      }
    }

    if (count($cleanGrades) === 3) {
      $average = calculateAverage($cleanGrades); // קריאה לפונקציה
      $resultMessage = "הממוצע שלך הוא: <strong>{$average}</strong>";
    } else {
      $resultMessage = "<span style='color:red;'>יש להזין בדיוק 3 ציונים בין 0 ל־100, מופרדים בפסיקים.</span>";
    }
  }
  ?>

  <form method="POST">
    <label for="grades">הזן 3 ציונים (בין 0 ל־100) מופרדים בפסיקים:</label><br>
    <input type="text" name="grades" id="grades" placeholder="לדוגמה: 88,92,76" style="width:80%; padding:8px; margin-top:10px;" required>
    <button type="submit">חשב ממוצע</button>
  </form>

  <?php if ($resultMessage): ?>
    <div style="margin-top:15px; background:#e3f2fd; padding:10px; border-radius:6px;">
      <?= $resultMessage ?>
    </div>
  <?php endif; ?>

</div>

  </div>
</body>
</html>
<?php $conn->close(); ?>
