<?php
// contact.php - עיצוב חדשני לטופס צור קשר
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>צור קשר – Guess the Jersey</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* תוספת קלה לשדרוג עיצוב פנימי, לא פוגעת ב־CSS הראשי */
    .form-section {
      background: linear-gradient(90deg, #e0f7fa 40%, #fff 100%);
      border-radius: 12px;
      padding: 22px 24px 12px 24px;
      margin-bottom: 16px;
      box-shadow: 0 2px 12px #4dd0e122;
      position: relative;
    }
    .form-section h3 {
      margin-top: 0;
      font-size: 1.18em;
      margin-bottom: 8px;
      color: #0097a7;
      text-shadow: 1px 1px 1px #eee;
    }
    .form-inline {
      display: flex;
      gap: 12px;
      align-items: center;
      margin-bottom: 0;
    }
    .form-inline input[type="color"] {
      padding: 2px;
      width: 38px;
      height: 38px;
      min-width: 38px;
      border: none;
    }
    .form-icon {
      font-size: 1.3em;
      margin-left: 4px;
      vertical-align: middle;
    }
    .divider {
      border-top: 1px solid #b2ebf2;
      margin: 20px 0;
    }
    .mini-tip {
      font-size: 0.92em;
      color: #009688;
      background: #e0f2f1;
      padding: 3px 8px;
      border-radius: 4px;
      margin-bottom: 8px;
      display: inline-block;
    }
  </style>
  <script>
    // (הקוד שלך נשאר)
    function greet(name) {
      return "שלום " + name + "! תודה שפנית אלינו.";
    }
    function handleNameInput() {
      const nameField = document.querySelector('input[name="name"]');
      const outputDiv = document.getElementById("js-output");
      if (nameField && outputDiv) {
        const name = nameField.value.trim();
        if (name !== "") {
          outputDiv.innerHTML = greet(name);
        } else {
          outputDiv.innerHTML = "";
        }
      }
    }
    function buildMailto(event) {
      event.preventDefault();
      const name = document.querySelector('input[name="name"]').value.trim();
      const email = document.querySelector('input[name="email"]').value.trim();
      const phone = document.querySelector('input[name="phone_example"]').value.trim();
      const website = document.querySelector('input[name="url_example"]').value.trim();
      const age = document.querySelector('input[name="number_example"]').value.trim();
      const color = document.querySelector('input[name="color_example"]').value.trim();
      const range = document.querySelector('input[name="range_example"]').value.trim();
      const birthdate = document.querySelector('input[name="date_example"]').value.trim();
      const time = document.querySelector('input[name="time_example"]').value.trim();
      const subject = document.querySelector('select[name="subject"]').value.trim();
      const message = document.querySelector('textarea[name="message"]').value.trim();
      const gender = document.querySelector('input[name="gender"]:checked');
      const genderValue = gender ? gender.value : "לא נבחר";
      const interestNodes = document.querySelectorAll('input[name="interests[]"]:checked');
      const interests = Array.from(interestNodes).map(el => el.value).join(', ') || "לא נבחרו";
      const hobby = document.querySelector('input[list="hobbies"]');
      const hobbyValue = hobby ? hobby.value.trim() : "";
      if (!name || !email || !message) {
        alert("יש למלא את כל שדות החובה: שם, אימייל והודעה.");
        return;
      }
      const fullSubject = encodeURIComponent("פנייה מ-" + name + " – " + subject);
      const body = encodeURIComponent(
        `שם: ${name}\n` +
        `אימייל: ${email}\n` +
        `טלפון: ${phone}\n` +
        `אתר: ${website}\n` +
        `גיל: ${age}\n` +
        `צבע אהוב: ${color}\n` +
        `שביעות רצון: ${range}/10\n` +
        `תאריך לידה: ${birthdate}\n` +
        `שעה מועדפת ליצירת קשר: ${time}\n` +
        `מין: ${genderValue}\n` +
        `תחומי עניין: ${interests}\n` +
        `תחביב: ${hobbyValue}\n` +
        `נושא ההודעה: ${subject}\n\n` +
        `הודעה:\n${message}`
      );
      const mailtoLink = `mailto:TTLLEIB@gmail.com?subject=${fullSubject}&body=${body}`;
      window.location.href = mailtoLink;
    }
    document.addEventListener("DOMContentLoaded", function () {
      const nameField = document.querySelector('input[name="name"]');
      if (nameField) {
        nameField.addEventListener("input", handleNameInput);
      }
      const form = document.getElementById("contact-form");
      if (form) {
        form.addEventListener("submit", buildMailto);
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
<div class="container">
  <h1>📬 צור קשר</h1>
  <p class="highlight-box">
    דף זה מיועד לפנייה לצוות המיזם – לשיתופי פעולה, שאלות או הצעות. נשמח לשמוע ממך!<br>
    <span class="mini-tip">🛡️ פרטיך ישמשו למענה בלבד – לא יועברו לגורמים חיצוניים.</span>
  </p>
  <div id="js-output"></div>
  <form id="contact-form" enctype="multipart/form-data" autocomplete="on">
    <div class="form-section">
  <h3>📝 פרטי קשר</h3>

  <label>
    <span class="form-icon">👤</span>
    שם מלא:
    <input type="text" name="name" required placeholder="הכנס שם מלא">
  </label>

  <label>
    <span class="form-icon">✉️</span>
    אימייל:
    <input type="email" name="email" required placeholder="you@example.com">
  </label>

  <label>
    <span class="form-icon">🔑</span>
    סיסמה:
    <input type="password" name="pass_example" autocomplete="off">
  </label>

  <div class="form-inline">
    <label style="margin:0">
      <span class="form-icon">📞</span>
      טלפון:
      <input type="tel" name="phone_example" placeholder="05x-xxxxxxx">
    </label>

    <label style="margin:0">
      <span class="form-icon">🌐</span>
      אתר:
      <input type="url" name="url_example" placeholder="https://">
    </label>
  </div>
</div>

<div class="form-section">
  <h3>👤 פרטים נוספים</h3>

  <div class="form-inline">
    <label style="margin:0">
      <span class="form-icon">🎂</span>
      גיל:
      <input type="number" name="number_example" min="0" max="120">
    </label>
    <label style="margin:0">
      <span class="form-icon">🎨</span>
      צבע אהוב:
      <input type="color" name="color_example" value="#60a3bc">
    </label>
  </div>

  <label>
    <span class="form-icon">😃</span>
    טווח שביעות רצון:
    <input type="range" name="range_example" min="0" max="10">
  </label>

  <div class="form-inline">
    <label style="margin:0">
      <span class="form-icon">📅</span>
      תאריך לידה:
      <input type="date" name="date_example">
    </label>
    <label style="margin:0">
      <span class="form-icon">⏰</span>
      שעה מועדפת ליצירת קשר:
      <input type="time" name="time_example">
    </label>
  </div>

  <label>
    <span class="form-icon">📎</span>
    קובץ מצורף:
    <input type="file" name="file_example">
  </label>
</div>

    <div class="form-section">
      <h3>💡 מה מעניין אותך?</h3>
      <label>
        <span class="form-icon">📄</span>נושא ההודעה:
        <select name="subject">
          <option>כללי</option>
          <option>תמיכה</option>
          <option>הצעות</option>
        </select>
      </label>
      <label>
        <span class="form-icon">🏅</span>תחביבים:
        <input list="hobbies" placeholder="הקלד תחביב">
        <datalist id="hobbies">
          <option value="כדורגל">
          <option value="כדורסל">
          <option value="טניס">
        </datalist>
      </label>
      <label>
        <span class="form-icon">🔎</span>בחר תחומי עניין:<br>
        <input type="checkbox" name="interests[]" value="ספורט"> ספורט
        <input type="checkbox" name="interests[]" value="טכנולוגיה"> טכנולוגיה
        <input type="checkbox" name="interests[]" value="מוזיקה"> מוזיקה
      </label>
      <label>
        <span class="form-icon">🚻</span>בחר מין:<br>
        <input type="radio" name="gender" value="זכר" required> זכר
        <input type="radio" name="gender" value="נקבה"> נקבה
        <input type="radio" name="gender" value="אחר"> אחר
      </label>
    </div>
    <div class="form-section">
      <h3>📨 תוכן ההודעה</h3>
      <label>
        <span class="form-icon">💬</span>הודעה:
        <textarea name="message" required placeholder="כתוב כאן את הודעתך..."></textarea>
      </label>
    </div>
    <div class="divider"></div>
    <button type="submit">📨 שלח הודעה</button>
  </form>
</div>
</body>
</html>
