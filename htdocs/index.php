<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';

// התנתקות מוחלטת
if (isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
    exit;
}

// התחלה מחדש או איפוס מוחלט
if (!isset($_SESSION['username']) || isset($_POST['reset_all'])) {
    $_SESSION = [];
    session_destroy();
    session_start();
}

// קבלת שם משתמש
if (isset($_POST['username']) && trim($_POST['username']) !== "") {
    $_SESSION['username'] = trim($_POST['username']);
}

// הצגת מסך פתיחה עם הסברים וטופס כניסה
if (!isset($_SESSION['username'])):
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>כניסה לחידון Guess the Jersey</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function validateName() {
      const name = document.querySelector('input[name="username"]').value;
      if (name.length < 3) {
        alert("השם צריך להיות לפחות 3 תווים.");
        return false;
      }
      return true;
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

  <div class="intro-info" style="margin-top: 30px; background-color: #f0f8ff; border-radius: 10px; padding: 20px;">
    <h2> ברוכים הבאים לחידון נחש את החולצה!</h2>
    <h2> עליכם לזהות את מספר החולצה של שחקני הכדורגל במהלך השנים</h2>
    <h3 style="text-align: center;">🎯 לפני שמתחילים:</h3>
    <img src="jersey_hint.jpg" alt="תמונת רמז" style="max-width: 100%; border-radius: 8px; margin: 10px auto; display: block;">
    <ul style="line-height: 1.8; font-size: 1.1em;">
      <li>👕 שים לב לשנה המצויינת ולקבוצה – התמונה היא רק רמז.</li>
      <li>📅 השנה ליד השחקן היא השנה בה שיחק בקבוצה.</li>
      <li>🎽 כל שחקן יכול להופיע יותר מפעם אחת בלבד.</li>
      <li>🏆 תוכל לשמור את התוצאה לטבלת השיאים לאחר הסיום.</li>
      <li>🧠 לא בטוח? נחש מהזיכרון – אולי תופתע! 😉</li>
    </ul>
  </div>

  <div class="container">
    <img src="logo.png" alt="לוגו החידון" style="max-width:140px;">
    <h2>כניסה לחידון</h2>
    <form method="post" onsubmit="return validateName()">
      <label>שם מלא:</label><br>
      <input type="text" name="username" required maxlength="40" autofocus><br><br>
      <button class="btn" type="submit">התחל חידון</button>
    </form>
  </div>
</body>
</html>
<?php exit; endif; ?>

<?php
$username = $_SESSION['username'];

if (!isset($_SESSION['started']) || isset($_POST['reset'])) {
    $_SESSION['started'] = true;
    $_SESSION['score'] = 0;
    $_SESSION['qindex'] = 0;
    $res = $conn->query("SELECT * FROM questions ORDER BY RAND() LIMIT 11");
    $_SESSION['questions'] = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
}

$playSound = false;
$msg = "";
$questions = $_SESSION['questions'];
$index = $_SESSION['qindex'];
$total = count($questions);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer']) && isset($questions[$index])) {
    $curr = $questions[$index];
    $user_ans = trim($_POST['answer']);
    if ($user_ans !== "" && intval($user_ans) == $curr['number']) {
        $_SESSION['score']++;
        $msg = "תשובה נכונה!";
        $playSound = true;
    } else {
        $msg = "תשובה לא נכונה. המספר הנכון: {$curr['number']}";
    }
    $_SESSION['qindex']++;
    $index++;
}

