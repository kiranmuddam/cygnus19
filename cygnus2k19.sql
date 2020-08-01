-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 01, 2020 at 06:24 AM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cygnus2k19-copy2`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch_categories`
--

CREATE TABLE `branch_categories` (
  `branch` varchar(50) NOT NULL,
  `displayname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This cantnot be empty...';

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `sno` int(6) NOT NULL,
  `stuid` varchar(50) NOT NULL,
  `msg` text NOT NULL,
  `rply` text,
  `ip` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eid` int(50) NOT NULL,
  `eventname` varchar(50) DEFAULT NULL,
  `imagename` varchar(100) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `participants` int(10) DEFAULT NULL,
  `minparticipants` int(10) DEFAULT NULL,
  `isyearrestrictions` varchar(10) DEFAULT NULL,
  `description` text,
  `instructions` text,
  `organizers` text,
  `orgcount` int(5) DEFAULT '0',
  `schedule` text,
  `prizes` text,
  `winners` text,
  `views` int(50) NOT NULL DEFAULT '0',
  `visibility` int(10) NOT NULL DEFAULT '1',
  `areregistrationson` varchar(10) NOT NULL DEFAULT 'on',
  `reg_stoppedby` varchar(50) DEFAULT NULL,
  `timestopped` varchar(50) DEFAULT NULL,
  `ipstopped` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `sno` int(50) NOT NULL,
  `eid` int(10) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `eventname` varchar(50) NOT NULL,
  `teamid` int(10) NOT NULL,
  `ids` varchar(200) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `regdone_by` varchar(50) NOT NULL,
  `regdone_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `regdone_ip` varchar(50) NOT NULL,
  `visibility` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations_log`
--

CREATE TABLE `event_registrations_log` (
  `sno` int(50) NOT NULL,
  `eid` int(10) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `eventname` varchar(50) NOT NULL,
  `teamid` int(10) NOT NULL,
  `ids` varchar(200) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `regdone_by` varchar(50) NOT NULL,
  `regdone_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `regdone_ip` varchar(50) NOT NULL,
  `visibility` int(2) NOT NULL DEFAULT '1',
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_img` varchar(100) NOT NULL,
  `upload_by` varchar(30) NOT NULL,
  `upload_ip` varchar(30) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_events`
--

CREATE TABLE `gallery_events` (
  `id` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_img` varchar(100) NOT NULL,
  `upload_by` varchar(30) NOT NULL,
  `upload_ip` varchar(30) NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `nid` int(10) NOT NULL,
  `eid` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `attachments` varchar(150) DEFAULT NULL,
  `sd` varchar(50) NOT NULL,
  `views` int(10) DEFAULT '0',
  `visibility` int(2) NOT NULL DEFAULT '1',
  `added_by` varchar(150) NOT NULL,
  `role` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_date` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications_log`
--

CREATE TABLE `notifications_log` (
  `nid` int(10) NOT NULL,
  `eid` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `attachments` varchar(150) NOT NULL,
  `sd` varchar(50) NOT NULL,
  `views` int(10) DEFAULT '0',
  `visibility` int(2) NOT NULL DEFAULT '1',
  `added_by` varchar(150) NOT NULL,
  `role` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_date` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organizers`
--

CREATE TABLE `organizers` (
  `sno` int(50) NOT NULL,
  `orgid` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `orgpass` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `orgmob` varchar(10) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Organizer',
  `eids` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'offline',
  `acc_status` varchar(10) DEFAULT 'Access'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This cantnot be empty...';

-- --------------------------------------------------------

--
-- Table structure for table `page_logs_log`
--

CREATE TABLE `page_logs_log` (
  `id` int(11) NOT NULL,
  `enter_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(30) NOT NULL,
  `no_of_times` int(11) NOT NULL,
  `stuid` varchar(30) NOT NULL,
  `dates` date NOT NULL,
  `hub` varchar(200) NOT NULL,
  `page` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_poll_log`
--

CREATE TABLE `page_poll_log` (
  `id` int(11) NOT NULL,
  `enter_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(30) NOT NULL,
  `no_of_times` int(11) NOT NULL,
  `stuid` varchar(30) NOT NULL,
  `dates` date NOT NULL,
  `hub` varchar(200) NOT NULL,
  `page` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pollpage_logs`
--

CREATE TABLE `pollpage_logs` (
  `id` int(11) NOT NULL,
  `enter_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(30) NOT NULL,
  `no_of_times` int(11) NOT NULL,
  `stuid` varchar(30) NOT NULL,
  `dates` date NOT NULL,
  `hub` varchar(200) NOT NULL,
  `page` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poll_log`
--

CREATE TABLE `poll_log` (
  `id` int(11) NOT NULL,
  `team` varchar(100) NOT NULL,
  `old_count` int(11) NOT NULL,
  `new_count` int(11) NOT NULL,
  `description` text NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poll_teams`
--

CREATE TABLE `poll_teams` (
  `id` int(11) NOT NULL,
  `team` varchar(100) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `sno` int(10) NOT NULL,
  `function` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL DEFAULT 'on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(10) NOT NULL,
  `stuid` varchar(15) NOT NULL,
  `cygnusid` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `stuname` varchar(160) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `logins` int(10) NOT NULL DEFAULT '0',
  `edits` int(10) NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL,
  `lasttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `regfrom` enum('web','mobile','app') NOT NULL DEFAULT 'web',
  `status` enum('0','1','2','') NOT NULL DEFAULT '1',
  `campus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_old`
--

CREATE TABLE `users_old` (
  `sno` int(10) NOT NULL,
  `stuid` varchar(7) NOT NULL,
  `cygnusid` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `stuname` varchar(160) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `logins` int(10) NOT NULL DEFAULT '0',
  `edits` int(10) NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL,
  `lasttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `regfrom` enum('web','mobile','app') NOT NULL DEFAULT 'web',
  `status` enum('0','1','2','') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `login_by` varchar(50) NOT NULL,
  `login_ip` varchar(30) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_os` varchar(100) NOT NULL,
  `login_browser` varchar(100) NOT NULL,
  `login_status` enum('login','logout','Inactive','Blocked','Failed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `visits950` int(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voting_log1`
--

CREATE TABLE `voting_log1` (
  `id` int(11) NOT NULL,
  `voted_by` varchar(10) NOT NULL,
  `voted_for` varchar(10) NOT NULL,
  `voted_gender` varchar(10) NOT NULL,
  `voted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `voted_ip` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voting_log_backup`
--

CREATE TABLE `voting_log_backup` (
  `id` int(11) NOT NULL,
  `voted_by` varchar(10) NOT NULL,
  `voted_for` varchar(10) NOT NULL,
  `voted_gender` varchar(10) NOT NULL,
  `voted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `voted_ip` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voting_log_completed`
--

CREATE TABLE `voting_log_completed` (
  `id` int(11) NOT NULL,
  `voted_by` varchar(10) NOT NULL,
  `voted_for` varchar(10) NOT NULL,
  `voted_gender` varchar(10) NOT NULL,
  `voted_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `voted_ip` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voting_profile`
--

CREATE TABLE `voting_profile` (
  `id` int(11) NOT NULL,
  `stuid` varchar(10) NOT NULL,
  `stuname` varchar(100) NOT NULL,
  `stubio` varchar(1000) NOT NULL,
  `stugender` varchar(10) NOT NULL,
  `stupic` varchar(100) NOT NULL,
  `votes_count` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `year_categories`
--

CREATE TABLE `year_categories` (
  `year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch_categories`
--
ALTER TABLE `branch_categories`
  ADD UNIQUE KEY `branch` (`branch`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `event_registrations_log`
--
ALTER TABLE `event_registrations_log`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_events`
--
ALTER TABLE `gallery_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `notifications_log`
--
ALTER TABLE `notifications_log`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `organizers`
--
ALTER TABLE `organizers`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `page_logs_log`
--
ALTER TABLE `page_logs_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pollpage_logs`
--
ALTER TABLE `pollpage_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_log`
--
ALTER TABLE `poll_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_teams`
--
ALTER TABLE `poll_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users_old`
--
ALTER TABLE `users_old`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`visits950`);

--
-- Indexes for table `voting_log1`
--
ALTER TABLE `voting_log1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_log_backup`
--
ALTER TABLE `voting_log_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_log_completed`
--
ALTER TABLE `voting_log_completed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting_profile`
--
ALTER TABLE `voting_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `year_categories`
--
ALTER TABLE `year_categories`
  ADD PRIMARY KEY (`year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `sno` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `sno` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `event_registrations_log`
--
ALTER TABLE `event_registrations_log`
  MODIFY `sno` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `gallery_events`
--
ALTER TABLE `gallery_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `notifications_log`
--
ALTER TABLE `notifications_log`
  MODIFY `nid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `organizers`
--
ALTER TABLE `organizers`
  MODIFY `sno` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `page_logs_log`
--
ALTER TABLE `page_logs_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141613;
--
-- AUTO_INCREMENT for table `pollpage_logs`
--
ALTER TABLE `pollpage_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `poll_log`
--
ALTER TABLE `poll_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `poll_teams`
--
ALTER TABLE `poll_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9587;
--
-- AUTO_INCREMENT for table `users_old`
--
ALTER TABLE `users_old`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16376;
--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=847;
--
-- AUTO_INCREMENT for table `voting_log1`
--
ALTER TABLE `voting_log1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6576;
--
-- AUTO_INCREMENT for table `voting_log_backup`
--
ALTER TABLE `voting_log_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6576;
--
-- AUTO_INCREMENT for table `voting_log_completed`
--
ALTER TABLE `voting_log_completed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6576;
--
-- AUTO_INCREMENT for table `voting_profile`
--
ALTER TABLE `voting_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
