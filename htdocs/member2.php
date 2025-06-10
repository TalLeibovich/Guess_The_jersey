<?php
// member2.php
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>שני רוזנפלד – Guess the Jersey</title>
  <link rel="stylesheet" href="style.css">
  <style>
    #message-status {
      margin: 10px;
      color: #2196F3;
      font-weight: bold;
    }
  </style>
  <script>
    function generateGreeting(name) {
      return "ההודעה נשלחה אל " + name + "!";
    }

    function sendMessage(event) {
      event.preventDefault();
      const name = "שני רוזנפלד";
      const textarea = document.querySelector("textarea[name='message']");
      const message = textarea.value.trim();
      const statusDiv = document.getElementById("message-status");

      if (message.length === 0) {
        statusDiv.innerHTML = "לא ניתן לשלוח הודעה ריקה.";
        return;
      }

      statusDiv.innerHTML = generateGreeting(name);

      const subject = encodeURIComponent("הודעה מהאתר");
      const body = encodeURIComponent(message);
      const mailtoLink = `mailto:SHANI@example.com?subject=${subject}&body=${body}`;
      window.location.href = mailtoLink;
    }

    // ✅ alert בעת טעינת הדף
    window.onload = function () {
      alert("ברוכים הבאים לעמוד של שני רוזנפלד!");
    };

    // ✅ הדגמה של document.write()
    function showFunFact() {
      document.write("<h2 style='color:purple;'>✨ עובדה כיפית על שני: אוהב קוד נקי ומודולרי!</h2>");
    }

    document.addEventListener("DOMContentLoaded", function () {
      const form = document.getElementById("contact-shani");
      if (form) {
        form.addEventListener("submit", sendMessage);
      }
    });
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

  <section class="profile" style="max-width:600px; margin:30px auto; text-align:center;">
    <h1>שני רוזנפלד</h1>
    <img src="shani.jpg" alt="תמונת פרופיל של שני רוזנפלד" style="max-width:250px; border-radius:8px;">
    
    <p>
      אני שני רוזנפלד, סטודנט להנדסת תוכנה עם התמחות בפיתוח צד שרת, בסיסי נתונים ואוטומציה.<br><br>
      בפרויקטים השונים עבדתי עם טכנולוגיות מתקדמות:
    </p>
    <ul style="text-align:right; direction:rtl; max-width:500px; margin: 0 auto;">
      <li>הקמת מערכות Backend מבוססות PHP ו-MySQL עם התממשקות ל-REST APIs.</li>
      <li>שימוש מתקדם ב-JavaScript לצד שרת ולקוח, כולל עבודה עם Ajax ו-JSON.</li>
      <li>אופטימיזציה של שאילתות SQL בפרויקטים מרובי משתמשים.</li>
      <li>פיתוח כלי DevOps בסיסיים וניהול קוד באמצעות Git.</li>
    </ul>
    <p>אני שואף לכתיבת קוד קריא, ביצועים גבוהים ותכנון מדויק של מערכות מורכבות.</p>

    <form id="contact-shani">
      <label>הודעה לשני:</label><br>
      <textarea name="message" required style="width:80%; height:100px;"></textarea><br>
      <button type="submit">📩 שלח במייל</button>
    </form>
    <div id="message-status"></div>

    <hr style="margin-top:30px;">
    <button onclick="showFunFact()">🤓 הצג עובדה עם document.write()</button>

    <p style="margin-top:20px;"><a href="index.php">⏮ חזרה לחידון</a></p>
  </section>

  <footer style="margin-top:40px; text-align:center; font-size:0.9em;">
    <hr>
    <p>ליצירת קשר ישיר: <a href="mailto:SHANI@example.com">SHANI@example.com</a></p>
  </footer>

</body>
</html>
