-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jul 09, 2023 at 08:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quora`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `ans_id` int(20) NOT NULL,
  `ques_id` int(20) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `answer` longtext NOT NULL,
  `DT` datetime NOT NULL,
  `ansImg` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`ans_id`, `ques_id`, `userName`, `answer`, `DT`, `ansImg`) VALUES
(2, 4, 'kaushal', '0', '2023-03-24 20:58:04', ''),
(3, 4, 'neeraj', '0', '2023-03-25 11:36:50', ''),
(5, 2, 'neeraj', '0', '2023-03-25 12:28:30', ''),
(8, 8, 'Arun', 'As the hype around AI has accelerated, vendors have been scrambling to promote how their products and services use AI. Often what they refer to as AI is simply one component of AI, such as machine learning. AI requires a foundation of specialized hardware and software for writing and training machine learning algorithms. No one programming language is synonymous with AI, but a few, including Python, R and Java, are popular.																							', '2023-03-28 14:38:31', ''),
(9, 7, 'arun', ' Python Is An Interpreted, Object-Oriented, High-Level Programming Language With Dynamic Semantics. Its High-Level Built In Data Structures, Combined With Dynamic Typing And Dynamic Binding, Make It Very Attractive For Rapid Application Development, As Well As For Use As A Scripting Or Glue Language To Connect Existing Components Together. Python\'s Simple, Easy To Learn Syntax Emphasizes Readability And Therefore Reduces The Cost Of Program Maintenance. Python Supports Modules And Packages, Which Encourages Program Modularity And Code Reuse. The Python Interpreter And The Extensive Standard Library Are Available In Source Or Binary Form Without Charge For All Major Platforms, And Can Be Freely Distributed.\r\n\r\nOften, Programmers Fall In Love With Python Because Of The Increased Productivity It Provides. Since There Is No Compilation Step, The Edit-Test-Debug Cycle Is Incredibly Fast. Debugging Python Programs Is Easy: A Bug Or Bad Input Will Never Cause A Segmentation Fault. Instead, When The Interpreter Discovers An Error, It Raises An Exception. When The Program Doesn\'t Catch The Exception, The Interpreter Prints A Stack Trace. A Source Level Debugger Allows Inspection Of Local And Global Variables, Evaluation Of Arbitrary Expressions, Setting Breakpoints, Stepping Through The Code A Line At A Time, And So On. The Debugger Is Written In Python Itself, Testifying To Python\'s Introspective Power. On The Other Hand, Often The Quickest Way To Debug A Program Is To Add A Few Print Statements To The Source: The Fast Edit-Test-Debug Cycle Makes This Simple Approach Very Effective.					', '2023-07-08 12:19:38', ''),
(10, 7, 'Kaushal', 'Python is commonly used for developing websites and software, task automation, data analysis, and data visualization. Since it’s relatively easy to learn, Python has been adopted by many non-programmers such as accountants and scientists, for a variety of everyday tasks, like organizing finances.\r\n\r\n“Writing programs is a very creative and rewarding activity,” says University of Michigan and Coursera instructor Charles R Severance in his book Python for Everybody. “You can write programs for many reasons, ranging from making your living to solving a difficult data analysis problem to having fun to helping someone else solve a problem.”\r\n\r\n', '2023-07-09 00:32:31', ''),
(11, 7, 'kajal', 'Python was designed for readability, and has some similarities to the English language with influence from mathematics.\r\nPython uses new lines to complete a command, as opposed to other programming languages which often use semicolons or parentheses.\r\nPython relies on indentation, using whitespace, to define scope; such as the scope of loops, functions and classes. Other programming languages often use curly-brackets for this purpose.', '2023-07-09 00:50:03', ''),
(12, 7, 'LUV', 'Python works on different platforms (Windows, Mac, Linux, Raspberry Pi, etc).\r\nPython has a simple syntax similar to the English language.\r\nPython has syntax that allows developers to write programs with fewer lines than some other programming languages.\r\nPython runs on an interpreter system, meaning that code can be executed as soon as it is written. This means that prototyping can be very quick.\r\nPython can be treated in a procedural way, an object-oriented way or a functional way.', '2023-07-09 00:52:12', ''),
(13, 7, 'neeraj', 'zxdazc', '2023-07-09 11:18:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `answer-feedback`
--

CREATE TABLE `answer-feedback` (
  `ans_Id` int(20) NOT NULL,
  `ques_id` varchar(20) NOT NULL,
  `Likes` int(10) NOT NULL,
  `dislikes` int(10) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_Id` int(10) NOT NULL,
  `ans_Id` int(10) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `comment` tinytext NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_Id`, `ans_Id`, `userName`, `comment`, `dateTime`) VALUES
(1, 9, 'LUV', 'The best answer i Guess.', '2023-07-08 19:04:30'),
(2, 9, 'faizan', 'nice', '2023-07-08 19:12:16'),
(3, 10, 'kajal', 'Seems nice\n', '2023-07-08 20:50:57'),
(4, 10, 'Kaushal', 'ghgd\n', '2023-07-09 06:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `dislike_id` int(10) NOT NULL,
  `ques_id` int(10) NOT NULL,
  `ans_id` int(10) DEFAULT NULL,
  `dislike_userName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`dislike_id`, `ques_id`, `ans_id`, `dislike_userName`) VALUES
