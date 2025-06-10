Guess the Jersey – World Football Shirt Quiz
An interactive, Hebrew first trivia game where you guess the footballer by his jersey. Built as the final project for the Integrated Software Engineering Workshop at Ruppin Academic Center.
I do not claim for any rights about the photos.
________________________________________
🚀 Live Demo
A public demo is available here → <LIVE_URL_HERE> 
________________________________________
📦 Tech Stack
Layer	Tech
Front  end	HTML5 · CSS3 · Vanilla JS (ES6) · Responsive RTL design
Back end	PHP 8 · MySQL · Procedural style + PDO/MySQLi
Misc.	Mailto based contact form · PHP session management
________________________________________
🎮 Core Features
•	12 random questions per session – seeded so each player & team appears only once.
•	Manual score saving – your score is written to the database only when you click Save at the end.
•	Leaderboard – top 50 scores, ordered by score then by completion time.
•	Dual side statistics
o	Client side (JS): quick insights such as "how many players scored > 5".
o	Server side (PHP): average, median, min/max, standard deviation.
•	Average grade calculator – stand alone form (no DB) that demonstrates functions, arrays, loops & string utilities in PHP.
•	Dynamic contact form – mailto link built on the fly, with live Hebrew greeting.
•	Team & Reviews page – visitors can leave feedback, stored in MySQL.
•	Fully responsive & RTL friendly – works great on mobile.
________________________________________
🗂️ Project Structure
.
├── index.php           # Quiz engine & session flow
├── questions.php       # JSON API for random jerseys
├── submit_score.php    # Persists highscores
├── records.php         # Leaderboard + stats + calculator
├── contact.php         # Dynamic mailto contact form
├── team.php            # About, team bios & reviews
├── member1.php / member2.php
├── db_connect.php      # Central DB credentials
├── style.css           # Global styles (imported everywhere)
└── images/             # Jersey & UI assets
________________________________________
🛠️ Local Setup
1.	Prerequisites
o	PHP ≥ 8.1
o	MySQL/MariaDB 5.7+
o	Web server (Apache/Nginx) or PHP built in server
2.	Clone & install
git clone https://github.com/<YOUR_NAME>/guess-the-jersey.git
cd guess-the-jersey
3.	Create database & tables (simplified schema)
CREATE DATABASE jerseyquiz DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE jerseyquiz;

CREATE TABLE highscores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  score INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  player VARCHAR(100),
  team VARCHAR(100),
  year YEAR,
  number INT,
  image_url VARCHAR(255)
);
A seed file with 112+ jerseys is included in /sql/questions_seed.sql.
4.	Configure credentials
o	Copy db_connect.example.php → db_connect.php and set DB_HOST, DB_USER, DB_PASS, DB_NAME.
5.	Serve
php -S localhost:8000
Visit http://localhost:8000/ and start guessing!
________________________________________
🔌 API Endpoints
Endpoint	Method	Description
/questions.php?count=12	GET	Returns a JSON array of count random jerseys
/submit_score.php	POST	username, score – stores finished game
________________________________________
🧠 Algorithm Highlights
Creative Random Weighted Seeding
Each session generates a cryptographic seed that ensures:
•	No duplicate players or teams
•	Balanced distribution of eras (1990s – today)
•	Fair rotation of easy vs. hard jerseys
The seed is locked at game start, preventing reload skips or question farming.
________________________________________
Tal Leibovich 
