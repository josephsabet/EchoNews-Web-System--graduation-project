-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 10:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','author') NOT NULL DEFAULT 'author'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `username`, `email`, `phone`, `password`, `role`) VALUES
(3, 'vikytaxyg', 'dyrem@mailinator.com', '+1 (657) 548-3504', '$2y$10$rj.4iUSL4h8UGZQZdYlbO.n80v7Rq/lNWtjKbgD0BuOp.2Y5RVZoW', 'admin'),
(4, 'biqeni', 'ryqorezuwo@mailinator.com', '+1 (725) 144-4301', '$2y$10$1jBS0dpUQAzeXYgWPF7/B.egNWheRYqotzgGxHmHDgX2K9hEL9PF.', 'author'),
(5, 'lisypunos', 'hygyme@mailinator.com', '+1 (311) 714-9121', '$2y$10$KUwPJm2bcrUosHn24QaQ8upKob6c17l3F/dc42RrtYJ9x81cE6MxW', 'author'),
(9, 'ihab', 'tihab215@gmail.com', '+1 (579) 242-8552', '$2y$10$jwGHGHv7.JHFjq1z3vbK3.ul0GkO6eOleAznyjYzmV0G/OgPyDup.', 'admin'),
(11, 'mohamed', 'mohamed@gmail.com', '+1 (755) 658-9522', '$2y$10$j5VjpjKK/uGK2qGvKk4JGuiHOTAp3ycPcMKUcGAdoIvdXs/1pZqQe', 'author');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(4, 'Health'),
(10, 'Latest'),
(1, 'Politics'),
(12, 'popular'),
(2, 'Sports'),
(3, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `pendingauthors`
--

CREATE TABLE `pendingauthors` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` longblob NOT NULL,
  `author` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `image`, `author`, `date`, `category_id`) VALUES
(6, 'What Whiplash U.S. Climate Policy Means for Business', 'In his first weeks in office, President Donald Trump has sought to take a wrecking ball to climate and environmental policy. He has directed his administration to roll back a wide range of regulations and aims to undercut the agencies that enforce them by targeting staff.', 0x7472616d702e77656270, 'ihab', '2025-02-08 08:41:28', 1),
(8, 'Why Trump’s Threats to Canada Will Continue to Backfire', 'It felt inspiring even to me. I’m a Canadian citizen, but my relationship with Canada has been tenuous, given I grew up in Britain and work in the U.S. My cultural competence is only passable: I know the go-to order at Timmies (Tim Hortons) should be a double-double (coffee with two creams and two sugars). I know a loonie is a coin, a beaver tail is a fried pastry, and I can get by with kilometers and French. But at this moment, I’ve never felt more Canadian.', 0x43616e6164612d5072696d652d4d696e69737465722d4a757374696e2d547275646561752e77656270, 'ihab', '2025-02-08 09:25:46', 1),
(10, 'How Kendrick Lamar Went Pop in His Own Way', 'This performance, where much is unknown with the exception of SZA being a special guest performer, feels a bit like a coronation ceremony for what has been an incredible year for Lamar. From unequivocally winning the back-and-forth diss-track beef against Drake last summer, to hosting The Pop Out: Ken & Friends, a congratulatory concert held on Juneteenth in Inglewood, Calif., to releasing his fifth number-one album GNX, to his sweep at the Grammys, to now headlining one of the most prestigious stages in entertainment, Lamar has not-so-secretly been dominating not only rap music but also pop culture.', 0x6b656e647269636b2d6c616d61722d70726573732d636f6e666572656e63652d7375706572626f776c2d68616c6674696d652d323032352e77656270, 'ihab', '2025-02-09 12:13:11', 2),
(11, 'Cecile Richards Never Flinched', 'Once the rally finally started, Cecile’s speech–punctuated with off-the-cuff jokes–drew a standing ovation. Afterward, we all decamped to a local bar where Cecile proceeded to transform it into a war room leading the pushback against the resurfaced claims of improperly handled email servers. That was Cecile in a nutshell: equal parts beloved doyenne and four-star general inspiring the people to take on the causes she loved. Cecile, who died Monday at 67 after a battle with brain cancer, loved a lot of people, and boy, did the people love her.', 0x436563696c652d52696368617264732e77656270, 'ihab', '2025-02-09 12:14:25', 10),
(12, 'Best Cinderella Story: Doechii', 'Doechii joined the ranks of just two female emcees before her—Lauryn Hill and Cardi B, the latter of whom presented the award—when she won for Best Rap Album for her mixtape “Alligator Bites Never Heal.” The 26-year-old singer and rapper from Tampa, Fla., known for her clever use of irony and unapologetic storytelling, has quickly proven herself to be a strong addition to T.D.E.’s star-studded roster with breakout hits like “What It is (Block Boy),” “Persuasive,” and “Denial is a River.” “God told me that I would be rewarded and he would show me just how good it can get,” Doechii said as she accepted her award, joined by her mother onstage. “I know that there are so many Black women out there watching me right now and I just want to say you can do it…don’t allow anybody to project any stereotypes on you…I am a testimony.” Later on in the evening, Doechii delivered a powerfully free-spirited performance of “Denial is a River,” her tongue-in-cheek breakout single from the project she won the award for.', 0x4765747479496d616765732d323139373331383739342e77656270, 'ihab', '2025-02-09 12:17:34', 3),
(13, 'West  Point Point Disbands Cadet Clubs Following Trump’s ', 'The memo, issued in accordance with President Donald Trump’s executive orders cracking down on diversity, equity, and inclusion (DEI) programs and offices across the federal government, instructs 12 specific clubs to immediately cease all formal and informal activities and remove public facing content. The move comes after the U.S. Army and Air Force shuttered their respective DEI offices and programs and removed related media and trainings on Jan. 23.', 0x776573742d706f696e742d6361646574732e77656270, 'ihab', '2025-02-09 12:19:30', 1),
(16, '‘It’s Beyond Repair’: Elon Musk Says Trump Has', 'His comments come after the administration placed two top security chiefs at USAID on leave after they refused to turn over classified material in restricted areas to Musk’s government-inspection teams, a current and a former U.S. official told the Associated Press on Sunday.', 0x656c6f6e2d6d75736b2d75736169642e77656270, 'ihab', '2025-02-10 17:29:42', 3),
(17, '‘It’s Beyond Repair’: Elon Musk Says Trump Has', 'His comments come after the administration placed two top security chiefs at USAID on leave after they refused to turn over classified material in restricted areas to Musk’s government-inspection teams, a current and a former U.S. official told the Associated Press on Sunday.', 0x43616e6164612d5072696d652d4d696e69737465722d4a757374696e2d547275646561752e77656270, 'mohamed', '2025-02-10 17:34:11', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `pendingauthors`
--
ALTER TABLE `pendingauthors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pendingauthors`
--
ALTER TABLE `pendingauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