(10, 7, 12, 'Kaushal'),
(11, 7, 11, 'Kaushal'),
(12, 7, 12, 'chandana'),
(13, 7, 11, 'chandana'),
(14, 7, 9, 'chandana'),
(15, 7, 9, 'arun'),
(16, 7, 9, 'kajal'),
(21, 7, 10, 'LUV'),
(25, 7, 10, 'Kaushal');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeId` int(10) NOT NULL,
  `ques_id` int(10) NOT NULL,
  `ans_id` int(10) NOT NULL,
  `liked_userName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeId`, `ques_id`, `ans_id`, `liked_userName`) VALUES
(2, 8, 8, 'arun'),
(4, 7, 6, 'arun'),
(8, 7, 9, 'LUV'),
(12, 7, 9, 'faizan'),
(13, 7, 10, 'faizan'),
(16, 7, 11, 'kajal'),
(19, 7, 10, 'chandana'),
(24, 7, 10, 'kajal'),
(28, 7, 9, 'neeraj'),
(31, 7, 10, 'neeraj'),
(33, 7, 9, 'rohit'),
(34, 7, 10, 'rohit'),
(35, 7, 9, 'Kaushal'),
(36, 7, 10, 'amit'),
(37, 7, 12, 'amit'),
(38, 7, 10, 'sonu'),
(39, 7, 12, 'sonu'),
(40, 7, 10, 'mukesh'),
(41, 7, 12, 'mukesh'),
(42, 7, 10, 'rahul'),
(43, 7, 9, 'rahul'),
(44, 7, 12, 'rahul'),
(45, 7, 11, 'rahul'),
(61, 7, 10, 'vikash'),
(63, 7, 11, 'vikash'),
(65, 7, 9, 'vikash'),
(66, 7, 10, 'shanu'),
(67, 7, 9, 'shanu'),
(68, 7, 12, 'shanu'),
(69, 7, 11, 'shanu'),
(70, 7, 10, 'ankit'),
(71, 7, 9, 'ankit'),
(72, 7, 12, 'ankit'),
(73, 7, 11, 'ankit'),
(74, 7, 10, 'abhishek1'),
(75, 7, 12, 'abhishek1'),
(76, 7, 9, 'abhishek1'),
(77, 7, 11, 'abhishek1'),
(78, 7, 10, 'neeraj111'),
(79, 7, 12, 'neeraj111'),
(80, 7, 9, 'neeraj111'),
(81, 7, 11, 'neeraj111'),
(82, 7, 10, 'shashikant'),
(83, 7, 12, 'shashikant'),
(84, 7, 9, 'shashikant'),
(86, 7, 12, 'rohit'),
(87, 7, 11, 'rohit'),
(88, 7, 10, 'neha'),
(89, 7, 12, 'neha'),
(91, 7, 9, 'neha'),
(92, 7, 10, 'kkkk'),
(93, 7, 12, 'kkkk'),
(94, 7, 9, 'kkkk'),
(95, 7, 11, 'kkkk');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ques_Id` int(11) NOT NULL,
  `question` tinytext NOT NULL,
  `userName` varchar(20) NOT NULL,
  `post` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ques_Id`, `question`, `userName`, `post`) VALUES
(7, 'what is python?', 'neeraj', '2023-03-25 12:36:19'),
(8, 'what is ai?', 'neeraj', '2023-03-25 12:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `uid` int(10) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `email_id` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `Profession` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phno` varchar(10) DEFAULT NULL,
  `CurrentJob` varchar(20) NOT NULL,
  `userImage` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`uid`, `userName`, `email_id`, `firstName`, `lastName`, `Profession`, `password`, `phno`, `CurrentJob`, `userImage`) VALUES
