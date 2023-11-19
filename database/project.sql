-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-10-12 07:17:02
-- 服务器版本： 8.0.32
-- PHP 版本： 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `project`
--

-- --------------------------------------------------------

--
-- 表的结构 `Courses`
--

CREATE TABLE `Courses` (
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `Courses`
--

INSERT INTO `Courses` (`name`) VALUES
('CSSE7003'),
('CSSE7023'),
('CSSE7201'),
('DECO7140'),
('DECO7250'),
('INFS7202'),
('INFS7208'),
('INFS7900');

-- --------------------------------------------------------

--
-- 表的结构 `Image`
--

CREATE TABLE `Image` (
  `id` int UNSIGNED NOT NULL,
  `image_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `Image`
--

INSERT INTO `Image` (`id`, `image_name`) VALUES
(1, '1684083001_35005c4ccfdfc662666d.jpeg'),
(2, '1684297365_ad8bde7b6e24029b3328.jpeg');

-- --------------------------------------------------------

--
-- 表的结构 `Posts`
--

CREATE TABLE `Posts` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(20) NOT NULL,
  `author` varchar(20) NOT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `course_name` varchar(15) NOT NULL,
  `starred` tinyint(1) NOT NULL DEFAULT '0',
  `likes` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `Posts`
--

INSERT INTO `Posts` (`id`, `title`, `category`, `author`, `content`, `created_at`, `course_name`, `starred`, `likes`) VALUES
(67, 'This is a new post', 'Social', 'yueqi', 'In Harry’s world fate works not only through powers and objects such as prophecies, the Sorting Hat, wands, and the Goblet of Fire, but also through people. Repeatedly, other characters decide Harry’s future for him, depriving him of freedom and choice. For example, before his eleventh birthday, the Dursleys control Harry’s life, keeping from him knowledge of his past and understanding of his identity (Sorcerer’s 49). In Harry Potter and the Chamber of Secrets, Dobby repeatedly assumes control over events by intercepting Ron’s and Hermione’s letters during the summer; by sealing the barrier to Platform 93⁄4, causing Harry to miss the Hogwarts Express; and by sending a Bludger after Harry in a Quidditch match, breaking his wrist. Yet again, in Harry Potter and the Prisoner of Azkaban, many adults intercede while attempting to protect Harry from perceived danger, as Snape observes: “Everyone from the Minister of Magic downward has been trying to keep famous Harry Potter safe from Sirius Black” (284). All these characters, as enactors of fate, unknowingly drive Harry toward his destiny by attempting to control or to direct his life, while themselves controlled and directed by fate.\r\n\r\n—Julia Pond, “A Story of the Exceptional: Fate and Free Will in the Harry Potter Series”', '2023-05-14 17:16:03', 'CSSE7201', 0, 0),
(68, 'Post in 7140', 'General', 'yueqi', 'Our typology is built on three dimensions: internality, types of participants, and the degree of effective resistance. For our study, a civil war is any armed conflict that involves (a) military action internal to the metropole, (b) the active participation of the national government, and (c) effective resistance by both sides. With these criteria, we differentiate civil wars from other types of internal violent conflicts.\r\n\r\n—Melvin Small and J. David Singer, Resort to Arms: International and Civil Wars, 1816–1980', '2023-04-28 01:35:59', 'DECO7140', 0, 0),
(69, 'Hello everyone', 'Assignment', 'yueqi', 'This study was a preliminary study of high school student value changes because of the terrorist attack on the U.S. The major limitations of this study were that the student population was from California and might not truly represent all high school students in the U.S. Further, this study could not be considered a truly longitudinal study because of privacy issues that prevented the researchers from identifying all the students who returned surveys before the attack. In addition, the senior class had graduated the previous year, and a much larger freshman class entered the school. These issues not only made the samples similar, but also different in their composition. The researchers will conduct periodic studies to explore whether these value changes are permanent and continue into adulthood. We do not know what if any changes will take place in their values as they grow older, and we will continue to explore their values in our longitudinal studies of the impact of the 9/11 terrorist attacks.\r\n\r\n—Edward F. Murphy, et al., “9/11 Impact on Teenage Values”', '2023-04-28 01:36:22', 'DECO7250', 0, 0),
(70, 'Post', 'Lecture', 'yueqi', 'It’s perhaps not surprising that Marshall McLuhan, the most influential communications expert of the twentieth century, was a Canadian. As a nation, we have been preoccupied with forging communication links among a sparse, widespread population. The old Canadian one-dollar bill, with its line of telephone poles receding to the distant horizon, illustrates this preoccupation. Year after year we strive to maintain a national radio and television broadcasting system in the face of foreign competition. We have been aggressive in entering the international high technology market with our telecommunications equipment.\r\n\r\n—Margot Northey, Impact: A Guide to Business Communication', '2023-04-28 01:36:51', 'INFS7202', 0, 0),
(71, 'New post', 'Other', 'yoki', 'Minois concluded his overview by suggesting that old age was something “which the early Middle Ages were decidedly not concerned about” (1989: 155). This lack of concern was not because of the absence of old people, for Minois believed that “once they had survived to their 20th year, the men [sic] . . . could expect to live as long as we do” (1989: 149). Rather, he suggested, old people “played only a negligible social role and were dependent on the care of their families”—in effect they were marginalised by the society of the time (1989: 149).\r\n\r\n—Chris Gilleard, “Old Age in the Dark Ages”', '2023-05-21 18:28:47', 'CSSE7023', 0, 1),
(72, 'About paragraphs', 'Exam', 'yoki', 'In brief, the mummification process may be summarized as follows: extract, sterilize, dehydrate, perfume, seal, tag, and stock. All were done ceremoniously and with due respect to the dead body. The viscera were extracted through an incision about 10 inches long, usually made in the left side of the abdomen. Through this incision, all the “floating” contents of the abdominal cavity, namely, the stomach, the liver, the spleen, and the intestines, were removed but the kidneys were left in place. The diaphragm was then cut and the thoracic contents removed through the abdominal incision. The heart, which was considered the center of emotions and the seat of conscience, was left in place. The ancient Egyptians seem to have attached no importance to the brain, which was removed through the ethmoid bone. Following these extractions began the slow process of sterilization and dehydration of the body, accomplished by osmosis with dry natron. Resterilization of the cavities, perfuming, closing the incision, and wrapping the body with linen and with beeswax completed the process. Molten resin was used to seal the body and its wrappings, providing a barrier against insects and anaerobes.\r\n\r\n—Adapted from Mohamed E. Salem and Garabed Eknoyan, “The Kidney in Ancient Egyptian Medicine: Where Does it Stand?”', '2023-04-28 01:45:49', 'CSSE7003', 0, 0),
(73, 'qualification paragraph', 'Lecture', 'yoki', 'This study was a preliminary study of high school student value changes because of the terrorist attack on the U.S. The major limitations of this study were that the student population was from California and might not truly represent all high school students in the U.S. Further, this study could not be considered a truly longitudinal study because of privacy issues that prevented the researchers from identifying all the students who returned surveys before the attack. In addition, the senior class had graduated the previous year, and a much larger freshman class entered the school. These issues not only made the samples similar, but also different in their composition. The researchers will conduct periodic studies to explore whether these value changes are permanent and continue into adulthood. We do not know what if any changes will take place in their values as they grow older, and we will continue to explore their values in our longitudinal studies of the impact of the 9/11 terrorist attacks.\r\n\r\n—Edward F. Murphy, et al., “9/11 Impact on Teenage Values”', '2023-04-28 01:46:14', 'INFS7208', 0, 0),
(74, 'analysis or classification paragraph ', 'Other', 'yoki', 'Policies of privatisation should be considered as responses to several distinct pressures. First, privatisation is a response by the state to internal forces such as increasing fiscal problems (O’Connor, 1973). It provides a means of lessening the state’s fiscal responsibilities by encouraging the development of private alternatives which, theoretically at least, do not draw upon the state’s financial reserves. Second, the promotion of private sector activity is a response to pressures originating ‘outside’ the state apparatus. These include demands from people who see a large state bureaucracy as inefficient and wasteful, demands from business interests who claim that they can overcome these inefficiencies, and pressures from client groups who seek to reduce their dependency on the welfare state by having more control over the services on which they depend. Clearly, this variety of calls for privatisation means that it is not a process with a uniform outcome; there exists a correspondingly wide variety of forms of privatisation.\r\n\r\n—Adapted from Glenda Laws, “Privatisation and the Local Welfare State”', '2023-04-28 01:46:38', 'INFS7900', 0, 0),
(75, 'df', 'Social', 'yoki', 'ggg', '2023-05-22 02:13:57', 'INFS7202', 0, 1),
(76, 'Hello everyone, this is a new post title', 'General', 'yoki', '1', '2023-05-02 02:03:38', 'DECO7250', 0, 0),
(77, 'Hello everyone, this is a new post title Hello everyone, this is a new post title', 'Assignment', 'yoki', 'v', '2023-05-06 03:22:26', 'CSSE7201', 0, 0),
(78, 'Hello everyone, this is a new post titlesdfsja;slidfj;adf', 'Lecture', 'yoki', 'd', '2023-05-14 10:07:59', 'CSSE7023', 0, 2),
(79, 'lalalad', 'Exam', 'yoki', 'hahha', '2023-07-28 08:35:36', 'CSSE7201', 0, 0),
(107, '3', 'General', 'yoki', '3', '2023-05-14 09:13:19', 'CSSE7023', 0, 0),
(108, '4', 'Social', 'yoki', '4', '2023-05-13 20:30:26', 'CSSE7023', 0, 0),
(109, 'profile photo', 'Other', 'yoki', '1', '2023-05-14 17:04:27', 'CSSE7201', 0, 0),
(110, 'try', 'Social', 'yoki', '4', '2023-05-15 04:23:55', 'CSSE7023', 0, 0),
(111, 'About general', 'General', 'yueqi', 'About general', '2023-05-17 07:00:02', 'INFS7202', 0, 0),
(112, 'About social', 'Social', 'yueqi', 'About social', '2023-05-17 07:00:17', 'INFS7202', 0, 0),
(113, 'About exam', 'Exam', 'yueqi', 'About exam', '2023-05-17 07:00:27', 'INFS7202', 0, 0),
(114, 'About assignment', 'Assignment', 'yueqi', 'About assignment', '2023-05-17 07:00:37', 'INFS7202', 0, 0),
(115, 'About lecture', 'Lecture', 'yueqi', 'About lecture', '2023-05-17 07:00:45', 'INFS7202', 0, 0),
(116, 'About other', 'Other', 'yueqi', 'About other', '2023-05-17 07:00:57', 'INFS7202', 0, 0),
(117, 'how to implement the basic feature', 'Assignment', 'yueqi', 'how to implement the basic feature', '2023-05-17 07:01:35', 'INFS7202', 0, 0),
(118, 'how to implement the feature using google api', 'General', 'yueqi', 'how to implement the feature using google api', '2023-05-17 07:02:04', 'INFS7202', 0, 0),
(119, 'how to implement the advanced feature using', 'Assignment', 'yueqi', 'how to implement the advanced feature using', '2023-05-17 07:02:36', 'INFS7202', 0, 0),
(120, 'Question about lecture', 'Lecture', 'yueqi', 'Question about lecture', '2023-05-17 07:03:05', 'INFS7202', 0, 0),
(121, 'Question about exam', 'Exam', 'yueqi', 'Question about exam', '2023-05-17 07:03:17', 'INFS7202', 0, 0),
(122, 'General question', 'General', 'yueqi', 'General question', '2023-05-17 07:03:35', 'INFS7202', 0, 0),
(123, 'Social question', 'Social', 'yueqi', 'Social question', '2023-05-17 07:04:14', 'INFS7202', 0, 0),
(124, 'Exam question', 'Exam', 'yueqi', 'Exam question', '2023-05-17 07:04:22', 'INFS7202', 0, 0),
(125, 'Assignement question', 'Assignment', 'yueqi', 'Assignement question', '2023-05-17 07:04:34', 'INFS7202', 0, 0),
(126, 'Other question', 'Other', 'yueqi', 'Other question', '2023-05-17 07:04:42', 'INFS7202', 0, 0),
(127, 'When', 'Social', 'yueqi', 'When', '2023-05-17 07:05:03', 'INFS7202', 0, 0),
(128, 'Generate SMS Api', 'Assignment', 'yueqi', 'Generate SMS Api', '2023-05-17 07:05:18', 'INFS7202', 0, 0),
(129, 'Category post', 'Assignment', 'yueqi', 'Category post', '2023-05-17 07:05:35', 'INFS7202', 0, 0),
(130, 'Maintain scrolling position', 'Lecture', 'yueqi', 'Maintain scrolling position', '2023-05-17 07:06:35', 'INFS7202', 0, 0),
(131, 'Semester break', 'Social', 'yueqi', 'Semester break', '2023-05-17 07:07:09', 'INFS7202', 0, 0),
(132, 'Fixing problem', 'Other', 'yueqi', 'Fixing problem', '2023-05-17 07:07:28', 'INFS7202', 0, 0),
(133, 'deco', 'Assignment', 'yoki', 'deco', '2023-05-21 18:19:56', 'DECO7250', 0, 0),
(134, 'deco 7250', 'Assignment', 'yoki', 'd', '2023-05-21 18:20:21', 'DECO7250', 0, 0),
(135, 'uploading', 'General', 'yoki', 'u', '2023-05-22 00:27:46', 'DECO7140', 0, 0),
(136, 'air pods', 'Social', 'yoki', 'a', '2023-05-22 00:31:08', 'DECO7140', 0, 0),
(138, 'assessment', 'Assignment', 'yoki', 'semester 3', '2023-07-28 08:43:47', 'CSSE7023', 0, 0),
(139, 'assignment', 'Assignment', 'yoki', 'semester 3', '2023-07-28 08:48:18', 'CSSE7023', 0, 0),
(140, 'new test', 'Lecture', 'yueqi', 'new test', '2023-10-06 09:42:21', 'INFS7202', 0, 0),
(141, 'new test', 'General', 'yueqi', 'new test', '2023-10-06 09:44:18', 'DECO7250', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_id`, `content`, `created_at`, `author`) VALUES
(1, 71, 'q!', '2023-05-07 08:31:25', 'yoki'),
(2, 78, 'First Comment on Hello everyone', '2023-05-07 13:02:06', 'yoki'),
(3, 71, 'comment on new post', '2023-05-07 13:09:29', 'yoki'),
(4, 67, 'First comment on yueqi\'s post', '2023-05-07 13:10:10', 'yoki'),
(5, 67, 'hahahahhahahaha', '2023-05-07 13:31:25', 'yoki'),
(6, 70, 'lllalallalala', '2023-05-07 13:47:58', 'yoki'),
(7, 79, 'wafafwefewfadf', '2023-05-07 13:56:06', 'yoki'),
(8, 135, 'hi', '2023-05-22 00:27:52', 'yoki'),
(9, 135, 'hello', '2023-05-22 00:28:07', 'yoki'),
(10, 68, 'nice', '2023-05-22 00:28:22', 'yoki'),
(11, 136, 'cool', '2023-05-22 00:31:17', 'yoki'),
(12, 133, 'jfksafjhk', '2023-05-22 02:16:13', 'yoki');

-- --------------------------------------------------------

--
-- 表的结构 `post_files`
--

CREATE TABLE `post_files` (
  `id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED NOT NULL,
  `file_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `post_files`
--

INSERT INTO `post_files` (`id`, `post_id`, `file_id`) VALUES
(1, 107, 62),
(2, 107, 63),
(3, 108, 64),
(4, 108, 65),
(5, 109, 66),
(6, 134, 67),
(7, 135, 68),
(8, 139, 71);

-- --------------------------------------------------------

--
-- 表的结构 `tokens`
--

CREATE TABLE `tokens` (
  `id` int NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` varchar(60) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 表的结构 `Upload`
--

CREATE TABLE `Upload` (
  `file_id` int UNSIGNED NOT NULL,
  `file_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `Upload`
--

INSERT INTO `Upload` (`file_id`, `file_name`) VALUES
(15, 's4758612_quiz1 copy.zip'),
(16, 's4758612_quiz1.zip'),
(17, 'Screen Shot 2023-03-06 at 12.18.14.png'),
(20, 's4758612_quiz1.zip'),
(21, 's4758612_quiz1.zip'),
(22, 's4758612_quiz1.zip'),
(23, 's4758612_quiz1.zip'),
(24, 's4758612_quiz1.zip'),
(25, 's4758612_quiz1 copy.zip'),
(26, 's4758612_quiz1 copy.zip'),
(27, 's4758612_quiz1 copy.zip'),
(28, 's4758612_quiz1 copy.zip'),
(29, 's4758612_quiz1.zip'),
(30, 's4758612_quiz1.zip'),
(31, 's4758612_quiz1.zip'),
(32, 's4758612_quiz1.zip'),
(33, 's4758612_quiz1.zip'),
(34, 's4758612_quiz1.zip'),
(35, 's4758612_quiz1.zip'),
(36, 's4758612_quiz1.zip'),
(37, 's4758612_quiz1 copy.zip'),
(38, 's4758612_quiz1 copy.zip'),
(39, 's4758612_quiz1 copy.zip'),
(40, 's4758612_quiz1.zip'),
(41, 's4758612_quiz1 copy.zip'),
(42, '645a556e71034.png'),
(43, '645a5583ed81f.png'),
(44, '645e078614bdd.png'),
(45, '645efaba83311.png'),
(46, '645efb1e30970.png'),
(47, '645efb5da6066.png'),
(48, '645efb72e46f8.png'),
(49, '645efbc13e9c3.png'),
(50, '645efbe69b8ce.png'),
(51, '645efc002dc5b.png'),
(52, '645efc42a7e54.png'),
(53, '645efcac05c91.png'),
(54, '645efcc452e95.png'),
(55, '645efd2503a29.png'),
(56, '645efd62c5a6b.zip'),
(57, '645efd62c6585.zip'),
(58, '645f0442c497c.zip'),
(59, '645f0442c53df.zip'),
(60, '645f051924341.zip'),
(61, '645f051924d69.zip'),
(62, '645f13b853a5d.zip'),
(63, '645f13b854874.zip'),
(64, '645f15ab4d61b.zip'),
(65, '645f15ab4e07e.zip'),
(66, '6461149823e22.png'),
(67, '646a60e09c606.png'),
(68, '646ab70067478.jpeg'),
(69, '64c37fd5e7e72.png'),
(70, '64c3805acc9e7.png'),
(71, '64c380c66313b.pdf');

-- --------------------------------------------------------

--
-- 表的结构 `Users`
--

CREATE TABLE `Users` (
  `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` int NOT NULL,
  `profile_photo` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `Users`
--

INSERT INTO `Users` (`name`, `email`, `password`, `phone`, `profile_photo`) VALUES
('yoki', '923944641@qq.com', '$2y$10$AcRMTaTmxwR07O9huxShouRunDMaOxALYlNnRskiLLehMxxBYXAQy', 987654321, NULL),
('yueqi', 'w923944641@gmail.com', '$2y$10$lvhkDLHkJ7ER1CsdqRMdGeqkQG9f9EJq68RvoeauzmBTP.N.ajOWm', 490866093, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_courses`
--

CREATE TABLE `user_courses` (
  `user_name` varchar(20) NOT NULL,
  `course_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `user_courses`
--

INSERT INTO `user_courses` (`user_name`, `course_name`) VALUES
('yoki', 'CSSE7023'),
('yueqi', 'CSSE7023'),
('yueqi', 'CSSE7201'),
('yoki', 'DECO7140'),
('yoki', 'DECO7250'),
('yueqi', 'DECO7250'),
('yoki', 'INFS7202'),
('yueqi', 'INFS7202');

-- --------------------------------------------------------

--
-- 表的结构 `user_likes`
--

CREATE TABLE `user_likes` (
  `id` int UNSIGNED NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `post_id` int UNSIGNED NOT NULL,
  `liked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `user_likes`
--

INSERT INTO `user_likes` (`id`, `user_name`, `post_id`, `liked`) VALUES
(1, 'yoki', 71, 1),
(2, 'yoki', 78, 1),
(4, 'yoki', 107, 0),
(5, 'yueqi', 78, 1),
(6, 'yoki', 67, 0),
(7, 'yoki', 75, 1),
(8, 'yoki', 79, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_stars`
--

CREATE TABLE `user_stars` (
  `id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `stared` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 转存表中的数据 `user_stars`
--

INSERT INTO `user_stars` (`id`, `post_id`, `user_name`, `stared`) VALUES
(1, 71, 'yoki', 0),
(2, 78, 'yoki', 1),
(4, 76, 'yoki', 0),
(5, 75, 'yoki', 0),
(6, 79, 'yoki', 1),
(7, 69, 'yoki', 1),
(8, 68, 'yoki', 0),
(9, 67, 'yoki', 1),
(14, 109, 'yoki', 1),
(16, 108, 'yueqi', 1),
(17, 70, 'yueqi', 1),
(18, 113, 'yoki', 1),
(19, 117, 'yoki', 1);

--
-- 转储表的索引
--

--
-- 表的索引 `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`name`);

--
-- 表的索引 `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Posts_ibfk_1` (`author`),
  ADD KEY `Posts_ibfk_2` (`course_name`);

--
-- 表的索引 `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_ibfk_1` (`post_id`);

--
-- 表的索引 `post_files`
--
ALTER TABLE `post_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post` (`post_id`),
  ADD KEY `fk_file` (`file_id`);

--
-- 表的索引 `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tokens_ibfk_1` (`email`);

--
-- 表的索引 `Upload`
--
ALTER TABLE `Upload`
  ADD PRIMARY KEY (`file_id`);

--
-- 表的索引 `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`user_name`,`course_name`),
  ADD KEY `user_courses_ibfk_2` (`course_name`);

--
-- 表的索引 `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_likes_post_id` (`post_id`),
  ADD KEY `FK_user_likes_user_id` (`user_name`);

--
-- 表的索引 `user_stars`
--
ALTER TABLE `user_stars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_stars_post_id` (`post_id`),
  ADD KEY `FK_user_stars_user_name` (`user_name`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `Image`
--
ALTER TABLE `Image`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `Posts`
--
ALTER TABLE `Posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- 使用表AUTO_INCREMENT `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `post_files`
--
ALTER TABLE `post_files`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `Upload`
--
ALTER TABLE `Upload`
  MODIFY `file_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- 使用表AUTO_INCREMENT `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `user_stars`
--
ALTER TABLE `user_stars`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 限制导出的表
--

--
-- 限制表 `Posts`
--
ALTER TABLE `Posts`
  ADD CONSTRAINT `Posts_ibfk_2` FOREIGN KEY (`course_name`) REFERENCES `Courses` (`name`);

--
-- 限制表 `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `post_files`
--
ALTER TABLE `post_files`
  ADD CONSTRAINT `fk_file` FOREIGN KEY (`file_id`) REFERENCES `Upload` (`file_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_post` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`id`) ON DELETE CASCADE;

--
-- 限制表 `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`email`) REFERENCES `Users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `user_courses_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `Users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_courses_ibfk_2` FOREIGN KEY (`course_name`) REFERENCES `Courses` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `FK_user_likes_post_id` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_likes_user_id` FOREIGN KEY (`user_name`) REFERENCES `Users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user_stars`
--
ALTER TABLE `user_stars`
  ADD CONSTRAINT `FK_user_stars_post_id` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_stars_user_name` FOREIGN KEY (`user_name`) REFERENCES `Users` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
