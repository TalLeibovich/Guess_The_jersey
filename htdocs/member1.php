<?php
// member1.php
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>טל ליבוביץ – Guess the Jersey</title>
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
      const name = "טל ליבוביץ";
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
      const mailtoLink = `mailto:TTLLEIB@gmail.com?subject=${subject}&body=${body}`;
      window.location.href = mailtoLink;
    }

    document.addEventListener("DOMContentLoaded", function () {
      const form = document.getElementById("contact-tal");
      if (form) {
        form.addEventListener("submit", sendMessage);
      }

      // אינטראקציה עם המשתמש
      const wantsToSee = confirm("האם תרצה לגלות עובדה מעניינת על טל?");
      if (wantsToSee) {
        const adjective = prompt("איך היית מתאר את טל במילה אחת?");
        if (adjective) {
          const facts = [
            "פיתח מערכת חידון מתקדמת ב-PHP ו־MySQL",
            "זכה במקום שלישי עם רובוט Arduino כבודד מול צוותים",
            "לא ישן עד שהקוד עובד כמו שצריך"
          ];
          const chosen = facts[Math.floor(Math.random() * facts.length)];
          const decoratedFact = `טל הוא ${adjective}! ${chosen}`;
          alert(decoratedFact);
        } else {
          alert("לא נורא, אולי בפעם הבאה!");
        }
      }

      // שימוש במערך ומחרוזת – עובדה קבועה שמוצגת בעמוד
      const factsAlways = [
        "טל התחיל לתכנת כבר בכיתה ט׳",
        "הוא אוהב פתרון בעיות מורכבות",
        "מתמחה גם באבטחת מידע",
        "חובב כדורגל מושבע"
      ];
      const index = Math.floor(Math.random() * factsAlways.length);
      const factMessage = "🧠 עובדה על טל: " + factsAlways[index];
      document.getElementById("fact-output").innerText = factMessage;
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
    <h1>טל ליבוביץ</h1>
    <img src="tal.jpg" alt="תמונת פרופיל של טל ליבוביץ" style="max-width:250px; border-radius:8px;">
    
    <p>
      אני טל ליבוביץ, סטודנט להנדסת תוכנה ברופין ומפתח Full Stack.  
      אני עוסק בפיתוח אתרי אינטרנט מבוססי HTML, CSS, JavaScript, PHP ו-MySQL עם דגש על עיצוב רספונסיבי, ביצועים ונגישות.<br><br>
      במסגרת לימודיי הובלתי פרויקטים מתקדמים:
    </p>
    <ul style="text-align:right; direction:rtl; max-width:500px; margin: 0 auto;">
      <li>בניית רובוט מבוסס Arduino, זכייה במקום השלישי מבין מעל 20 קבוצות – כיחיד מול צוותים של ארבעה.</li>
      <li>פרויקט ליגת כדורגל ב-Java עם שימוש ב-OOP, תור, מחסנית ומבני נתונים.</li>
      <li>מימוש אלגוריתם Naive Bayes ב-Python כולל ויזואליזציה של תמונות MNIST.</li>
      <li>פתרון מעבדות בקורסים כמו מערכות הפעלה, SystemVerilog, SPICE ועוד.</li>
    </ul>
    <p>אני שואף למצוינות, דייקנות וחשיבה יצירתית – גם תחת לחץ.</p>

    <div id="fact-output" style="margin-top:20px; color:#4CAF50; font-weight:bold;"></div>

    <!-- טופס לשליחת הודעה -->
    <form id="contact-tal">
      <label>הודעה לטל:</label><br>
      <textarea name="message" required style="width:80%; height:100px;"></textarea><br>
      <button type="submit">📩 שלח במייל</button>
    </form>
    <div id="message-status"></div>

    <p style="margin-top:20px;"><a href="index.php">⏮ חזרה לחידון</a></p>
  </section>

  <footer style="margin-top:40px; text-align:center; font-size:0.9em;">
    <hr>
    <p>ליצירת קשר ישיר: <a href="mailto:TTLLEIB@gmail.com">TTLLEIB@gmail.com</a></p>
  </footer>

</body>
</html>
