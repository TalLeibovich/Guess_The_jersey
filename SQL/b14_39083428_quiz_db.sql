-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql311.byethost14.com
-- Generation Time: יוני 10, 2025 בזמן 08:53 AM
-- גרסת שרת: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b14_39083428_quiz_db`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `highscores`
--

CREATE TABLE `highscores` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `quiz_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- הוצאת מידע עבור טבלה `highscores`
--

INSERT INTO `highscores` (`id`, `username`, `score`, `quiz_date`) VALUES
(0, 'tulleib2025', 11, '2025-06-09 07:40:57'),
(0, 'tal2212', 9, '2025-06-10 05:44:42');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `questions`
--

CREATE TABLE `questions` (
  `id` int(11) DEFAULT NULL,
  `player` text NOT NULL,
  `team` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `number` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- הוצאת מידע עבור טבלה `questions`
--

INSERT INTO `questions` (`id`, `player`, `team`, `year`, `number`, `image_url`) VALUES
(NULL, 'Lionel Messi', 'Paris Saint-Germain', 2022, 30, 'images/messi.jpg'),
(NULL, 'Cristiano Ronaldo', 'Manchester United', 2022, 7, 'images/ronaldo.jpg'),
(NULL, 'Kevin De Bruyne', 'Manchester City', 2024, 17, 'images/debruyne.jpg'),
(NULL, 'Robert Lewandowski', 'Barcelona', 2023, 9, 'images/lewandowski.jpg'),
(NULL, 'Lionel Messi', 'Barcelona', 2015, 10, 'images/messi.jpg'),
(NULL, 'Lionel Messi', 'Inter Miami', 2024, 10, 'images/messi.jpg'),
(NULL, 'Cristiano Ronaldo', 'Real Madrid', 2009, 9, 'images/ronaldo.jpg'),
(NULL, 'Cristiano Ronaldo', 'Real Madrid', 2012, 7, 'images/ronaldo.jpg'),
(NULL, 'Cristiano Ronaldo', 'Al-Nassr', 2023, 7, 'images/ronaldo.jpg'),
(NULL, 'Kylian Mbappé', 'Monaco', 2016, 29, 'images/mbappe.jpg'),
(NULL, 'Kylian Mbappé', 'Real Madrid', 2025, 9, 'images/mbappe.jpg'),
(NULL, 'Kevin De Bruyne', 'Wolfsburg', 2014, 14, 'images/debruyne.jpg'),
(NULL, 'Kevin De Bruyne', 'Chelsea', 2013, 15, 'images/debruyne.jpg'),
(NULL, 'Robert Lewandowski', 'Borussia Dortmund', 2012, 9, 'images/lewandowski.jpg'),
(NULL, 'Robert Lewandowski', 'Bayern Munich', 2020, 9, 'images/lewandowski.jpg'),
(NULL, 'Alex', 'Chelsea', 2009, 33, 'images/Alex.jpg'),
(NULL, 'Michael Ballack', 'Chelsea', 2006, 13, 'images/Ballack.jpg'),
(NULL, 'Thierry Henry', 'Arsenal', 2004, 14, 'images/Henry.jpg'),
(NULL, 'David Silva', 'Manchester City', 2012, 21, 'images/DavidSilva.jpg'),
(NULL, 'Yaya Touré', 'Manchester City', 2013, 42, 'images/Yaya.jpg'),
(NULL, 'Martin Škrtel', 'Liverpool', 2010, 37, 'images/Skrtel.jpg'),
(NULL, 'Raúl', 'Real Madrid', 2001, 7, 'images/Raul.jpg'),
(NULL, 'Raul Meireles', 'Chelsea', 2012, 16, 'images/Meireles.jpg'),
(NULL, 'Salomon Kalou', 'Chelsea', 2010, 21, 'images/Kalu.jpg'),
(NULL, 'Florent Malouda', 'Chelsea', 2010, 15, 'images/Malouda.jpg'),
(NULL, 'Frank Lampard', 'Chelsea', 2005, 8, 'images/Lampard.jpg'),
(NULL, 'Oscar', 'Chelsea', 2013, 11, 'images/Oscar.jpg'),
(NULL, 'Eden Hazard', 'Chelsea', 2015, 10, 'images/Hazard.jpg'),
(NULL, 'John Terry', 'Chelsea', 2010, 26, 'images/Terry.jpg'),
(NULL, 'Fernando Torres', 'Chelsea', 2012, 9, 'images/Torres.jpg'),
(NULL, 'Didier Drogba', 'Chelsea', 2010, 11, 'images/Drogba.jpg'),
(NULL, 'Thomas Müller', 'Germany', 2014, 13, 'images/Germany2014.jpg'),
(NULL, 'Manuel Neuer', 'Germany', 2014, 1, 'images/Germany2014.jpg'),
(NULL, 'Mesut Özil', 'Germany', 2014, 8, 'images/Germany2014.jpg'),
(NULL, 'Kylian Mbappé', 'France', 2018, 10, 'images/France2018.jpg'),
(NULL, 'Antoine Griezmann', 'France', 2018, 7, 'images/France2018.jpg'),
(NULL, 'Paul Pogba', 'France', 2018, 6, 'images/France2018.jpg'),
(NULL, 'Lionel Messi', 'Argentina', 2022, 10, 'images/Argentina2022.jpg'),
(NULL, 'Julián Álvarez', 'Argentina', 2022, 9, 'images/Argentina2022.jpg'),
(NULL, 'Ángel Di María', 'Argentina', 2022, 11, 'images/Argentina2022.jpg'),
(NULL, 'Giorgio Chiellini', 'Italy', 2020, 3, 'images/Italy2020.jpg'),
(NULL, 'Leonardo Bonucci', 'Italy', 2020, 19, 'images/Italy2020.jpg'),
(NULL, 'Eran Zahavi', 'Israel', 2020, 7, 'images/Israel.jpg'),
(NULL, 'Bibras Natcho', 'Israel', 2020, 6, 'images/Israel.jpg'),
(NULL, 'Alex', 'Chelsea', 2010, 33, 'images/Alex.jpg'),
(NULL, 'Ballack', 'Chelsea', 2008, 13, 'images/Ballack.jpg'),
(NULL, 'Ballack', 'Germany', 2006, 13, 'images/Ballack.jpg'),
(NULL, 'Henry', 'France', 2006, 12, 'images/Henry.jpg'),
(NULL, 'David Silva', 'Manchester City', 2015, 21, 'images/DavidSilva.jpg'),
(NULL, 'Yaya', 'Manchester City', 2014, 42, 'images/Yaya.jpg'),
(NULL, 'Skrtel', 'Liverpool', 2013, 37, 'images/Skrtel.jpg'),
(NULL, 'Raul', 'Real Madrid', 2002, 7, 'images/Raul.jpg'),
(NULL, 'Raul', 'Spain', 2002, 7, 'images/Raul.jpg'),
(NULL, 'Meireles', 'Portugal', 2012, 16, 'images/Meireles.jpg'),
(NULL, 'Kalu', 'Chelsea', 2011, 21, 'images/Kalu.jpg'),
(NULL, 'Malouda', 'France', 2010, 15, 'images/Malouda.jpg'),
(NULL, 'Lampard', 'Chelsea', 2006, 8, 'images/Lampard.jpg'),
(NULL, 'Lampard', 'England', 2006, 8, 'images/Lampard.jpg'),
(NULL, 'Oscar', 'Chelsea', 2014, 11, 'images/Oscar.jpg'),
(NULL, 'Oscar', 'Brazil', 2014, 11, 'images/Oscar.jpg'),
(NULL, 'Hazard', 'Chelsea', 2016, 10, 'images/Hazard.jpg'),
(NULL, 'Hazard', 'Belgium', 2018, 10, 'images/Hazard.jpg'),
(NULL, 'Terry', 'Chelsea', 2011, 26, 'images/Terry.jpg'),
(NULL, 'Terry', 'England', 2006, 6, 'images/Terry.jpg'),
(NULL, 'Torres', 'Chelsea', 2013, 9, 'images/Torres.jpg'),
(NULL, 'Torres', 'Spain', 2010, 9, 'images/Torres.jpg'),
(NULL, 'Drogba', 'Chelsea', 2010, 11, 'images/Drogba.jpg'),
(NULL, 'Drogba', 'Ivory Coast', 2010, 11, 'images/Drogba.jpg'),
(NULL, 'Thomas Müller', 'Germany', 2014, 13, 'images/Germany2014.jpg'),
(NULL, 'Manuel Neuer', 'Germany', 2014, 1, 'images/Germany2014.jpg'),
(NULL, 'Mesut Özil', 'Germany', 2014, 8, 'images/Germany2014.jpg'),
(NULL, 'Toni Kroos', 'Germany', 2014, 18, 'images/Germany2014.jpg'),
(NULL, 'Mats Hummels', 'Germany', 2014, 5, 'images/Germany2014.jpg'),
(NULL, 'Miroslav Klose', 'Germany', 2014, 11, 'images/Germany2014.jpg'),
(NULL, 'Philipp Lahm', 'Germany', 2014, 16, 'images/Germany2014.jpg'),
(NULL, 'Kylian Mbappé', 'France', 2018, 10, 'images/France2018.jpg'),
(NULL, 'Antoine Griezmann', 'France', 2018, 7, 'images/France2018.jpg'),
(NULL, 'Paul Pogba', 'France', 2018, 6, 'images/France2018.jpg'),
(NULL, 'Raphaël Varane', 'France', 2018, 4, 'images/France2018.jpg'),
(NULL, 'Hugo Lloris', 'France', 2018, 1, 'images/France2018.jpg'),
(NULL, 'N\'Golo Kanté', 'France', 2018, 13, 'images/France2018.jpg'),
(NULL, 'Lucas Hernández', 'France', 2018, 21, 'images/France2018.jpg'),
(NULL, 'Lionel Messi', 'Argentina', 2022, 10, 'images/Argentina2022.jpg'),
(NULL, 'Ángel Di María', 'Argentina', 2022, 11, 'images/Argentina2022.jpg'),
(NULL, 'Julián Álvarez', 'Argentina', 2022, 9, 'images/Argentina2022.jpg'),
(NULL, 'Emiliano Martínez', 'Argentina', 2022, 23, 'images/Argentina2022.jpg'),
(NULL, 'Enzo Fernández', 'Argentina', 2022, 24, 'images/Argentina2022.jpg'),
(NULL, 'Rodrigo De Paul', 'Argentina', 2022, 7, 'images/Argentina2022.jpg'),
(NULL, 'Nicolás Otamendi', 'Argentina', 2022, 19, 'images/Argentina2022.jpg'),
(NULL, 'Giorgio Chiellini', 'Italy', 2020, 3, 'images/Italy2020.jpg'),
(NULL, 'Leonardo Bonucci', 'Italy', 2020, 19, 'images/Italy2020.jpg'),
(NULL, 'Federico Chiesa', 'Italy', 2020, 14, 'images/Italy2020.jpg'),
(NULL, 'Gianluigi Donnarumma', 'Italy', 2020, 21, 'images/Italy2020.jpg'),
(NULL, 'Marco Verratti', 'Italy', 2020, 6, 'images/Italy2020.jpg'),
(NULL, 'Lorenzo Insigne', 'Italy', 2020, 10, 'images/Italy2020.jpg'),
(NULL, 'Jorginho', 'Italy', 2020, 8, 'images/Italy2020.jpg'),
(NULL, 'Eran Zahavi', 'Israel', 2020, 7, 'images/Israel.jpg'),
(NULL, 'Bibras Natcho', 'Israel', 2020, 6, 'images/Israel.jpg'),
(NULL, 'Manor Solomon', 'Israel', 2021, 10, 'images/Israel.jpg'),
(NULL, 'Eli Dasa', 'Israel', 2020, 2, 'images/Israel.jpg'),
(NULL, 'Ofir Marciano', 'Israel', 2020, 1, 'images/Israel.jpg'),
(NULL, 'Shon Weissman', 'Israel', 2021, 9, 'images/Israel.jpg'),
(NULL, 'Neta Lavi', 'Israel', 2020, 6, 'images/Israel.jpg');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `Review`
--

CREATE TABLE `Review` (
  `name` varchar(20) NOT NULL,
  `review` text NOT NULL,
  `stars` int(11) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- הוצאת מידע עבור טבלה `Review`
--

INSERT INTO `Review` (`name`, `review`, `stars`, `grade`) VALUES
('×™×¨×•×Ÿ', '×œ× ×¤×©×•×˜ ×‘×›×œ×œ', 5, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