(1, 'Neeraj', 'neeraj@gmail.com', 'Neeraj', 'Kumar', 'Civil Enginner', 'arunarun1*', '7984967605', 'IT Engineer', ''),
(2, 'Arun', 'arunsharma96025@gmai', 'Arun', 'Sharma', 'IT Enginner', 'arunarun1*', '7984967605', 'Civil Enginner', ''),
(3, 'Kaushal', 'kaushal@gmail.com', 'Kumar', 'Kaushal', 'pshycologist', 'arunarun1*', '7984967605', 'Student at Acharya', ''),
(4, 'LUV', 'luv@gmail.com', 'luv', 'Ranjan', 'lovely professional', 'arunarun1*', '7984967605', 'professional', ''),
(5, 'chandana', 'chandana@gmail.com', 'chandana', 'Gowda', '', 'arunarun1*', '7984967605', 'Teacher', ''),
(6, 'kajal', 'kajal@gmail.com', 'kajal', 'sharma', 'pshycologist', 'arunarun1*', '7984967605', 'Psycologist', ''),
(7, 'faizan', 'faizan@gmail.com', 'Faizan', 'Khan', '', 'arunarun1*', '7984967605', 'Professor', ''),
(8, 'rohit', 'rohit@gmail.com', '', '', '', 'arunarun1*', NULL, '', ''),
(9, 'neeraj1', 'neeraj11@gmail.com', 'Neeraj', 'Kumar', '', 'arunarun1*', NULL, '', ''),
(10, 'aru11', '', '', '', '', 'arunarun1*', NULL, '', ''),
(11, 'neeraj111', '', '', '', '', 'arunarun1*', NULL, '', ''),
(12, 'vinitkumar', '', '', '', '', 'arunarun1*', NULL, '', ''),
(13, 'abhishek1', '', '', '', '', 'arunarun1*', NULL, '', ''),
(14, 'abhishek1', '', '', '', '', 'arunarun1*', NULL, '', ''),
(15, 'shanu', '', '', '', '', 'arunarun1*', NULL, '', ''),
(16, 'shashikant', '', '', '', '', 'arunarun1*', NULL, '', ''),
(17, 'rohit', '', '', '', '', 'arunarun1*', NULL, '', ''),
(18, 'sonu', '', '', '', '', 'arunarun1*', NULL, '', ''),
(19, 'vikash', '', '', '', '', 'arunarun1*', NULL, '', ''),
(20, 'vikash', '', '', '', '', 'arunarun1*', NULL, '', ''),
(21, 'neha', '', '', '', '', 'arunarun1*', NULL, '', ''),
(22, 'rahul', '', '', '', '', 'arunarun1*', NULL, '', ''),
(23, 'rahul', '', '', '', '', 'arunarun1*', NULL, '', ''),
(24, 'mukesh', '', '', '', '', 'arunarun1*', NULL, '', ''),
(25, 'ankit', '', '', '', '', 'arunarun1*', NULL, '', ''),
(26, 'vikash', '', '', '', '', 'arunarun1*', NULL, '', ''),
(27, 'divmanshu', '', '', '', '', 'arunarun1*', NULL, '', ''),
(28, 'raja', '', '', '', '', 'arunarun1*', NULL, '', ''),
(29, 'amit', '', '', '', '', 'arunarun1*', NULL, '', ''),
(30, 'amit', '', '', '', '', 'arunarun1*', NULL, '', ''),
(31, 'avnish', '', '', '', '', 'arunarun1*', NULL, '', ''),
(32, 'kkkk', 'neeraj111@gmail.com', 'Neeraj', 'Kumar', '', 'arunarun1*', NULL, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`ans_id`);

--
-- Indexes for table `answer-feedback`
--
ALTER TABLE `answer-feedback`
  ADD PRIMARY KEY (`ans_Id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_Id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`dislike_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ques_Id`);
ALTER TABLE `questions` ADD FULLTEXT KEY `question` (`question`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `ans_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `answer-feedback`
--
ALTER TABLE `answer-feedback`
  MODIFY `ans_Id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `dislike_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ques_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