if ($index < $total) {
    $q = $questions[$index];
} else {
    $q = null;
    if (isset($_POST['save_score']) && !isset($_SESSION['score_saved'])) {
        $safe_user = $conn->real_escape_string($username);
        $safe_score = intval($_SESSION['score']);
        $conn->query("INSERT INTO highscores (username, score) VALUES ('$safe_user', $safe_score)");
        $_SESSION['score_saved'] = true;
        $msg = "השיא שלך נשמר בהצלחה!";
    }
}
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>חידון Guess the Jersey</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function reviewSession() {
      const stats = [
        "משתמש: <?= addslashes($username) ?>",
        "שאלה נוכחית: <?= $index ?> מתוך <?= $total ?>",
        "ציון נוכחי: <?= $_SESSION['score'] ?>"
      ];
      alert("מידע על הסשן:\n" + stats.map(s => "- " + s).join("\n"));
    }

    window.addEventListener('DOMContentLoaded', () => {
      <?php if ($playSound): ?>
        const audio = new Audio('answer-correct.mp3');
        audio.play();
      <?php endif; ?>
    });
  </script>
  <style>
    .btn-answer {
      display: block;
      margin: 0 auto;
      text-align: center;
      margin-top: 10px;
      background-color: #28a745;
      color: white;
      padding: 12px 20px;
      font-size: 1.2em;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn-answer:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <nav>
    <ul class="nav-links">
      <li><a href="index.php">חידון</a></li>
      <li><a href="records.php">שיאים</a></li>
      <li><a href="contact.php">צור קשר</a></li>
      <li><a href="team.php">אודות הצוות</a></li>
      <li><a href="member1.php">טל ליבוביץ</a></li>
      <li><a href="member2.php">שני רוזנפלד</a></li>
    </ul>
  </nav>

  <div class="container">
    <?php if (!$q): ?>
      <img src="logo.png" alt="לוגו החידון">
    <?php endif; ?>

    <h1>Guess the Jersey!</h1>
    <div style="text-align:left; font-size:1em;">משתמש: <b><?= htmlspecialchars($username) ?></b></div>

   <?php if ($msg): ?>
  <div class="msg"><?= $msg ?></div>
<?php endif; ?>

<?php if ($q): ?>
  <form method="post" action="index.php">
    <div class="question">
      <img src="<?= htmlspecialchars($q['image_url']) ?>" alt="תמונת שחקן"><br>
      <b>שחקן:</b> <?= htmlspecialchars($q['player']) ?><br>
      <b>קבוצה:</b> <?= htmlspecialchars($q['team']) ?><br>
      <b>שנה:</b> <?= htmlspecialchars($q['year']) ?><br><br>
      <label>מה מספר החולצה?</label><br>
      <input type="number" name="answer" required autofocus>

      <button type="submit" class="btn-answer">זו תשובתי</button>
    </div>
    <div>
      שאלה <?= $index + 1 ?> מתוך <?= $total ?>
    </div>
    <br>
    <button type="button" onclick="reviewSession()">📊 סטטיסטיקה</button>
  </form>

  <!-- טופס התנתקות נפרד כדי שלא ייחסם בגלל שדה required -->
  <form method="post" action="index.php" style="text-align: center; margin-top: 10px;">
    <button name="logout" value="1" class="btn" style="background:#f00; color:#fff;" onclick="return confirm('האם אתה בטוח שברצונך להתנתק?')">🔒 התנתק</button>
  </form>

<?php else: ?>
  <div class="score">
    החידון הסתיים!<br>
    <?= htmlspecialchars($username) ?>, קיבלת <?= $_SESSION['score'] ?> מתוך <?= $total ?>.
  </div>

  <form method="post" action="index.php">
    <?php if (!isset($_SESSION['score_saved'])): ?>
      <button name="save_score" value="1" class="btn">💾 שמור שיא</button>
    <?php endif; ?>
    <button name="reset" value="1" class="btn">התחל חידון חדש</button>
    <button name="reset_all" value="1" class="btn" style="background:#eee; color:#333;">החלף משתמש</button>
    <button name="logout" value="1" class="btn" style="background:#f00; color:#fff;" onclick="return confirm('האם אתה בטוח שברצונך להתנתק?')">🔒 התנתק</button>
  </form>
<?php endif; ?>

  </div>
</body>
</html>
<?php $conn->close(); ?>
