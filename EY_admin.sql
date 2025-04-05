-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2025 at 05:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EY_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_active`, `role`, `created_at`, `updated_at`) VALUES
(6, 'superadmin', 'dev@profitbyppc.com', 'e0d4e57fdad15104b7c5bc313f518f4d', 1, 1, '2025-04-05 18:25:21', '2025-04-05 18:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `blog_description` text NOT NULL,
  `blog_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner` longtext NOT NULL,
  `categories` longtext NOT NULL,
  `recent_achivement` longtext NOT NULL,
  `why_EY` longtext NOT NULL,
  `modes` longtext NOT NULL,
  `comprehensive` longtext NOT NULL,
  `usps` longtext NOT NULL,
  `testimonials` longtext NOT NULL,
  `blogs` longtext NOT NULL,
  `faqs` longtext NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_detail` tinyint(4) NOT NULL,
  `banner` longtext NOT NULL,
  `info` longtext NOT NULL,
  `about` longtext NOT NULL,
  `audience_profile` longtext NOT NULL,
  `course_outline` longtext NOT NULL,
  `program_deliveriables` longtext NOT NULL,
  `program_outcomes` longtext NOT NULL,
  `related_course` longtext NOT NULL,
  `why_EY` longtext NOT NULL,
  `testimonials` longtext NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page`
--

CREATE TABLE `home_page` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner` longtext NOT NULL,
  `solutions` longtext NOT NULL,
  `categories` longtext NOT NULL,
  `usps` longtext NOT NULL,
  `modes` longtext NOT NULL,
  `testimonials` longtext NOT NULL,
  `blogs` longtext NOT NULL,
  `faqs` longtext NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_page`
--

INSERT INTO `home_page` (`id`, `page_title`, `seo_title`, `seo_description`, `slug`, `banner`, `solutions`, `categories`, `usps`, `modes`, `testimonials`, `blogs`, `faqs`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Anim cum quos sed qu', 'Magna aut ab in anim', 'Exercitationem in mo', 'Reiciendis quos elig', '{\"banner_heading\":\"Omnis provident qui\",\"banner_content\":\"Obcaecati nisi iusto\",\"stu_count\":\"53\",\"lesson_count\":\"31\",\"rating_count\":\"88\",\"videos_count\":\"35\",\"banner_img\":\"\"}', '{\"solution_heading\":\"In quia et est dolor\",\"solution_title1\":\"Quia labore ut modi \",\"solution_img1\":\"\",\"solution_btn_url1\":\"Cum doloremque dolor\",\"solution_title2\":\"Qui et qui laboriosa\",\"solution_img2\":\"\",\"solution_btn_url2\":\"Ea voluptatum odit q\",\"solution_title3\":\"Qui tempora pariatur\",\"solution_img3\":\"\",\"solution_btn_url3\":\"Qui odio quis eum es\",\"solution_title4\":\"Id dolor soluta ius\",\"solution_img4\":\"\",\"solution_btn_url4\":\"Voluptatem Aliquam \",\"solution_title5\":null,\"solution_btn_url5\":null,\"solution_title6\":null,\"solution_btn_url6\":null}', '', '', '', '', '', '', 1, '2025-04-05 14:55:43', '2025-04-05 16:35:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page`
--
ALTER TABLE `home_page`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_page`
--
ALTER TABLE `home_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
