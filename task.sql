-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2021 at 07:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'ABC Inc.', '0', '0', '1234 Main St. Los Angeles, CA 98765 U.S.A.', '(123) 456-7890', 'United States of America', 'Sample message<br>', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Administrator', 'a:28:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:13:\"createProject\";i:9;s:13:\"updateProject\";i:10;s:11:\"viewProject\";i:11;s:13:\"deleteProject\";i:12;s:12:\"createModule\";i:13;s:12:\"updateModule\";i:14;s:10:\"viewModule\";i:15;s:12:\"deleteModule\";i:16;s:18:\"createModuleStatus\";i:17;s:18:\"updateModuleStatus\";i:18;s:16:\"viewModuleStatus\";i:19;s:18:\"deleteModuleStatus\";i:20;s:17:\"createTasksLabels\";i:21;s:17:\"updateTasksLabels\";i:22;s:15:\"viewTasksLabels\";i:23;s:17:\"deleteTasksLabels\";i:24;s:19:\"createTasksPriority\";i:25;s:19:\"updateTasksPriority\";i:26;s:17:\"viewTasksPriority\";i:27;s:19:\"deleteTasksPriority\";}'),
(4, 'ADMIN', 'a:24:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:13:\"createProject\";i:9;s:13:\"updateProject\";i:10;s:11:\"viewProject\";i:11;s:13:\"deleteProject\";i:12;s:12:\"createModule\";i:13;s:12:\"updateModule\";i:14;s:10:\"viewModule\";i:15;s:12:\"deleteModule\";i:16;s:18:\"createModuleStatus\";i:17;s:18:\"updateModuleStatus\";i:18;s:16:\"viewModuleStatus\";i:19;s:18:\"deleteModuleStatus\";i:20;s:17:\"createTasksLabels\";i:21;s:17:\"updateTasksLabels\";i:22;s:15:\"viewTasksLabels\";i:23;s:17:\"deleteTasksLabels\";}'),
(5, 'TEAM LEADER (IT)', 'a:28:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:13:\"createProject\";i:9;s:13:\"updateProject\";i:10;s:11:\"viewProject\";i:11;s:13:\"deleteProject\";i:12;s:12:\"createModule\";i:13;s:12:\"updateModule\";i:14;s:10:\"viewModule\";i:15;s:12:\"deleteModule\";i:16;s:18:\"createModuleStatus\";i:17;s:18:\"updateModuleStatus\";i:18;s:16:\"viewModuleStatus\";i:19;s:18:\"deleteModuleStatus\";i:20;s:17:\"createTasksLabels\";i:21;s:17:\"updateTasksLabels\";i:22;s:15:\"viewTasksLabels\";i:23;s:17:\"deleteTasksLabels\";i:24;s:19:\"createTasksPriority\";i:25;s:19:\"updateTasksPriority\";i:26;s:17:\"viewTasksPriority\";i:27;s:19:\"deleteTasksPriority\";}'),
(6, 'TEAM LEADER (MIS)', 'a:21:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:11:\"createGroup\";i:4;s:11:\"updateGroup\";i:5;s:9:\"viewGroup\";i:6;s:13:\"createProject\";i:7;s:13:\"updateProject\";i:8;s:11:\"viewProject\";i:9;s:12:\"createModule\";i:10;s:12:\"updateModule\";i:11;s:10:\"viewModule\";i:12;s:18:\"createModuleStatus\";i:13;s:18:\"updateModuleStatus\";i:14;s:16:\"viewModuleStatus\";i:15;s:17:\"createTasksLabels\";i:16;s:17:\"updateTasksLabels\";i:17;s:15:\"viewTasksLabels\";i:18;s:19:\"createTasksPriority\";i:19;s:19:\"updateTasksPriority\";i:20;s:17:\"viewTasksPriority\";}'),
(7, 'DEVELOPER', 'a:7:{i:0;s:8:\"viewUser\";i:1;s:9:\"viewGroup\";i:2;s:11:\"viewProject\";i:3;s:10:\"viewModule\";i:4;s:16:\"viewModuleStatus\";i:5;s:15:\"viewTasksLabels\";i:6;s:17:\"viewTasksPriority\";}'),
(8, 'IT SUPPORT', 'a:7:{i:0;s:8:\"viewUser\";i:1;s:9:\"viewGroup\";i:2;s:11:\"viewProject\";i:3;s:10:\"viewModule\";i:4;s:16:\"viewModuleStatus\";i:5;s:15:\"viewTasksLabels\";i:6;s:17:\"viewTasksPriority\";}');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `team` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active, 0=Inactive',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `description`, `project_id`, `team`, `active`, `created_by`, `created_at`) VALUES
(1, 'Audit', 'Audit Software', 1, NULL, 1, 8, NULL),
(2, 'Hardware', 'Hardware', 1, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modules_status`
--

CREATE TABLE `modules_status` (
  `id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `default_value` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1 COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules_status`
--

INSERT INTO `modules_status` (`id`, `status_name`, `sort_order`, `default_value`, `active`) VALUES
(1, 'Pending', 0, 1, 1),
(2, 'Assaigned', 1, NULL, 1),
(3, 'Running', 2, NULL, 1),
(4, 'Completed', 3, NULL, 1),
(5, 'Postponed', 4, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active, 0=Inactive',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `description`, `team`, `active`, `created_by`, `created_at`) VALUES
(1, 'Audit', 'Audit Software11', NULL, 1, 8, NULL),
(2, 'Hardware1', 'Hardware1', NULL, 1, NULL, NULL),
(3, 'test', 'test', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(3, 'Warehouse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks_labels`
--

CREATE TABLE `tasks_labels` (
  `id` int(11) NOT NULL,
  `level_name` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(11) DEFAULT 0,
  `default_value` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks_labels`
--

INSERT INTO `tasks_labels` (`id`, `level_name`, `sort_order`, `default_value`, `active`) VALUES
(1, 'Task', 0, 1, 1),
(2, 'Bug', 1, NULL, 1),
(3, 'Idea', 2, NULL, 1),
(4, 'Issue', 4, NULL, 1),
(5, 'Quote', 3, NULL, 1),
(6, 'Change', 0, NULL, 1),
(7, 'PlugIn', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks_priority`
--

CREATE TABLE `tasks_priority` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(64) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `default_value` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks_priority`
--

INSERT INTO `tasks_priority` (`id`, `name`, `icon`, `sort_order`, `default_value`, `active`) VALUES
(1, 'Urgent', 'prio_1.png', 5, NULL, 1),
(2, 'High', 'prio_2.png', 4, NULL, 1),
(3, 'Low', 'prio_4.png', 1, NULL, 1),
(4, 'Unknown', NULL, 0, NULL, 1),
(5, 'Medum', 'prio_3.png', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `status`) VALUES
(1, 'Saidul Islam Sheik', '$2y$10$ZrBk2zWOLhPAaOhncDBJv.pKAfhFYywahFQXY4NXDmhOcaRtLdAfS', 'admin@admin.com', 1),
(8, 'Saidul Islam Sheik', '$2y$10$cNv0XOMMHZ69wL1coOkXiuSy.QhAnrXXmPNRIgrc7EDUhhHyeIQK6', 'saidul@cdipbd.org', 1),
(9, 'Sheik Rezwanul Islam', '$2y$10$q9LCphdj57pcel1SpwRM8u2bAMxd2OPB74s6SaJOlICJJxJaW.c7W', 'rezwanul@cdipbd.org', 1),
(10, 'Deep Kumar Mollick', '$2y$10$vXNo9x0L7OEznCk2hGDoXuIdPCH.oH0fLnMVlN/5JPooYpaeGpd6G', 'deep@cdipbd.org', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(9, 8, 4),
(10, 9, 8),
(11, 10, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_projects_pople` (`created_by`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `modules_status`
--
ALTER TABLE `modules_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_projects_pople` (`created_by`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks_labels`
--
ALTER TABLE `tasks_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks_priority`
--
ALTER TABLE `tasks_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modules_status`
--
ALTER TABLE `modules_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks_labels`
--
ALTER TABLE `tasks_labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks_priority`
--
ALTER TABLE `tasks_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
