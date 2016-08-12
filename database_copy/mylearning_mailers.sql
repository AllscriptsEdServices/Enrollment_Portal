-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2016 at 05:30 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mylearning_mailers`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_assignments_data`
--

CREATE TABLE `tb_assignments_data` (
  `assignment_id` int(11) NOT NULL,
  `learner_id` int(7) NOT NULL,
  `activity_code` varchar(20) NOT NULL,
  `activity_name` varchar(100) NOT NULL,
  `activity_created_date` date NOT NULL,
  `assigned_date` date NOT NULL,
  `due_date` date NOT NULL,
  `enrolled_by` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `status_date` date NOT NULL,
  `passed` varchar(10) NOT NULL,
  `completed` varchar(10) NOT NULL,
  `completed_date` date NOT NULL,
  `assignment_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_campaigns`
--

CREATE TABLE `tb_campaigns` (
  `campaign_id` tinyint(5) NOT NULL COMMENT 'Unique reference id for each campaign',
  `campaign_title` varchar(100) NOT NULL COMMENT 'title of the campaign',
  `campain_type` varchar(15) NOT NULL COMMENT 'type: "assignment"/"registration"',
  `campaign_status` varchar(10) NOT NULL COMMENT 'Status: draft/active/complete/stopped/archived',
  `campaign_manager_name` varchar(50) NOT NULL COMMENT 'text - manager name',
  `campaign_manager_email` varchar(50) NOT NULL COMMENT 'text - manager email',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `send_summary_email` tinyint(1) NOT NULL COMMENT '1 = Send Mail, 0 = Don''t',
  `audience_type` varchar(10) NOT NULL COMMENT 'type: rule/individual',
  `created_by` int(4) NOT NULL,
  `last_modified_by` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_campaigns`
--

INSERT INTO `tb_campaigns` (`campaign_id`, `campaign_title`, `campain_type`, `campaign_status`, `campaign_manager_name`, `campaign_manager_email`, `start_date`, `end_date`, `send_summary_email`, `audience_type`, `created_by`, `last_modified_by`) VALUES
(1, 'My First Campaign', 'assignment', 'active', 'Vishwajit Menon', 'vishwait.menon@capgemini.com', '2016-08-10', '2016-08-25', 1, 'rule', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_campaign_activity_map`
--

CREATE TABLE `tb_campaign_activity_map` (
  `mapping_id` smallint(5) NOT NULL COMMENT 'not used anywhere else',
  `activity_code` varchar(20) NOT NULL COMMENT 'mylearning code',
  `activity_name` varchar(200) NOT NULL COMMENT 'mylearning name',
  `activity_type` varchar(20) NOT NULL,
  `activity_launch_url` varchar(300) NOT NULL,
  `activity_registration_url` varchar(300) NOT NULL,
  `sequence_number` int(3) NOT NULL,
  `campaign_id` int(5) NOT NULL COMMENT 'foreign key from campaigns table'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_campaign_learners_map`
--

CREATE TABLE `tb_campaign_learners_map` (
  `mapping_id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `campaign_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_campaign_notifications`
--

CREATE TABLE `tb_campaign_notifications` (
  `notification_id` int(7) NOT NULL,
  `notification_title` int(30) NOT NULL,
  `template_id` int(5) NOT NULL,
  `notification_start_date` date NOT NULL,
  `notification_end_date` date NOT NULL,
  `notification_type` int(3) NOT NULL,
  `frequency` varchar(10) NOT NULL,
  `run_date` date NOT NULL,
  `freequency_adjective` varchar(10) NOT NULL,
  `frequency_day` varchar(10) NOT NULL,
  `campaign_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_campaign_rules_map`
--

CREATE TABLE `tb_campaign_rules_map` (
  `mapping_id` int(6) NOT NULL,
  `rule_id` int(3) NOT NULL,
  `rule_value` varchar(30) NOT NULL,
  `campaign_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_countries_lookup`
--

CREATE TABLE `tb_countries_lookup` (
  `country_id` int(3) NOT NULL,
  `country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_countries_lookup`
--

INSERT INTO `tb_countries_lookup` (`country_id`, `country`) VALUES
(1, 'Argentina'),
(2, 'Australia'),
(3, 'Austria'),
(4, 'Belgium'),
(5, 'Brazil'),
(6, 'Canada'),
(7, 'Chile'),
(8, 'China'),
(9, 'Croatia'),
(10, 'Czech Republic'),
(11, 'Finland'),
(12, 'France'),
(13, 'Germany'),
(14, 'Guatemala'),
(15, 'Hungary'),
(16, 'India'),
(17, 'Italy'),
(18, 'Japan'),
(19, 'Malaysia'),
(20, 'Mexico'),
(21, 'Morocco'),
(22, 'Netherlands'),
(23, 'Norway'),
(24, 'Philippines'),
(25, 'Poland'),
(26, 'Portugal'),
(27, 'Romania'),
(28, 'Singapore'),
(29, 'Spain'),
(30, 'Sweden'),
(31, 'Switzerland'),
(32, 'USA'),
(33, 'United Kingdom'),
(34, 'Vietnam');

-- --------------------------------------------------------

--
-- Table structure for table `tb_country_lang_lookup`
--

CREATE TABLE `tb_country_lang_lookup` (
  `mapping_id` int(3) NOT NULL,
  `country` int(3) NOT NULL,
  `language` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_languages_lookup`
--

CREATE TABLE `tb_languages_lookup` (
  `language_id` int(3) NOT NULL,
  `language` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_languages_lookup`
--

INSERT INTO `tb_languages_lookup` (`language_id`, `language`) VALUES
(1, 'English'),
(2, 'French'),
(3, 'Spanish'),
(4, 'Simplified Chinese'),
(5, 'Dutch');

-- --------------------------------------------------------

--
-- Table structure for table `tb_learners`
--

CREATE TABLE `tb_learners` (
  `learner_id` int(7) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `local_employee_id` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `sbu` varchar(30) NOT NULL,
  `bu` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `role` varchar(30) NOT NULL,
  `practice` varchar(30) NOT NULL,
  `organization_name` varchar(30) NOT NULL,
  `direct_line_manager` varchar(40) NOT NULL,
  `employee_start_date` date NOT NULL,
  `user_status` varchar(15) NOT NULL,
  `added_to_tool` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_macros_lookup`
--

CREATE TABLE `tb_macros_lookup` (
  `macro_id` int(3) NOT NULL,
  `macro_display_name` varchar(25) NOT NULL,
  `macro_column_name` varchar(25) NOT NULL,
  `reference_table` varchar(20) NOT NULL,
  `campaign_type` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_macros_lookup`
--

INSERT INTO `tb_macros_lookup` (`macro_id`, `macro_display_name`, `macro_column_name`, `reference_table`, `campaign_type`) VALUES
(1, 'Activity Code', '', '', ''),
(2, 'Activity Name', '', '', ''),
(3, 'Launch URL', '', '', ''),
(4, 'Assigned Date', '', '', ''),
(5, 'Due Date', '', '', ''),
(6, 'Assignment Status', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mail_hits`
--

CREATE TABLE `tb_mail_hits` (
  `hit_id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `notification_id` int(5) NOT NULL,
  `activity_map_id` int(7) NOT NULL,
  `hit_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mail_tracker`
--

CREATE TABLE `tb_mail_tracker` (
  `mail_id` int(11) NOT NULL,
  `learner_id` int(11) NOT NULL,
  `notification_id` int(7) NOT NULL,
  `send_status` varchar(10) NOT NULL,
  `sent_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notification_type_lookup`
--

CREATE TABLE `tb_notification_type_lookup` (
  `notification_type_id` int(3) NOT NULL,
  `notification_type` varchar(20) NOT NULL,
  `assignment_type` varchar(15) NOT NULL,
  `type_definition` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rules_lookup`
--

CREATE TABLE `tb_rules_lookup` (
  `rule_id` int(3) NOT NULL,
  `rule_display_name` varchar(30) NOT NULL,
  `rule_column_name` varchar(25) NOT NULL,
  `reference_table` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rules_lookup`
--

INSERT INTO `tb_rules_lookup` (`rule_id`, `rule_display_name`, `rule_column_name`, `reference_table`) VALUES
(1, 'Country', '', ''),
(2, 'SBU', '', ''),
(3, 'Grade', '', ''),
(4, 'Role', '', ''),
(5, 'Assignment Status', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sbu_lookup`
--

CREATE TABLE `tb_sbu_lookup` (
  `sbu_id` int(3) NOT NULL,
  `sbu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_sbu_lookup`
--

INSERT INTO `tb_sbu_lookup` (`sbu_id`, `sbu`) VALUES
(1, 'APPS1'),
(2, 'APPS2'),
(3, 'BIBA'),
(4, 'BPO'),
(5, 'BUSSERV'),
(6, 'CC'),
(7, 'COMCOR'),
(8, 'COR'),
(9, 'DCX'),
(10, 'EURIWARE'),
(11, 'FS'),
(12, 'IBSA'),
(13, 'INDGP'),
(14, 'INFRA'),
(15, 'INVEST'),
(16, 'PROSODIE'),
(17, 'SOG'),
(18, 'TESTING');

-- --------------------------------------------------------

--
-- Table structure for table `tb_templates`
--

CREATE TABLE `tb_templates` (
  `template_id` int(5) NOT NULL,
  `template_title` int(100) NOT NULL,
  `header_bg_color` varchar(10) NOT NULL,
  `body_bg_color` varchar(10) NOT NULL,
  `footer_bg_color` varchar(10) NOT NULL,
  `default_language` varchar(20) NOT NULL,
  `cc_manager` tinyint(1) NOT NULL,
  `send_from` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_templates_lang_map`
--

CREATE TABLE `tb_templates_lang_map` (
  `mapping_id` int(7) NOT NULL,
  `template_id` int(5) NOT NULL,
  `language` varchar(30) CHARACTER SET latin1 NOT NULL,
  `subject` varchar(100) CHARACTER SET latin1 NOT NULL,
  `salutation` varchar(30) CHARACTER SET latin1 NOT NULL,
  `header_image` varchar(300) CHARACTER SET latin1 NOT NULL,
  `body_1` text CHARACTER SET latin1 NOT NULL,
  `body_2` text CHARACTER SET latin1 NOT NULL,
  `body_3` text CHARACTER SET latin1 NOT NULL,
  `footer` varchar(300) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_templates_macro_map`
--

CREATE TABLE `tb_templates_macro_map` (
  `mappgin_id` int(7) NOT NULL,
  `template_id` int(5) NOT NULL,
  `macro_id` int(3) NOT NULL,
  `sequence_number` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(4) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(10) NOT NULL,
  `date_joined` date NOT NULL,
  `last_logged_in` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_assignments_data`
--
ALTER TABLE `tb_assignments_data`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `tb_campaigns`
--
ALTER TABLE `tb_campaigns`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `tb_campaign_activity_map`
--
ALTER TABLE `tb_campaign_activity_map`
  ADD PRIMARY KEY (`mapping_id`);

--
-- Indexes for table `tb_campaign_learners_map`
--
ALTER TABLE `tb_campaign_learners_map`
  ADD PRIMARY KEY (`mapping_id`);

--
-- Indexes for table `tb_campaign_notifications`
--
ALTER TABLE `tb_campaign_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `tb_campaign_rules_map`
--
ALTER TABLE `tb_campaign_rules_map`
  ADD PRIMARY KEY (`mapping_id`);

--
-- Indexes for table `tb_countries_lookup`
--
ALTER TABLE `tb_countries_lookup`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tb_country_lang_lookup`
--
ALTER TABLE `tb_country_lang_lookup`
  ADD PRIMARY KEY (`mapping_id`);

--
-- Indexes for table `tb_languages_lookup`
--
ALTER TABLE `tb_languages_lookup`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `tb_learners`
--
ALTER TABLE `tb_learners`
  ADD PRIMARY KEY (`learner_id`);

--
-- Indexes for table `tb_macros_lookup`
--
ALTER TABLE `tb_macros_lookup`
  ADD PRIMARY KEY (`macro_id`);

--
-- Indexes for table `tb_mail_hits`
--
ALTER TABLE `tb_mail_hits`
  ADD PRIMARY KEY (`hit_id`);

--
-- Indexes for table `tb_mail_tracker`
--
ALTER TABLE `tb_mail_tracker`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `tb_notification_type_lookup`
--
ALTER TABLE `tb_notification_type_lookup`
  ADD PRIMARY KEY (`notification_type_id`);

--
-- Indexes for table `tb_rules_lookup`
--
ALTER TABLE `tb_rules_lookup`
  ADD PRIMARY KEY (`rule_id`);

--
-- Indexes for table `tb_sbu_lookup`
--
ALTER TABLE `tb_sbu_lookup`
  ADD PRIMARY KEY (`sbu_id`);

--
-- Indexes for table `tb_templates`
--
ALTER TABLE `tb_templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `tb_templates_lang_map`
--
ALTER TABLE `tb_templates_lang_map`
  ADD PRIMARY KEY (`mapping_id`);

--
-- Indexes for table `tb_templates_macro_map`
--
ALTER TABLE `tb_templates_macro_map`
  ADD PRIMARY KEY (`mappgin_id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_assignments_data`
--
ALTER TABLE `tb_assignments_data`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_campaigns`
--
ALTER TABLE `tb_campaigns`
  MODIFY `campaign_id` tinyint(5) NOT NULL AUTO_INCREMENT COMMENT 'Unique reference id for each campaign', AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_campaign_activity_map`
--
ALTER TABLE `tb_campaign_activity_map`
  MODIFY `mapping_id` smallint(5) NOT NULL AUTO_INCREMENT COMMENT 'not used anywhere else';
--
-- AUTO_INCREMENT for table `tb_campaign_learners_map`
--
ALTER TABLE `tb_campaign_learners_map`
  MODIFY `mapping_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_campaign_notifications`
--
ALTER TABLE `tb_campaign_notifications`
  MODIFY `notification_id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_campaign_rules_map`
--
ALTER TABLE `tb_campaign_rules_map`
  MODIFY `mapping_id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_countries_lookup`
--
ALTER TABLE `tb_countries_lookup`
  MODIFY `country_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tb_country_lang_lookup`
--
ALTER TABLE `tb_country_lang_lookup`
  MODIFY `mapping_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_languages_lookup`
--
ALTER TABLE `tb_languages_lookup`
  MODIFY `language_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_learners`
--
ALTER TABLE `tb_learners`
  MODIFY `learner_id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_macros_lookup`
--
ALTER TABLE `tb_macros_lookup`
  MODIFY `macro_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_mail_hits`
--
ALTER TABLE `tb_mail_hits`
  MODIFY `hit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_mail_tracker`
--
ALTER TABLE `tb_mail_tracker`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_notification_type_lookup`
--
ALTER TABLE `tb_notification_type_lookup`
  MODIFY `notification_type_id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_rules_lookup`
--
ALTER TABLE `tb_rules_lookup`
  MODIFY `rule_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_sbu_lookup`
--
ALTER TABLE `tb_sbu_lookup`
  MODIFY `sbu_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tb_templates`
--
ALTER TABLE `tb_templates`
  MODIFY `template_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_templates_lang_map`
--
ALTER TABLE `tb_templates_lang_map`
  MODIFY `mapping_id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_templates_macro_map`
--
ALTER TABLE `tb_templates_macro_map`
  MODIFY `mappgin_id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
