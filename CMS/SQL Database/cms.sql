-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 04:53 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Nature'),
(2, 'Space');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `post_user` int(3) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `post_user`, `comment_content`, `comment_date`) VALUES
(199, 677, 'user', 52, 'This cat is cute!', '2022-04-18'),
(200, 677, 'mirza', 125, 'It sure is!', '2022-04-18'),
(201, 677, 'elvis', 53, 'Mine\'s the same!', '2022-04-18'),
(202, 677, 'admin', 43, 'Hey. I am admin here and my cat also looks like this one.', '2022-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` int(255) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`) VALUES
(677, 0, 'Orange tabby cat', 'admin', 43, '2022-04-18', 'cat.jpg', 'Orange tabbies, also known as ginger cats are beloved worldwide. An orange tabby is an orange colored cat with a tabby coat pattern. Many people think that orange/ginger tabbies are a specific breed of cat. In actuality, “orange” and “ginger” refer to the cat’s coat color only. By contrast, the term “tabby” or “tabby cat” refers to the cat’s coat pattern. Neither the color nor coat pattern are considered an actual feline breed. However there’s more to these felines aside from their fiery good looks!', ''),
(678, 0, 'Orange tabby cat', 'admin', 43, '2022-04-17', 'Orange-cat.jpg', 'Orange tabbies, also known as ginger cats are beloved worldwide. An orange tabby is an orange colored cat with a tabby coat pattern. Many people think that orange/ginger tabbies are a specific breed of cat. In actuality, “orange” and “ginger” refer to the cat’s coat color only. By contrast, the term “tabby” or “tabby cat” refers to the cat’s coat pattern. Neither the color nor coat pattern are considered an actual feline breed. However there’s more to these felines aside from their fiery good looks!', ''),
(679, 0, 'Orange cat', 'admin', 43, '2022-04-16', 'orange-cat-tree.jpg', 'Orange Why do we love Ginger cats when there are so many other colours and breeds to choose from in the world? It is hard to say exactly why. It could be that we find the colouring of orange cats so striking. Perhaps we associate their colouring with a feisty personality as we do in humans. Maybe there is a certain something. At HouseSitMatch.com we come across quite a few Gingers and often marmalade cats kept as domestic pets. And we do think that while they are not a specific breed there is a certain je ne sais quoi that sets them apart. Read on to learn more about their history and perpetual appeal…', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'subscriber',
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$1234512345123451234512'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `randSalt`) VALUES
(43, 'admin', '$2y$10$123451234512345123451ujdbNOQF.98MW.NKZDYMje30tdDsZxYW', 'admin', '$2y$10$1234512345123451234512'),
(52, 'user', '$2y$10$123451234512345123451uPnd6pUGcVw9WlJQAYsowmHZLaJwl0TO', 'subscriber', '$2y$10$1234512345123451234512'),
(53, 'elvis', '$2y$10$123451234512345123451uX.XsKhhSlrFCOH.R1T/hvkLHrCulWyy', 'subscriber', '$2y$10$1234512345123451234512'),
(125, 'mirza', '$2y$12$i0vllBnyM5eszMEHIntazuLBOPQ7CNoE5IeaZ7dNe5gem4HRY6K2q', 'subscriber', '$2y$10$1234512345123451234512');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=680;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
