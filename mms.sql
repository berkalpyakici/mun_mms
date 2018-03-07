SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) UNSIGNED NOT NULL,
  `applicant` int(11) NOT NULL,
  `conference` int(11) NOT NULL,
  `time_applied` varchar(32) NOT NULL DEFAULT '',
  `removed` int(1) NOT NULL,
  `formreceived` int(11) NOT NULL,
  `advisor` int(11) NOT NULL,
  `advisor_locked` int(11) NOT NULL,
  `recommendation` varchar(128) NOT NULL DEFAULT '',
  `recommendation_submitter` int(11) NOT NULL,
  `time_reco` varchar(32) NOT NULL DEFAULT '',
  `documents` int(1) NOT NULL,
  `time_docs` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE `conferences` (
  `id` int(16) NOT NULL,
  `name` varchar(128) NOT NULL DEFAULT '',
  `date` varchar(128) NOT NULL DEFAULT '',
  `host` varchar(128) NOT NULL DEFAULT '',
  `duration` varchar(128) NOT NULL DEFAULT '',
  `country` varchar(32) NOT NULL DEFAULT '',
  `city` varchar(128) NOT NULL DEFAULT '',
  `independent` int(1) NOT NULL,
  `removed` int(1) NOT NULL,
  `date_reco` varchar(128) NOT NULL DEFAULT '',
  `date_app` varchar(128) NOT NULL DEFAULT '',
  `date_docs` varchar(128) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `setting` varchar(32) NOT NULL DEFAULT '',
  `value` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting`, `value`) VALUES
(1, 'maxinapp', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(32) UNSIGNED NOT NULL,
  `email` varchar(128) NOT NULL,
  `hash` varchar(256) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `type` varchar(32) NOT NULL,
  `class` int(4) NOT NULL,
  `avatar` varchar(128) NOT NULL DEFAULT 'default.jpg',
  `mobile` varchar(128) NOT NULL,
  `address` varchar(256) NOT NULL,
  `mother_fullname` varchar(128) NOT NULL,
  `mother_email` varchar(128) NOT NULL,
  `mother_mobile` varchar(128) NOT NULL,
  `father_fullname` varchar(128) NOT NULL,
  `father_email` varchar(128) NOT NULL,
  `father_mobile` varchar(128) NOT NULL,
  `prev_gpa` varchar(32) NOT NULL,
  `prev_english` varchar(32) NOT NULL,
  `removed` int(1) NOT NULL,
  `officenumber` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `hash`, `fullname`, `type`, `class`, `avatar`, `mobile`, `address`, `mother_fullname`, `mother_email`, `mother_mobile`, `father_fullname`, `father_email`, `father_mobile`, `prev_gpa`, `prev_english`, `removed`, `officenumber`) VALUES
(1, 'advisor@mms.com', '$2a$10$eyDo942VCLlC9oD4hp.YQuvaK2201K/m1ZqzVyVJHd2I7eCetfFu2', 'Advisor Demo', 'advisor', 0, 'default.jpg', '', '', '', '', '', '', '', '', '', '', 0, ''),
(2, 'member@mms.com', '$2a$10$eyDo942VCLlC9oD4hp.YQuvaK2201K/m1ZqzVyVJHd2I7eCetfFu2', 'Member Demo', 'member', 2021, 'default.jpg', '', '', '', '', '', '', '', '', '', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conferences`
--
ALTER TABLE `conferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conferences`
--
ALTER TABLE `conferences`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(32) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
