-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2016 at 05:29 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email_nuggets`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_courses`
--

CREATE TABLE `tb_courses` (
  `course_id` int(4) NOT NULL,
  `course_title` varchar(100) NOT NULL,
  `course_description` text,
  `owner` int(4) NOT NULL,
  `editors` varchar(30) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `version` int(2) DEFAULT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_courses`
--

INSERT INTO `tb_courses` (`course_id`, `course_title`, `course_description`, `owner`, `editors`, `status`, `thumbnail`, `version`, `created_date`) VALUES
(1, 'Big Data', 'Big data is a term for data sets that are so large or complex that traditional data processing applications are inadequate. Challenges include analysis, capture, data curation, search, sharing, storage, transfer, visualization, querying, updating and information privacy. The term often refers simply to the use of predictive analytics or certain other advanced data analytics methods that extract value from data, and seldom to a particular size of data set.[2] Accuracy in big data may lead to more confident decision making, and better decisions can result in greater operational efficiency, cost reduction and reduced risk.', 1, NULL, 1, NULL, 1, '2016-07-19'),
(2, 'DevOps', 'DevOps (a clipped compound of development and operations) is a culture, movement or practice that emphasizes the collaboration and communication of both software developers and other information-technology (IT) professionals while automating the process of software delivery and infrastructure changes.', 1, NULL, 1, NULL, 1, '2016-07-19'),
(3, 'Deep Learning', 'Deep learning (also known as deep structured learning, hierarchical learning or deep machine learning) is a branch of machine learning based on a set of algorithms that attempt to model high-level abstractions in data by using a deep graph with multiple processing layers, composed of multiple linear and non-linear transformations.[1][2][3][4][5][6][7][8][9]\n\nDeep learning is part of a broader family of machine learning methods based on learning representations of data. An observation (e.g., an image) can be represented in many ways such as a vector of intensity values per pixel, or in a more abstract way as a set of edges, regions of particular shape, etc. Some representations are better than others at simplifying the learning task (e.g., face recognition or facial expression recognition[10]). One of the promises of deep learning is replacing handcrafted features with efficient algorithms for unsupervised or semi-supervised feature learning and hierarchical feature extraction.[11]\n\nResearch in this area attempts to make better representations and create models to learn these representations from large-scale unlabeled data. Some of the representations are inspired by advances in neuroscience and are loosely based on interpretation of information processing and communication patterns in a nervous system, such as neural coding which attempts to define a relationship between various stimuli and associated neuronal responses in the brain.[12]', 1, NULL, 1, NULL, 1, '2016-07-19'),
(4, 'Cyber Security', 'Computer security, also known as cybersecurity or IT security, is the protection of information systems from theft or damage to the hardware, the software, and to the information on them, as well as from disruption or misdirection of the services they provide.[1]\n\nIt includes controlling physical access to the hardware, as well as protecting against harm that may come via network access, data and code injection,[2] and due to malpractice by operators, whether intentional, accidental, or due to them being tricked into deviating from secure procedures.[3]\n\nThe field is of growing importance due to the increasing reliance on computer systems in most societies[4] and the growth of "smart" devices, including smartphones, televisions and tiny devices as part of the Internet of Things – and of the Internet and wireless network such as Bluetooth and Wi-Fi.', 1, NULL, 1, NULL, 1, '2016-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_curators`
--

CREATE TABLE `tb_curators` (
  `curator_id` int(4) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rights` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `date_joined` date NOT NULL,
  `last_login` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_curators`
--

INSERT INTO `tb_curators` (`curator_id`, `first_name`, `last_name`, `email`, `password`, `rights`, `status`, `date_joined`, `last_login`) VALUES
(1, 'Vishwajit', 'Menon', 'v@m.com', '', 'super', 1, '2016-07-18', '2016-07-19');

-- --------------------------------------------------------

--
-- Table structure for table `tb_feedback`
--

CREATE TABLE `tb_feedback` (
  `feedback_id` int(11) NOT NULL,
  `learner_id` int(6) NOT NULL,
  `block_type` varchar(10) NOT NULL,
  `block_id` int(6) NOT NULL,
  `feedback` varchar(10) NOT NULL,
  `feedback_text` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_learners`
--

CREATE TABLE `tb_learners` (
  `learner_id` int(6) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `timezone` varchar(15) NOT NULL,
  `joined_date` date NOT NULL,
  `last_login` date NOT NULL,
  `department` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_learners`
--

INSERT INTO `tb_learners` (`learner_id`, `first_name`, `last_name`, `email`, `password`, `timezone`, `joined_date`, `last_login`, `department`) VALUES
(1, 'Alpha', 'Tango', 'v@m.com', '81dc9bdb52d04dc20036dbd8313ed055', 'asia', '2016-07-04', '2016-07-25', 'NGL'),
(2, 'Hank', 'Palo', 'h@m.com', '133987b0b6ad0c01fc0ccbdae1b95449', 'europe', '2016-07-25', '0000-00-00', ''),
(3, 'Jert', 'Hert', 'j@m.com', '81dc9bdb52d04dc20036dbd8313ed055', 'us', '2016-07-25', '0000-00-00', ''),
(4, 'Bert', 'Kurt', 'b@m.com', '81dc9bdb52d04dc20036dbd8313ed055', 'asia', '2016-07-26', '2016-07-26', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sent_mail`
--

CREATE TABLE `tb_sent_mail` (
  `mail_id` int(11) NOT NULL,
  `sub_id` int(6) NOT NULL,
  `block_type` varchar(10) NOT NULL,
  `block_id` int(6) NOT NULL,
  `sent_date` date NOT NULL,
  `timezone` varchar(10) NOT NULL,
  `mail_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_subscriptions`
--

CREATE TABLE `tb_subscriptions` (
  `sub_id` int(7) NOT NULL,
  `learner_id` int(4) NOT NULL,
  `course_id` int(4) NOT NULL,
  `schedule` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `last_sent_topic_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_subscriptions`
--

INSERT INTO `tb_subscriptions` (`sub_id`, `learner_id`, `course_id`, `schedule`, `start_date`, `end_date`, `status`, `last_sent_topic_id`) VALUES
(1, 1, 1, 'daily', '2016-07-21', '2016-07-26', 'active', 2),
(2, 1, 3, 'daily', '2016-07-21', '2016-07-21', 'terminated', 0),
(3, 1, 3, 'daily', '2016-07-21', '0000-00-00', 'completed', 0),
(4, 1, 4, 'daily', '2016-07-25', '2016-07-25', 'terminated', 0),
(6, 3, 4, 'daily', '2016-07-26', '0000-00-00', 'active', 5),
(7, 3, 3, 'daily', '2016-07-26', '0000-00-00', 'active', 14),
(8, 2, 1, 'all', '2016-07-26', '2000-07-07', 'active', 0),
(9, 2, 4, 'daily', '2016-07-26', '0000-00-00', 'active', 4),
(10, 2, 2, 'daily', '2016-07-26', '0000-00-00', 'active', 8),
(11, 4, 4, 'daily', '2016-07-26', '2016-07-27', 'completed', 6),
(12, 4, 3, 'daily', '2016-07-26', '0000-00-00', 'active', 14),
(13, 1, 4, 'daily', '2016-07-26', '0000-00-00', 'active', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_topics`
--

CREATE TABLE `tb_topics` (
  `topic_id` int(6) NOT NULL,
  `topic_title` varchar(100) NOT NULL,
  `topic_description` varchar(300) DEFAULT NULL,
  `topic_type` varchar(15) NOT NULL,
  `topic_source` varchar(300) NOT NULL,
  `parent_id` int(4) NOT NULL,
  `sequence` int(3) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_topics`
--

INSERT INTO `tb_topics` (`topic_id`, `topic_title`, `topic_description`, `topic_type`, `topic_source`, `parent_id`, `sequence`, `status`) VALUES
(1, 'What is Big Data', 'Big data is being generated by everything around us at all times. Every digital process and social media exchange produces it. Systems, sensors and mobile devices transmit it. Big data is arriving..', 'url', 'https://www.ibm.com/big-data/us/en/', 1, 1, 1),
(2, 'What is Big Data 2', 'Big data is being generated by everything around us at all times. Every digital process and social media exchange produces it. Systems, sensors and mobile devices transmit it. Big data is arriving..', 'url', 'https://www.ibm.com/big-data/us/en/', 1, 2, 1),
(3, 'What is Big Data 3', 'Big data is being generated by everything around us at all times. Every digital process and social media exchange produces it. Systems, sensors and mobile devices transmit it. Big data is arriving..', 'url', 'https://www.ibm.com/big-data/us/en/', 1, 3, 1),
(4, 'Cyber Security Essentials', 'Cybersecurity is the body of technologies, processes and practices designed to protect networks, computers, programs and data from attack, damage or unauthorized access..', 'url', 'https://en.wikipedia.org/wiki/Computer_security', 4, 1, 1),
(5, 'Cyber Security Essentials 2', 'Cybersecurity is the body of technologies, processes and practices designed to protect networks, computers, programs and data from attack, damage or unauthorized access..', 'url', 'https://en.wikipedia.org/wiki/Computer_security', 4, 2, 1),
(6, 'Cyber Security Essentials 3', 'Cybersecurity is the body of technologies, processes and practices designed to protect networks, computers, programs and data from attack, damage or unauthorized access..', 'url', 'https://en.wikipedia.org/wiki/Computer_security', 4, 3, 1),
(7, 'Cyber Security Essentials 4', 'Cybersecurity is the body of technologies, processes and practices designed to protect networks, computers, programs and data from attack, damage or unauthorized access..', 'url', 'https://en.wikipedia.org/wiki/Computer_security', 4, 4, 1),
(8, 'What is DevOps', 'DevOps is a term for a group of concepts that, while not all new, have catalyzed into a movement and are rapidly spreading throughout...', 'url', 'https://theagileadmin.com/what-is-devops/', 2, 1, 1),
(9, 'What is DevOps 2', 'DevOps is a term for a group of concepts that, while not all new, have catalyzed into a movement and are rapidly spreading throughout...', 'url', 'https://theagileadmin.com/what-is-devops/', 2, 2, 1),
(10, 'What is DevOps 3', 'DevOps is a term for a group of concepts that, while not all new, have catalyzed into a movement and are rapidly spreading throughout...', 'url', 'https://theagileadmin.com/what-is-devops/', 2, 3, 1),
(11, 'What is DevOps 4', 'DevOps is a term for a group of concepts that, while not all new, have catalyzed into a movement and are rapidly spreading throughout...', 'url', 'https://theagileadmin.com/what-is-devops/', 2, 4, 1),
(12, 'What is DevOps 5', 'DevOps is a term for a group of concepts that, while not all new, have catalyzed into a movement and are rapidly spreading throughout...', 'url', 'https://theagileadmin.com/what-is-devops/', 2, 5, 1),
(13, 'Understanding Deep Learning', 'Deep Learning is a new area of Machine Learning research, which has been introduced with the objective of moving Machine Learning closer to one of its original goals: Artificial Intelligence', 'url', 'http://deeplearning.net/', 3, 1, 1),
(14, 'Understanding Deep Learning 2', 'Deep Learning is a new area of Machine Learning research, which has been introduced with the objective of moving Machine Learning closer to one of its original goals: Artificial Intelligence', 'url', 'http://deeplearning.net/', 3, 2, 1),
(15, 'Understanding Deep Learning 3', 'Deep Learning is a new area of Machine Learning research, which has been introduced with the objective of moving Machine Learning closer to one of its original goals: Artificial Intelligence', 'url', 'http://deeplearning.net/', 3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tracker`
--

CREATE TABLE `tb_tracker` (
  `track_id` int(11) NOT NULL,
  `learner_id` int(6) NOT NULL,
  `topic_id` int(4) NOT NULL,
  `mail_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_courses`
--
ALTER TABLE `tb_courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tb_curators`
--
ALTER TABLE `tb_curators`
  ADD PRIMARY KEY (`curator_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_feedback`
--
ALTER TABLE `tb_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tb_learners`
--
ALTER TABLE `tb_learners`
  ADD PRIMARY KEY (`learner_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_sent_mail`
--
ALTER TABLE `tb_sent_mail`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `tb_subscriptions`
--
ALTER TABLE `tb_subscriptions`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `tb_topics`
--
ALTER TABLE `tb_topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `tb_tracker`
--
ALTER TABLE `tb_tracker`
  ADD PRIMARY KEY (`track_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_courses`
--
ALTER TABLE `tb_courses`
  MODIFY `course_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_curators`
--
ALTER TABLE `tb_curators`
  MODIFY `curator_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_feedback`
--
ALTER TABLE `tb_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_learners`
--
ALTER TABLE `tb_learners`
  MODIFY `learner_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_sent_mail`
--
ALTER TABLE `tb_sent_mail`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_subscriptions`
--
ALTER TABLE `tb_subscriptions`
  MODIFY `sub_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_topics`
--
ALTER TABLE `tb_topics`
  MODIFY `topic_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
