<?php
// team.php
require_once 'db_connect.php';

// טיפול בשליחת טופס חוות דעת
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);
    $stars = intval($_POST['stars']);
    $grade = intval($_POST['grade']);

    // התאמה לשמות השדות בטבלה שלך:
    $sql = "INSERT INTO Review (name, review, stars, grade) VALUES ('$name', '$review', $stars, $grade)";
    mysqli_query($conn, $sql);
}

// שליפת כל חוות הדעת (בלי מיון לפי id)
$feedbacks = [];
$res = mysqli_query($conn, "SELECT * FROM Review");
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $feedbacks[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title> אודות הצוות וחוות דעת – Guess the Jersey</title>
  <link rel="stylesheet" href="style.css">
  <style>
    #team-stats {
      background: #f1f8e9;
      padding: 10px;
      border-radius: 6px;
      margin-top: 15px;
      font-weight: bold;
    }
    #countButton {
      margin-top: 15px;
      padding: 8px 16px;
      cursor: pointer;
    }
    /* ---- עיצוב משוב ---- */
    .feedback-form {
      background: #fffbe7;
      padding: 20px 15px;
      border-radius: 10px;
      margin-top: 30px;
      box-shadow: 0 4px 8px rgba(224, 182, 0, 0.05);
      max-width: 550px;
      margin-right: auto;
      margin-left: auto;
    }
    .stars {
      direction: ltr;
      display: inline-block;
    }
    .star {
      font-size: 2em;
      color: #ccc;
      cursor: pointer;
      transition: color 0.2s;
    }
    .star.selected,
    .star:hover,
    .star:hover ~ .star {
      color: #ffd700;
    }
    .feedback-list {
      margin-top: 35px;
      max-width: 550px;
      margin-right: auto;
      margin-left: auto;
    }
    .feedback-item {
      background: #f4f8fd;
      border: 1px solid #ddeaff;
      border-radius: 8px;
      margin-bottom: 20px;
      padding: 16px;
      box-shadow: 0 2px 4px rgba(160, 160, 255, 0.03);
      text-align: right;
    }
    .feedback-name {
      font-weight: bold;
      color: #3b5998;
      margin-bottom: 7px;
    }
    .feedback-stars {
      color: #ffd700;
      font-size: 1.3em;
      margin-bottom: 4px;
      display: inline-block;
    }
    .feedback-grade {
      background: #e8f5e9;
      color: #388e3c;
      border-radius: 5px;
      padding: 3px 7px;
      font-weight: bold;
      margin-right: 10px;
      font-size: 0.9em;
    }
    .feedback-text {
      margin-top: 8px;
    }
  </style>
  <script>
    // פונקציה שמציגה מידע סטטיסטי על חברי הצוות
    function analyzeTeam() {
      const members = [
        { name: "טל ליבוביץ", role: "Front-End" },
        { name: "שני רוזנפלד", role: "Back-End" }
      ];

      let msg = "";
      for (let i = 0; i < members.length; i++) {
        if (members[i].role.includes("Front")) {
          msg += members[i].name + " מתמחה בצד שרת. ";
        } else if (members[i].role.includes("Back")) {
          msg += members[i].name + " מתמחה בצד לקוח. ";
        }
      }

      document.getElementById("team-stats").innerHTML = msg;
      console.log("הצגת מידע על הצוות");
    }

    // דירוג כוכבים
    let selectedStars = 0;
    function setStars(n) {
      selectedStars = n;
      for (let i = 1; i <= 5; i++) {
        document.getElementById('star-' + i).classList.remove('selected');
        if (i <= n) document.getElementById('star-' + i).classList.add('selected');
      }
      document.getElementById('stars-input').value = n;
    }
    window.onload = function() {
      setStars(5); // ברירת מחדל: 5 כוכבים
    };
    function toggleView() {
  const card = document.getElementById("card-view");
  const table = document.getElementById("table-view");
  const btn = document.getElementById("toggle-view-button");

  if (card.style.display === "none") {
    card.style.display = "block";
    table.style.display = "none";
    btn.innerText = "🔁 החלף לתצוגת טבלה";
  } else {
    card.style.display = "none";
    table.style.display = "block";
    btn.innerText = "🔁 החלף לתצוגת כרטיסים";
  }
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

  <div class="container" style="text-align:right; max-width:700px; margin:30px auto;">
    <h1>אודות הצוות</h1>
    <p>אנחנו צוות המורכב משני חברים:</p>
    <ul style="text-align:right; margin-top:10px;">
      <li><strong>טל ליבוביץ</strong> –  אחראי על צד שרת (PHP, MySQL), בניית מסד הנתונים, לוגיקת האתר ושמירת התוצאות.</li>
      <li><strong>שני רוזנפלד</strong> –  אחראי על צד לקוח (HTML, CSS, JS), עיצוב UX/UI הצגת החידון בצורה אינטראקטיבית.</li>
    </ul>
    <p>הפרויקט נועד לספק חידון אינטראקטיבי בשם “Guess the Jersey”, שבו המשתמשים צריכים לנחש את מספר החולצה של שחקני כדורגל לפי תמונה, שנה וקבוצה.</p>

    <h2 style="margin-top:20px;">קישורים חיצוניים מומלצים</h2>
    <ul style="text-align:right; margin-top:10px;">
      <li><a href="https://he.wikipedia.org/wiki/ליגת_העל_(כדורגל)" target="_blank" rel="noopener">ויקיפדיה – ליגת העל (כדורגל)</a></li>
      <li><a href="https://www.fifa.com" target="_blank" rel="noopener">אתר FIFA הרשמי</a></li>
      <li><a href="https://www.uefa.com" target="_blank" rel="noopener">אתר UEFA הרשמי</a></li>
    </ul>

    <!-- כפתור אינטראקטיבי + תצוגה -->
    <button id="countButton" onclick="analyzeTeam()">👥 הצג מידע על הצוות</button>
    <div id="team-stats"></div>

    <p style="margin-top:20px;"><a href="index.php">⏮ חזרה לחידון</a></p>
  </div>

  <!-- טופס חוות דעת מתווסף כאן -->
  <div class="container" style="margin-bottom:30px; margin-top:0; background:transparent;">
    <h2 style="margin-top:10px;">💬 נשמח לחוות דעתכם!</h2>
    <form class="feedback-form" method="post" autocomplete="off">
      <label for="name">שם מלא:</label><br>
      <input type="text" id="name" name="name" required placeholder="השם שלך"><br>
      <label for="review">חוות דעת:</label><br>
      <textarea id="review" name="review" rows="3" required placeholder="המשוב שלך..."></textarea><br>
      <label>דירוג כוכבים:</label><br>
      <div class="stars">
        <span class="star" id="star-5" onclick="setStars(5)">★</span>
        <span class="star" id="star-4" onclick="setStars(4)">★</span>
        <span class="star" id="star-3" onclick="setStars(3)">★</span>
        <span class="star" id="star-2" onclick="setStars(2)">★</span>
        <span class="star" id="star-1" onclick="setStars(1)">★</span>
      </div>
      <input type="hidden" id="stars-input" name="stars" value="5"><br>
      <label for="grade">הישגכם בחידון?</label><br>
      <input type="number" id="grade" name="grade" min="1" max="100" required value="100"><br>
      <button type="submit">שלח משוב</button>
    </form>
  </div>
  <div style="text-align:center;">
  <button id="toggle-view-button" onclick="toggleView()" style="margin:20px auto; padding:10px 20px;">
    🔁 החלף לתצוגת טבלה
  </button>
</div>

  <!-- הצגת כל חוות הדעת מהטבלה -->
  <div <div class="feedback-list" id="card-view">
    <h2>📝 כל החוות דעת:</h2>
    <?php if (count($feedbacks) == 0): ?>
      <p>עדיין לא התקבלו משובים. היו הראשונים!</p>
    <?php else: ?>
      <?php foreach ($feedbacks as $fb): ?>
        <div class="feedback-item">
          <div>
            <span class="feedback-name"><?= htmlspecialchars($fb['name']) ?></span>
            <span class="feedback-grade">ציון: <?= intval($fb['grade']) ?></span>
          </div>
          <div class="feedback-stars">
            <?php
              $stars = intval($fb['stars']);
              for ($i = 0; $i < $stars; $i++) echo '★';
              for ($i = $stars; $i < 5; $i++) echo '<span style="color:#ccc">★</span>';
            ?>
          </div>
          <div class="feedback-text"><?= nl2br(htmlspecialchars($fb['review'])) ?></div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
<!-- התצוגה בטבלת HTML -->
<div id="table-view" style="display:none; max-width:800px; margin:30px auto; text-align:right;">
  <h2>📊 תצוגת טבלה:</h2>
  <table border="1" style="width:100%; border-collapse:collapse; text-align:center;">
    <thead>
      <tr>
        <th>שם</th>
        <th>דירוג</th>
        <th>ציון</th>
        <th>חוות דעת</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($feedbacks as $fb): ?>
        <tr>
          <td><?= htmlspecialchars($fb['name']) ?></td>
          <td>
            <?php
              $stars = intval($fb['stars']);
              for ($i = 0; $i < $stars; $i++) echo '★';
              for ($i = $stars; $i < 5; $i++) echo '<span style="color:#ccc">★</span>';
            ?>
          </td>
          <td><?= intval($fb['grade']) ?></td>
          <td><?= nl2br(htmlspecialchars($fb['review'])) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
  <footer style="margin-top:40px; text-align:center; font-size:0.9em;">
    <hr>
    <p>© 2025 Guess the Jersey – כל הזכויות שמורות.</p>
  </footer>

</body>
</html>
