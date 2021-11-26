-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: enar
-- ------------------------------------------------------
-- Server version	5.5.5-10.5.3-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activities_goal_pcx`
--

DROP TABLE IF EXISTS `activities_goal_pcx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities_goal_pcx` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities_goal_pcx`
--

LOCK TABLES `activities_goal_pcx` WRITE;
/*!40000 ALTER TABLE `activities_goal_pcx` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities_goal_pcx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `additional`
--

DROP TABLE IF EXISTS `additional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `additional` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additional`
--

LOCK TABLES `additional` WRITE;
/*!40000 ALTER TABLE `additional` DISABLE KEYS */;
/*!40000 ALTER TABLE `additional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alimentation`
--

DROP TABLE IF EXISTS `alimentation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimentation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_pt` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_en` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_es` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `alimentation_type_id` int(10) unsigned NOT NULL,
  `alimentation_category_id` int(10) unsigned NOT NULL,
  `weekday_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alimentation_alimentation_type_id_foreign` (`alimentation_type_id`),
  KEY `alimentation_alimentation_category_id_foreign` (`alimentation_category_id`),
  KEY `alimentation_weekday_id_foreign` (`weekday_id`),
  CONSTRAINT `alimentation_alimentation_category_id_foreign` FOREIGN KEY (`alimentation_category_id`) REFERENCES `alimentation_category` (`id`),
  CONSTRAINT `alimentation_alimentation_type_id_foreign` FOREIGN KEY (`alimentation_type_id`) REFERENCES `alimentation_type` (`id`),
  CONSTRAINT `alimentation_weekday_id_foreign` FOREIGN KEY (`weekday_id`) REFERENCES `weekday` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimentation`
--

LOCK TABLES `alimentation` WRITE;
/*!40000 ALTER TABLE `alimentation` DISABLE KEYS */;
/*!40000 ALTER TABLE `alimentation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alimentation_category`
--

DROP TABLE IF EXISTS `alimentation_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimentation_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimentation_category`
--

LOCK TABLES `alimentation_category` WRITE;
/*!40000 ALTER TABLE `alimentation_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `alimentation_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alimentation_type`
--

DROP TABLE IF EXISTS `alimentation_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alimentation_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alimentation_type`
--

LOCK TABLES `alimentation_type` WRITE;
/*!40000 ALTER TABLE `alimentation_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `alimentation_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alternative`
--

DROP TABLE IF EXISTS `alternative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alternative` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flg_type` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alternative_question_id_foreign` (`question_id`),
  CONSTRAINT `alternative_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternative`
--

LOCK TABLES `alternative` WRITE;
/*!40000 ALTER TABLE `alternative` DISABLE KEYS */;
/*!40000 ALTER TABLE `alternative` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(10) unsigned NOT NULL,
  `leads_phone_call_id` int(10) unsigned DEFAULT NULL,
  `guest_book_id` int(10) unsigned DEFAULT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answer_question_id_foreign` (`question_id`),
  KEY `answer_leads_phone_call_id_foreign` (`leads_phone_call_id`),
  KEY `answer_guest_book_id_foreign` (`guest_book_id`),
  CONSTRAINT `answer_guest_book_id_foreign` FOREIGN KEY (`guest_book_id`) REFERENCES `guest_book` (`id`),
  CONSTRAINT `answer_leads_phone_call_id_foreign` FOREIGN KEY (`leads_phone_call_id`) REFERENCES `leads_phone_call` (`id`),
  CONSTRAINT `answer_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answer`
--

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;
/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_conf`
--

DROP TABLE IF EXISTS `app_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_conf` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cron_asaas_payments` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_conf`
--

LOCK TABLES `app_conf` WRITE;
/*!40000 ALTER TABLE `app_conf` DISABLE KEYS */;
INSERT INTO `app_conf` VALUES (1,'2020-09-15',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `app_conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_account`
--

DROP TABLE IF EXISTS `bank_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_id` int(10) unsigned DEFAULT NULL,
  `bank_account_type_id` int(10) unsigned DEFAULT NULL,
  `form_payment_id` int(10) unsigned DEFAULT NULL,
  `agency` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_account_bank_id_foreign` (`bank_id`),
  CONSTRAINT `bank_account_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_account`
--

LOCK TABLES `bank_account` WRITE;
/*!40000 ALTER TABLE `bank_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_account_type`
--

DROP TABLE IF EXISTS `bank_account_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_account_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_account_type`
--

LOCK TABLES `bank_account_type` WRITE;
/*!40000 ALTER TABLE `bank_account_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_account_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flg_page` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slide` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_pt` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_en` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_es` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_pt` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_en` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_es` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog_category_id` int(10) unsigned NOT NULL,
  `author_post` int(10) unsigned DEFAULT NULL,
  `user_cad_id` int(10) unsigned DEFAULT NULL,
  `count_likes` int(11) DEFAULT 0,
  `count_views` int(11) DEFAULT 0,
  `count_comments` int(11) DEFAULT 0,
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `scheduling_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_blog_category_id_foreign` (`blog_category_id`),
  KEY `blog_author_post_foreign` (`author_post`),
  KEY `blog_user_cad_id_foreign` (`user_cad_id`),
  CONSTRAINT `blog_author_post_foreign` FOREIGN KEY (`author_post`) REFERENCES `user` (`id`),
  CONSTRAINT `blog_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`),
  CONSTRAINT `blog_user_cad_id_foreign` FOREIGN KEY (`user_cad_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg_type` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_category`
--

LOCK TABLES `blog_category` WRITE;
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_tag`
--

DROP TABLE IF EXISTS `blog_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tag`
--

LOCK TABLES `blog_tag` WRITE;
/*!40000 ALTER TABLE `blog_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs_tags`
--

DROP TABLE IF EXISTS `blogs_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blogs_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(10) unsigned NOT NULL,
  `blog_tag_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_tags_blog_id_foreign` (`blog_id`),
  KEY `blogs_tags_blog_tag_id_foreign` (`blog_tag_id`),
  CONSTRAINT `blogs_tags_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  CONSTRAINT `blogs_tags_blog_tag_id_foreign` FOREIGN KEY (`blog_tag_id`) REFERENCES `blog_tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs_tags`
--

LOCK TABLES `blogs_tags` WRITE;
/*!40000 ALTER TABLE `blogs_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bonus_course`
--

DROP TABLE IF EXISTS `bonus_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonus_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned DEFAULT NULL,
  `img` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_pt` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bonus_course_course_id_foreign` (`course_id`),
  CONSTRAINT `bonus_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonus_course`
--

LOCK TABLES `bonus_course` WRITE;
/*!40000 ALTER TABLE `bonus_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `bonus_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `calendar_privacy_id` int(10) unsigned DEFAULT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annual_repeat` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calendar_calendar_privacy_id_foreign` (`calendar_privacy_id`),
  CONSTRAINT `calendar_calendar_privacy_id_foreign` FOREIGN KEY (`calendar_privacy_id`) REFERENCES `calendar_privacy` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES (1,'Feriados','Holidays','Feriado',1,'#f56d6d','1',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Pedagógico','Pedagogical','Pedagógico',1,'#f56d6d','1',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar_privacy`
--

DROP TABLE IF EXISTS `calendar_privacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar_privacy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suffix` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar_privacy`
--

LOCK TABLES `calendar_privacy` WRITE;
/*!40000 ALTER TABLE `calendar_privacy` DISABLE KEYS */;
INSERT INTO `calendar_privacy` VALUES (1,'Público','Public','Público','PU',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Privado','Private','Privado','PR',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `calendar_privacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned DEFAULT NULL,
  `place_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `contract_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `days_week` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_hours` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end_hours` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_site` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `does_registre` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `repetition` int(11) DEFAULT NULL,
  `permanence` int(11) DEFAULT NULL,
  `permanence_all` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_course_id_foreign` (`course_id`),
  KEY `class_city_id_foreign` (`city_id`),
  KEY `class_place_id_foreign` (`place_id`),
  CONSTRAINT `class_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `class_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `class_place_id_foreign` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_status`
--

DROP TABLE IF EXISTS `class_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_status`
--

LOCK TABLES `class_status` WRITE;
/*!40000 ALTER TABLE `class_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_teacher`
--

DROP TABLE IF EXISTS `class_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_teacher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(10) unsigned DEFAULT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_teacher`
--

LOCK TABLES `class_teacher` WRITE;
/*!40000 ALTER TABLE `class_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_course_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned DEFAULT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_classes` int(11) NOT NULL,
  `view_presencial` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_live` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orientative` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_course_id_foreign` (`course_id`),
  KEY `classes_class_id_foreign` (`class_id`),
  KEY `classes_content_course_id_foreign` (`content_course_id`),
  KEY `classes_team_id_foreign` (`team_id`),
  CONSTRAINT `classes_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  CONSTRAINT `classes_content_course_id_foreign` FOREIGN KEY (`content_course_id`) REFERENCES `content_course` (`id`),
  CONSTRAINT `classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `classes_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes_video_lesson`
--

DROP TABLE IF EXISTS `classes_video_lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes_video_lesson` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classes_id` int(10) unsigned DEFAULT NULL,
  `video_lesson_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_video_lesson_classes_id_foreign` (`classes_id`),
  KEY `classes_video_lesson_video_lesson_id_foreign` (`video_lesson_id`),
  CONSTRAINT `classes_video_lesson_classes_id_foreign` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `classes_video_lesson_video_lesson_id_foreign` FOREIGN KEY (`video_lesson_id`) REFERENCES `video` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes_video_lesson`
--

LOCK TABLES `classes_video_lesson` WRITE;
/*!40000 ALTER TABLE `classes_video_lesson` DISABLE KEYS */;
/*!40000 ALTER TABLE `classes_video_lesson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `blog_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `approved` int(11) DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `answer_from` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_blog_id_foreign` (`blog_id`),
  KEY `comment_user_id_foreign` (`user_id`),
  KEY `comment_approved_by_foreign` (`approved_by`),
  KEY `comment_answer_from_foreign` (`answer_from`),
  CONSTRAINT `comment_answer_from_foreign` FOREIGN KEY (`answer_from`) REFERENCES `comment` (`id`),
  CONSTRAINT `comment_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`),
  CONSTRAINT `comment_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  CONSTRAINT `comment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config_app`
--

DROP TABLE IF EXISTS `config_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `show_form_fields` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_list_fields` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `config_app_user_id_foreign` (`user_id`),
  CONSTRAINT `config_app_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config_app`
--

LOCK TABLES `config_app` WRITE;
/*!40000 ALTER TABLE `config_app` DISABLE KEYS */;
/*!40000 ALTER TABLE `config_app` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `construction`
--

DROP TABLE IF EXISTS `construction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `construction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_pt` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `capacity` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_pt` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_en` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_es` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_information_id` int(10) unsigned DEFAULT NULL,
  `construction_category_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `construction_school_information_id_foreign` (`school_information_id`),
  KEY `construction_construction_category_id_foreign` (`construction_category_id`),
  CONSTRAINT `construction_construction_category_id_foreign` FOREIGN KEY (`construction_category_id`) REFERENCES `construction_category` (`id`),
  CONSTRAINT `construction_school_information_id_foreign` FOREIGN KEY (`school_information_id`) REFERENCES `school_information` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `construction`
--

LOCK TABLES `construction` WRITE;
/*!40000 ALTER TABLE `construction` DISABLE KEYS */;
/*!40000 ALTER TABLE `construction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `construction_category`
--

DROP TABLE IF EXISTS `construction_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `construction_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `construction_category`
--

LOCK TABLES `construction_category` WRITE;
/*!40000 ALTER TABLE `construction_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `construction_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_pt` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_en` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_es` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_bg` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_pt` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_en` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_es` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_label` varchar(96) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_page_id` int(10) unsigned NOT NULL,
  `content_section_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_content_page_id_foreign` (`content_page_id`),
  KEY `content_content_section_id_foreign` (`content_section_id`),
  CONSTRAINT `content_content_page_id_foreign` FOREIGN KEY (`content_page_id`) REFERENCES `content_page` (`id`),
  CONSTRAINT `content_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_section` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'NÃO PERCA O ENAR 2020!',NULL,NULL,'VOCÊ ESTA PREPARADO?',NULL,NULL,'<p><span style=\"color: rgba(21, 21, 21, 0.8); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 18px; letter-spacing: 0.45px; text-align: center;\">Falta pouco para finalizar o tempo de matrícula - até dia 20/10/2020</span><br></p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',1,1,1,1,NULL,'2020-09-16 12:43:23','2020-09-16 12:59:59',NULL),(2,'Preparamos o melhor para você!',NULL,NULL,'Ainda não esta preparado?',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fa-file-pdf-o','Ebook','#link',1,2,1,1,NULL,'2020-09-16 17:39:50','2020-09-16 17:48:56',NULL),(3,'450',NULL,NULL,'Participantes',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',1,3,1,NULL,NULL,'2020-09-16 18:03:35','2020-09-16 18:03:35',NULL),(4,'78',NULL,NULL,'Ativos',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',1,3,1,NULL,NULL,'2020-09-16 18:03:55','2020-09-16 18:03:55',NULL),(5,'600',NULL,NULL,'Colaboradores',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',1,3,1,NULL,NULL,'2020-09-16 18:04:23','2020-09-16 18:04:23',NULL),(6,'FAQ',NULL,NULL,'Dúvidas Frequente',NULL,NULL,'Encontre aqui respostas para as suas dúvidas referentes ao Processo Seletivo Vestibulinho.',NULL,NULL,'faq.png',NULL,NULL,NULL,NULL,'','Mais informação','/faq',1,4,1,1,NULL,'2020-09-16 18:12:18','2020-09-16 18:21:08',NULL),(7,'Avaliações',NULL,NULL,'Provas e Gabaritos (antigas) ',NULL,NULL,'Aprenda com as experiências passadas! Consulte a lista das últimas provas e gabaritos.',NULL,NULL,'avaliation.png',NULL,NULL,NULL,NULL,'','Mais informação','/avaliation',1,4,1,1,NULL,'2020-09-16 18:13:27','2020-09-16 18:22:34',NULL),(8,'Calendário',NULL,NULL,'Agenda e Hórarios',NULL,NULL,'Fique a par de todos os acontecimentos referente as avaliações, sessões de estudos.',NULL,NULL,'clock.png',NULL,NULL,NULL,NULL,'','Mais informação','/calendar',1,4,1,1,NULL,'2020-09-16 18:14:36','2020-09-16 18:21:35',NULL),(9,'Vídeos',NULL,NULL,'Mais fácil impossível',NULL,NULL,'<p>Preparamos um série de palestras sobre o assunto.<br></p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','Assistir todos','#link',1,8,1,NULL,NULL,'2020-09-17 18:58:35','2020-09-17 18:58:35',NULL),(10,'Preparamos o melhor para você!',NULL,NULL,'Ainda não esta preparado?',NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fa-file-pdf-o','Ebook','#',3,10,1,1,NULL,'2020-09-18 11:37:37','2020-09-18 11:38:23',NULL),(11,'Conhecendo a Divindade',NULL,NULL,'Gabarito',NULL,NULL,'Material de estudo para o desenvolvimento do enar 2019 - em PDF, Ebook.',NULL,NULL,'enar-2019-b.jpg',NULL,NULL,NULL,NULL,'2019','Baixar arquivo','#',3,11,1,1,NULL,'2020-09-18 11:59:55','2020-09-18 13:23:09',NULL),(12,'Conhecendo a Divindade',NULL,NULL,'Prova',NULL,NULL,'<p>Material de estudo para o desenvolvimento do enar 2019 - em PDF, Ebook.<br></p>',NULL,NULL,'enar-2019-r.jpg',NULL,NULL,NULL,NULL,'2019','Baixar arquivo','#',3,11,1,NULL,NULL,'2020-09-18 12:27:03','2020-09-18 12:27:03',NULL),(13,'Profecias',NULL,NULL,'Gabarito',NULL,NULL,'<p>Material de estudo para o desenvolvimento do enar 2018 - em PDF, Ebook.<br></p>',NULL,NULL,'enar-2019-g.jpg',NULL,NULL,NULL,NULL,'2018','Baixar arquivo','#',3,11,1,NULL,NULL,'2020-09-18 12:28:26','2020-09-18 12:28:26',NULL),(14,'Profecias',NULL,NULL,'Prova',NULL,NULL,'<p>Material de estudo para o desenvolvimento do enar 2018 - em PDF, Ebook.<br></p>',NULL,NULL,'enar-2019-y.jpg',NULL,NULL,NULL,NULL,'2018','Baixar arquivo','#',3,11,1,NULL,NULL,'2020-09-18 13:20:46','2020-09-18 13:20:46',NULL),(15,'Do you provide any scripts with your templates?',NULL,NULL,'',NULL,NULL,'<p>Our templates do not include any additional scripts. Newsletter subscriptions, search fields, forums, image galleries (in HTML versions of Flash products) are inactive. Basic scripts can be easily added at www.zemez.io If you are not sure that the element you’re interested in is active please contact our Support Chat for clarification.<br></p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','',4,12,1,NULL,NULL,'2020-09-18 13:28:17','2020-09-18 13:33:45','2020-09-18 13:33:45');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_course`
--

DROP TABLE IF EXISTS `content_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_category_id` int(10) unsigned DEFAULT NULL,
  `img` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_pt` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_course_course_category_id_foreign` (`course_category_id`),
  CONSTRAINT `content_course_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_course`
--

LOCK TABLES `content_course` WRITE;
/*!40000 ALTER TABLE `content_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `content_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_page`
--

DROP TABLE IF EXISTS `content_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg_page` varchar(96) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `show` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `target` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_page`
--

LOCK TABLES `content_page` WRITE;
/*!40000 ALTER TABLE `content_page` DISABLE KEYS */;
INSERT INTO `content_page` VALUES (1,'Início',NULL,NULL,'home',1,1,NULL,'2020-09-15 20:30:24','2020-09-16 15:51:23',NULL,'1',1,NULL,'/'),(2,'Calendário',NULL,NULL,'calendar',1,1,NULL,'2020-09-15 20:57:44','2020-09-16 15:51:37',NULL,'1',2,NULL,'/calendar'),(3,'Provas e Gabaritos',NULL,NULL,'avaliation',1,1,NULL,'2020-09-16 11:39:47','2020-09-16 15:51:51',NULL,'1',3,NULL,'/avaliation'),(4,'FAQ',NULL,NULL,'faq',1,1,NULL,'2020-09-16 11:55:11','2020-09-16 15:54:09',NULL,'1',4,NULL,'/faq'),(5,'Contato',NULL,NULL,'contact',1,1,NULL,'2020-09-16 12:00:53','2020-09-16 15:54:18',NULL,'1',5,NULL,'/contact'),(6,'',NULL,NULL,'',1,NULL,NULL,'2020-09-16 13:35:47','2020-09-16 13:36:22','2020-09-16 13:36:22',NULL,NULL,NULL,NULL),(7,'Participar',NULL,NULL,'register',1,NULL,NULL,'2020-09-22 16:45:33','2020-09-22 16:45:33',NULL,'1',6,NULL,'/register');
/*!40000 ALTER TABLE `content_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content_section`
--

DROP TABLE IF EXISTS `content_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_section` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `component` varchar(96) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `component_order` int(11) DEFAULT NULL,
  `content_page_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content_section_content_page_id_foreign` (`content_page_id`),
  CONSTRAINT `content_section_content_page_id_foreign` FOREIGN KEY (`content_page_id`) REFERENCES `content_page` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content_section`
--

LOCK TABLES `content_section` WRITE;
/*!40000 ALTER TABLE `content_section` DISABLE KEYS */;
INSERT INTO `content_section` VALUES (1,'Contagem Regressiva',NULL,NULL,'Teste',NULL,NULL,'countdown',NULL,1,1,1,1,NULL,'2020-09-16 12:30:30','2020-09-16 12:54:05',NULL),(2,'Material',NULL,NULL,'.',NULL,NULL,'material',NULL,2,1,1,NULL,NULL,'2020-09-16 17:35:15','2020-09-16 17:35:15',NULL),(3,'Contadores',NULL,NULL,'.',NULL,NULL,'counters',NULL,3,1,1,1,NULL,'2020-09-16 18:00:43','2020-09-16 18:08:00',NULL),(4,'FAQ',NULL,NULL,'.',NULL,NULL,'faq',NULL,4,1,1,NULL,NULL,'2020-09-16 18:10:30','2020-09-16 18:10:30',NULL),(5,'Galerias Videos',NULL,NULL,'.',NULL,NULL,'gallery',NULL,5,1,1,NULL,NULL,'2020-09-16 18:59:40','2020-09-16 19:57:51','2020-09-16 19:57:51'),(6,'Testemunhos',NULL,NULL,'.',NULL,NULL,'testimonials',NULL,6,1,1,1,NULL,'2020-09-16 20:08:08','2020-09-16 20:09:34',NULL),(7,'Video',NULL,NULL,'',NULL,NULL,'video',NULL,8,1,1,1,NULL,'2020-09-17 18:35:40','2020-09-17 18:49:14',NULL),(8,'Texto videos',NULL,NULL,'',NULL,NULL,'text',NULL,7,1,1,NULL,NULL,'2020-09-17 18:49:35','2020-09-17 18:49:35',NULL),(9,'Calendário',NULL,NULL,'',NULL,NULL,'calendar',NULL,1,2,1,NULL,NULL,'2020-09-17 19:17:32','2020-09-17 19:17:32',NULL),(10,'Material',NULL,NULL,'',NULL,NULL,'material',NULL,1,3,1,NULL,NULL,'2020-09-18 11:34:42','2020-09-18 11:34:42',NULL),(11,'Provas e gabaritos antigos',NULL,NULL,'Área de estudo',NULL,NULL,'card',NULL,2,3,1,NULL,NULL,'2020-09-18 11:42:10','2020-09-18 11:42:10',NULL),(12,'Perguntas Frequentes',NULL,NULL,'',NULL,NULL,'accordion',NULL,1,4,1,1,NULL,'2020-09-18 13:26:01','2020-09-18 13:30:08',NULL),(13,'Tem alguma pergunta?',NULL,NULL,'Sinta-se à vontade para nos contatar através do formulário à direita.',NULL,NULL,'contact',NULL,1,5,1,1,NULL,'2020-09-21 12:24:46','2020-09-21 14:38:49',NULL),(14,'Mapa',NULL,NULL,'',NULL,NULL,'map',NULL,2,5,1,NULL,NULL,'2020-09-21 12:31:32','2020-09-21 12:31:32',NULL),(15,'Tabs',NULL,NULL,'',NULL,NULL,'tab',NULL,1,7,1,NULL,NULL,'2020-09-22 17:18:53','2020-09-22 17:18:53',NULL);
/*!40000 ALTER TABLE `content_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `corresponding_course_category`
--

DROP TABLE IF EXISTS `corresponding_course_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `corresponding_course_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_category_id` int(10) unsigned NOT NULL,
  `blog_category_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `corresponding_course_category_course_category_id_foreign` (`course_category_id`),
  KEY `corresponding_course_category_blog_category_id_foreign` (`blog_category_id`),
  CONSTRAINT `corresponding_course_category_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`),
  CONSTRAINT `corresponding_course_category_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corresponding_course_category`
--

LOCK TABLES `corresponding_course_category` WRITE;
/*!40000 ALTER TABLE `corresponding_course_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `corresponding_course_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_category_id` int(10) unsigned DEFAULT NULL,
  `place_id` int(10) unsigned DEFAULT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `name_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` double(11,2) DEFAULT NULL,
  `full_value` double(11,2) DEFAULT NULL,
  `description_pt` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `hours_load` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_percentage_workload` double(11,2) DEFAULT 0.00,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `video_link` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_modules` int(11) DEFAULT NULL,
  `service_hours` int(11) DEFAULT NULL,
  `hours_monitored_supervision` int(11) DEFAULT NULL,
  `inactive` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_course_category_id_foreign` (`course_category_id`),
  CONSTRAINT `course_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_additional`
--

DROP TABLE IF EXISTS `course_additional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_additional` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned DEFAULT NULL,
  `additional_id` int(10) unsigned DEFAULT NULL,
  `form_payment_id` int(10) unsigned DEFAULT NULL,
  `parcel` int(11) DEFAULT NULL,
  `value` double(11,2) DEFAULT NULL,
  `full_value` double(11,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_additional_course_id_foreign` (`course_id`),
  KEY `course_additional_additional_id_foreign` (`additional_id`),
  KEY `course_additional_form_payment_id_foreign` (`form_payment_id`),
  CONSTRAINT `course_additional_additional_id_foreign` FOREIGN KEY (`additional_id`) REFERENCES `additional` (`id`),
  CONSTRAINT `course_additional_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `course_additional_form_payment_id_foreign` FOREIGN KEY (`form_payment_id`) REFERENCES `form_payment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_additional`
--

LOCK TABLES `course_additional` WRITE;
/*!40000 ALTER TABLE `course_additional` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_additional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_bonus_course`
--

DROP TABLE IF EXISTS `course_bonus_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_bonus_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `bonus_course_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_bonus_course_course_id_foreign` (`course_id`),
  KEY `course_bonus_course_bonus_course_id_foreign` (`bonus_course_id`),
  CONSTRAINT `course_bonus_course_bonus_course_id_foreign` FOREIGN KEY (`bonus_course_id`) REFERENCES `bonus_course` (`id`),
  CONSTRAINT `course_bonus_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_bonus_course`
--

LOCK TABLES `course_bonus_course` WRITE;
/*!40000 ALTER TABLE `course_bonus_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_bonus_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_category`
--

DROP TABLE IF EXISTS `course_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `course_category_type_id` int(10) unsigned DEFAULT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_category_course_category_type_id_foreign` (`course_category_type_id`),
  CONSTRAINT `course_category_course_category_type_id_foreign` FOREIGN KEY (`course_category_type_id`) REFERENCES `course_category_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_category`
--

LOCK TABLES `course_category` WRITE;
/*!40000 ALTER TABLE `course_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_category_type`
--

DROP TABLE IF EXISTS `course_category_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_category_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg` varchar(96) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(96) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_category_type`
--

LOCK TABLES `course_category_type` WRITE;
/*!40000 ALTER TABLE `course_category_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_category_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_default_value`
--

DROP TABLE IF EXISTS `course_default_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_default_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `class_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_default_value_course_id_foreign` (`course_id`),
  KEY `course_default_value_class_id_foreign` (`class_id`),
  CONSTRAINT `course_default_value_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  CONSTRAINT `course_default_value_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_default_value`
--

LOCK TABLES `course_default_value` WRITE;
/*!40000 ALTER TABLE `course_default_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_default_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_discount`
--

DROP TABLE IF EXISTS `course_discount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_discount` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned DEFAULT NULL,
  `discount_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_discount_course_id_foreign` (`course_id`),
  KEY `course_discount_discount_id_foreign` (`discount_id`),
  CONSTRAINT `course_discount_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `course_discount_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_discount`
--

LOCK TABLES `course_discount` WRITE;
/*!40000 ALTER TABLE `course_discount` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_discount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_form_payment`
--

DROP TABLE IF EXISTS `course_form_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_form_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `form_payment_id` int(10) unsigned DEFAULT NULL,
  `parcel` int(11) DEFAULT NULL,
  `value` double(11,2) DEFAULT NULL,
  `full_value` double(11,2) DEFAULT NULL,
  `flg_main` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_form_payment_class_id_foreign` (`class_id`),
  KEY `course_form_payment_course_id_foreign` (`course_id`),
  CONSTRAINT `course_form_payment_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  CONSTRAINT `course_form_payment_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_form_payment`
--

LOCK TABLES `course_form_payment` WRITE;
/*!40000 ALTER TABLE `course_form_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_form_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_module`
--

DROP TABLE IF EXISTS `course_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_course_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `type` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_module_course_id_foreign` (`course_id`),
  KEY `course_module_class_id_foreign` (`class_id`),
  KEY `course_module_content_course_id_foreign` (`content_course_id`),
  CONSTRAINT `course_module_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  CONSTRAINT `course_module_content_course_id_foreign` FOREIGN KEY (`content_course_id`) REFERENCES `content_course` (`id`),
  CONSTRAINT `course_module_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_module`
--

LOCK TABLES `course_module` WRITE;
/*!40000 ALTER TABLE `course_module` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_supervision`
--

DROP TABLE IF EXISTS `course_supervision`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_supervision` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `value_1` double(11,2) DEFAULT 0.00,
  `value_2` double(11,2) DEFAULT 0.00,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_supervision_team_id_foreign` (`team_id`),
  CONSTRAINT `course_supervision_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_supervision`
--

LOCK TABLES `course_supervision` WRITE;
/*!40000 ALTER TABLE `course_supervision` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_supervision` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_supervision_courses`
--

DROP TABLE IF EXISTS `course_supervision_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_supervision_courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_supervision_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_supervision_courses_course_supervision_id_foreign` (`course_supervision_id`),
  KEY `course_supervision_courses_course_id_foreign` (`course_id`),
  CONSTRAINT `course_supervision_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `course_supervision_courses_course_supervision_id_foreign` FOREIGN KEY (`course_supervision_id`) REFERENCES `course_supervision` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_supervision_courses`
--

LOCK TABLES `course_supervision_courses` WRITE;
/*!40000 ALTER TABLE `course_supervision_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_supervision_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_teacher`
--

DROP TABLE IF EXISTS `course_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_teacher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned DEFAULT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_teacher`
--

LOCK TABLES `course_teacher` WRITE;
/*!40000 ALTER TABLE `course_teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discount` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` double(11,2) DEFAULT NULL,
  `percentage` double(11,2) DEFAULT NULL,
  `shelf_life` date DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discount`
--

LOCK TABLES `discount` WRITE;
/*!40000 ALTER TABLE `discount` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `english_level`
--

DROP TABLE IF EXISTS `english_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `english_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `english_level`
--

LOCK TABLES `english_level` WRITE;
/*!40000 ALTER TABLE `english_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `english_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `error_asaas`
--

DROP TABLE IF EXISTS `error_asaas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error_asaas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `json` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `error_asaas_order_id_foreign` (`order_id`),
  CONSTRAINT `error_asaas_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error_asaas`
--

LOCK TABLES `error_asaas` WRITE;
/*!40000 ALTER TABLE `error_asaas` DISABLE KEYS */;
/*!40000 ALTER TABLE `error_asaas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_pt` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_datetime` datetime DEFAULT NULL,
  `localization` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annual_repeat` int(11) DEFAULT NULL,
  `flg_special_date` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_status_id` int(10) unsigned NOT NULL,
  `calendar_id` int(10) unsigned NOT NULL,
  `calendar_privacy_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_class_status_id_foreign` (`class_status_id`),
  KEY `event_calendar_id_foreign` (`calendar_id`),
  KEY `event_calendar_privacy_id_foreign` (`calendar_privacy_id`),
  CONSTRAINT `event_calendar_id_foreign` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`),
  CONSTRAINT `event_calendar_privacy_id_foreign` FOREIGN KEY (`calendar_privacy_id`) REFERENCES `calendar_privacy` (`id`),
  CONSTRAINT `event_class_status_id_foreign` FOREIGN KEY (`class_status_id`) REFERENCES `class_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` VALUES (1,'Do you provide any scripts with your templates?','Our templates do not include any additional scripts. Newsletter subscriptions, search fields, forums, image galleries (in HTML versions of Flash products) are inactive. Basic scripts can be easily added at www.zemez.io If you are not sure that the element you’re interested in is active please contact our Support Chat for clarification.',1,NULL,NULL,'2020-09-18 14:42:54','2020-09-18 14:42:54',NULL),(2,'you provide any scripts with your templates?','Our templates do not include any additional scripts. Newsletter subscriptions, search fields, forums, image galleries (in HTML versions of Flash products) are inactive. Basic scripts can be easily added at www.zemez.io If you are not sure that the element you’re interested in is active please contact our Support Chat for clarification.',1,NULL,NULL,'2020-09-18 17:57:26','2020-09-18 17:57:26',NULL),(3,'provide any scripts with your templates?','Our templates do not include any additional scripts. Newsletter subscriptions, search fields, forums, image galleries (in HTML versions of Flash products) are inactive. Basic scripts can be easily added at www.zemez.io If you are not sure that the element you’re interested in is active please contact our Support Chat for clarification.',1,NULL,NULL,'2020-09-18 17:57:43','2020-09-18 17:57:43',NULL);
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature`
--

DROP TABLE IF EXISTS `feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feature` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_page_id` int(10) unsigned DEFAULT NULL,
  `icon` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feature_content_page_id_foreign` (`content_page_id`),
  CONSTRAINT `feature_content_page_id_foreign` FOREIGN KEY (`content_page_id`) REFERENCES `content_page` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature`
--

LOCK TABLES `feature` WRITE;
/*!40000 ALTER TABLE `feature` DISABLE KEYS */;
INSERT INTO `feature` VALUES (1,1,'.','450','Participantes',NULL,1,NULL,NULL,'2020-09-16 17:50:56','2020-09-16 17:50:56',NULL);
/*!40000 ALTER TABLE `feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `file_course_id_foreign` (`course_id`),
  CONSTRAINT `file_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_content_course`
--

DROP TABLE IF EXISTS `file_content_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file_content_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(10) unsigned DEFAULT NULL,
  `content_course_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_content_course`
--

LOCK TABLES `file_content_course` WRITE;
/*!40000 ALTER TABLE `file_content_course` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_content_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_payment`
--

DROP TABLE IF EXISTS `form_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg_type` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg_web` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg_free` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clause4_1b` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `clause4_2_1` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_payment`
--

LOCK TABLES `form_payment` WRITE;
/*!40000 ALTER TABLE `form_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `function`
--

DROP TABLE IF EXISTS `function`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `function` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg_teacher` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `function`
--

LOCK TABLES `function` WRITE;
/*!40000 ALTER TABLE `function` DISABLE KEYS */;
/*!40000 ALTER TABLE `function` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galery`
--

DROP TABLE IF EXISTS `galery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_pt` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_page_id` int(10) unsigned NOT NULL,
  `content_section_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `pretitle_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_label` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `galery_content_page_id_foreign` (`content_page_id`),
  KEY `galery_content_section_id_foreign` (`content_section_id`),
  CONSTRAINT `galery_content_page_id_foreign` FOREIGN KEY (`content_page_id`) REFERENCES `content_page` (`id`),
  CONSTRAINT `galery_content_section_id_foreign` FOREIGN KEY (`content_section_id`) REFERENCES `content_section` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galery`
--

LOCK TABLES `galery` WRITE;
/*!40000 ALTER TABLE `galery` DISABLE KEYS */;
INSERT INTO `galery` VALUES (1,'Vídeos',NULL,NULL,'',NULL,NULL,NULL,'clock.png',1,5,1,NULL,NULL,'2020-09-16 19:00:49','2020-09-16 19:26:36',NULL,'Mais fácil impossível','Preparamos um série de palestras sobre o assunto.','#link','Assistir todos');
/*!40000 ALTER TABLE `galery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goal_pcx`
--

DROP TABLE IF EXISTS `goal_pcx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goal_pcx` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flg_type` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `goal` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `finished` int(11) DEFAULT NULL,
  `goal_planned` double(11,2) DEFAULT NULL,
  `goal_executed` double(11,2) DEFAULT NULL,
  `p_planned` int(11) DEFAULT NULL,
  `p_executed` int(11) DEFAULT NULL,
  `c_planned` int(11) DEFAULT NULL,
  `c_executed` int(11) DEFAULT NULL,
  `x_planned` int(11) DEFAULT NULL,
  `x_executed` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goal_pcx_user_id_foreign` (`user_id`),
  CONSTRAINT `goal_pcx_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goal_pcx`
--

LOCK TABLES `goal_pcx` WRITE;
/*!40000 ALTER TABLE `goal_pcx` DISABLE KEYS */;
/*!40000 ALTER TABLE `goal_pcx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goal_pcx_full_activities`
--

DROP TABLE IF EXISTS `goal_pcx_full_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goal_pcx_full_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goal_pcx_id` int(10) unsigned NOT NULL,
  `activities_goal_pcx_id` int(10) unsigned NOT NULL,
  `executed` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goal_pcx_full_activities_goal_pcx_id_foreign` (`goal_pcx_id`),
  KEY `goal_pcx_full_activities_activities_goal_pcx_id_foreign` (`activities_goal_pcx_id`),
  CONSTRAINT `goal_pcx_full_activities_activities_goal_pcx_id_foreign` FOREIGN KEY (`activities_goal_pcx_id`) REFERENCES `activities_goal_pcx` (`id`),
  CONSTRAINT `goal_pcx_full_activities_goal_pcx_id_foreign` FOREIGN KEY (`goal_pcx_id`) REFERENCES `goal_pcx` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goal_pcx_full_activities`
--

LOCK TABLES `goal_pcx_full_activities` WRITE;
/*!40000 ALTER TABLE `goal_pcx_full_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `goal_pcx_full_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goal_pcx_full_pcx`
--

DROP TABLE IF EXISTS `goal_pcx_full_pcx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goal_pcx_full_pcx` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goal_pcx_id` int(10) unsigned NOT NULL,
  `pcx_id` int(10) unsigned NOT NULL,
  `executed` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goal_pcx_full_pcx_goal_pcx_id_foreign` (`goal_pcx_id`),
  CONSTRAINT `goal_pcx_full_pcx_goal_pcx_id_foreign` FOREIGN KEY (`goal_pcx_id`) REFERENCES `goal_pcx` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goal_pcx_full_pcx`
--

LOCK TABLES `goal_pcx_full_pcx` WRITE;
/*!40000 ALTER TABLE `goal_pcx_full_pcx` DISABLE KEYS */;
/*!40000 ALTER TABLE `goal_pcx_full_pcx` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `graduation`
--

DROP TABLE IF EXISTS `graduation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `graduation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `graduation`
--

LOCK TABLES `graduation` WRITE;
/*!40000 ALTER TABLE `graduation` DISABLE KEYS */;
/*!40000 ALTER TABLE `graduation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guest_book`
--

DROP TABLE IF EXISTS `guest_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest_book` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leads_id` int(10) unsigned DEFAULT NULL,
  `leads_visit_id` int(10) unsigned DEFAULT NULL,
  `guest_book_id` int(10) unsigned DEFAULT NULL,
  `question1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question4` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question5` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question6` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question7` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question8` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question9` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question10` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative1` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative2` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative3` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative4` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative5` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest_book`
--

LOCK TABLES `guest_book` WRITE;
/*!40000 ALTER TABLE `guest_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `guest_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guest_book_phone_calls`
--

DROP TABLE IF EXISTS `guest_book_phone_calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest_book_phone_calls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `guest_book_id` int(10) unsigned DEFAULT NULL,
  `contact_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guest_book_status_id` int(10) unsigned DEFAULT NULL,
  `observation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guest_book_phone_calls_guest_book_id_foreign` (`guest_book_id`),
  KEY `guest_book_phone_calls_guest_book_status_id_foreign` (`guest_book_status_id`),
  CONSTRAINT `guest_book_phone_calls_guest_book_id_foreign` FOREIGN KEY (`guest_book_id`) REFERENCES `guest_book` (`id`),
  CONSTRAINT `guest_book_phone_calls_guest_book_status_id_foreign` FOREIGN KEY (`guest_book_status_id`) REFERENCES `guest_book_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest_book_phone_calls`
--

LOCK TABLES `guest_book_phone_calls` WRITE;
/*!40000 ALTER TABLE `guest_book_phone_calls` DISABLE KEYS */;
/*!40000 ALTER TABLE `guest_book_phone_calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guest_book_status`
--

DROP TABLE IF EXISTS `guest_book_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guest_book_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `initials` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guest_book_status`
--

LOCK TABLES `guest_book_status` WRITE;
/*!40000 ALTER TABLE `guest_book_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `guest_book_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `introduction`
--

DROP TABLE IF EXISTS `introduction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `introduction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_payment_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `introduction_form_payment_id_foreign` (`form_payment_id`),
  CONSTRAINT `introduction_form_payment_id_foreign` FOREIGN KEY (`form_payment_id`) REFERENCES `form_payment` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `introduction`
--

LOCK TABLES `introduction` WRITE;
/*!40000 ALTER TABLE `introduction` DISABLE KEYS */;
/*!40000 ALTER TABLE `introduction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned DEFAULT NULL,
  `course_category_id` int(10) unsigned DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `is_formed_in_psychology` int(11) DEFAULT NULL,
  `level_of_interest` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `address` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `badge_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_line` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cel_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commercial_email` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commercial_phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complement` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dispatcher_organ` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg_type` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'P',
  `gender` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_contact` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_last_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_course_id_foreign` (`course_id`),
  KEY `leads_course_category_id_foreign` (`course_category_id`),
  CONSTRAINT `leads_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_category` (`id`),
  CONSTRAINT `leads_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_phone_call`
--

DROP TABLE IF EXISTS `leads_phone_call`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads_phone_call` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leads_id` int(10) unsigned DEFAULT NULL,
  `contact_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `leads_status_id` int(10) unsigned DEFAULT NULL,
  `observation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `question1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question2` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question3` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question4` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question5` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question6` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question7` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question8` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question9` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question10` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative1` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative2` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative3` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative4` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternative5` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_phone_call`
--

LOCK TABLES `leads_phone_call` WRITE;
/*!40000 ALTER TABLE `leads_phone_call` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads_phone_call` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_status`
--

DROP TABLE IF EXISTS `leads_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `initials` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_status`
--

LOCK TABLES `leads_status` WRITE;
/*!40000 ALTER TABLE `leads_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads_visit`
--

DROP TABLE IF EXISTS `leads_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leads_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `consultant` int(10) unsigned DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `visit_time` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_description` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `complement` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_visit_leads_id_foreign` (`leads_id`),
  KEY `leads_visit_city_id_foreign` (`city_id`),
  KEY `leads_visit_course_id_foreign` (`course_id`),
  KEY `leads_visit_consultant_foreign` (`consultant`),
  CONSTRAINT `leads_visit_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `leads_visit_consultant_foreign` FOREIGN KEY (`consultant`) REFERENCES `user` (`id`),
  CONSTRAINT `leads_visit_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `leads_visit_leads_id_foreign` FOREIGN KEY (`leads_id`) REFERENCES `leads` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads_visit`
--

LOCK TABLES `leads_visit` WRITE;
/*!40000 ALTER TABLE `leads_visit` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads_visit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_footer`
--

DROP TABLE IF EXISTS `link_footer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link_footer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_footer`
--

LOCK TABLES `link_footer` WRITE;
/*!40000 ALTER TABLE `link_footer` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_footer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_tag`
--

DROP TABLE IF EXISTS `meta_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_page_id` int(10) unsigned NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_tag_content_page_id_foreign` (`content_page_id`),
  CONSTRAINT `meta_tag_content_page_id_foreign` FOREIGN KEY (`content_page_id`) REFERENCES `content_page` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_tag`
--

LOCK TABLES `meta_tag` WRITE;
/*!40000 ALTER TABLE `meta_tag` DISABLE KEYS */;
INSERT INTO `meta_tag` VALUES (1,1,'description','Vestibular Enar! Onde todo ano é feito uma prova em cima dos conhecimentos bíblicos, temas específicos, concorrendo com pessoas de todo o mundo',NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'keywords','Vestibular Enar, Vestibular, Enar, Enar Vestibular, conhecimento bíblico, bíblia, prova',NULL,NULL,NULL,NULL,NULL,NULL),(3,1,'generator','Gigapixel',NULL,NULL,NULL,NULL,'2020-09-15 20:48:57','2020-09-15 20:48:57'),(4,1,'creator','Gigapixel',NULL,NULL,NULL,NULL,'2020-09-15 20:48:57','2020-09-15 20:48:57'),(5,2,'description','Fique a par dos nosso eventos, preparamos um calendário com palestras, provas, vídeo aulas, Ebook, bate papo entre muito mais ',NULL,NULL,NULL,NULL,NULL,NULL),(6,2,'keywords','evento, palestra, calendário, provas, vídeos aulas, Ebook, bate papo',NULL,NULL,NULL,NULL,NULL,NULL),(7,3,'description','Para melhor desenvolvimento preparamos as provas antigas junto com seus gabaritos para um estudo mais avançado',NULL,NULL,NULL,NULL,NULL,NULL),(8,3,'keywords','avaliação, avaliações, prova, provas, gabaritos, gabarito, respostas',NULL,NULL,NULL,NULL,NULL,NULL),(9,4,'description','Preparamos uma área em especial para fazer perguntas e ver as  perguntas frequentes',NULL,NULL,NULL,NULL,NULL,NULL),(10,4,'keywords','perguntas, dúvidas, perguntas frequentes, dúvidas frequentes',NULL,NULL,NULL,NULL,NULL,NULL),(11,5,'description','Entre em contato conosco para mais informações, sugestões, dicas entre outros',NULL,NULL,NULL,NULL,NULL,NULL),(12,5,'keywords','contato, informações, dicas, sugestões, fale conosco',NULL,NULL,NULL,NULL,NULL,NULL),(13,7,'description','Deseja participar do Enar de 2020? cadastre-se e participe deste super evento',NULL,NULL,NULL,NULL,NULL,NULL),(14,7,'keywords','inscrever-se, inscrição, participar, ',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `meta_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_user_type_table',1),(2,'2014_10_12_100000_create_user_table',1),(3,'2014_10_12_200000_create_password_reset_table',1),(4,'2017_11_15_213005_create_content_page_table',1),(5,'2017_11_15_213114_create_content_section_table',1),(6,'2017_11_15_213125_create_content_table',1),(7,'2017_11_16_182124_create_alimentation_type_table',1),(8,'2017_11_16_182322_create_alimentation_category_table',1),(9,'2017_11_16_182526_create_weekday_table',1),(10,'2017_11_16_182751_create_alimentation_table',1),(11,'2017_11_16_183451_create_blog_category_table',1),(12,'2017_11_16_183620_create_blog_table',1),(13,'2017_11_16_185602_create_rel_category_blog_table',1),(14,'2017_11_16_190119_create_school_information_table',1),(15,'2017_11_16_191500_create_construction_category_table',1),(16,'2017_11_16_191527_create_construction_table',1),(17,'2017_11_16_192109_create_english_level_table',1),(18,'2017_11_16_192451_create_function_table',1),(19,'2017_11_16_192452_create_graduation_table',1),(20,'2017_11_16_192453_create_office_table',1),(21,'2017_11_16_192827_create_team_table',1),(22,'2017_11_16_193612_create_link_footer_table',1),(23,'2017_11_16_193612_create_work_with_us_table',1),(24,'2017_12_07_132401_create_month_table',1),(25,'2017_12_07_144816_populate_month_table',1),(26,'2017_12_07_220407_create_state_table',1),(27,'2017_12_07_220734_populate_state_table',1),(28,'2017_12_08_174628_create_slide_table',1),(29,'2017_12_08_181812_create_testemonial_table',1),(30,'2017_12_10_114134_create_calendar_privacy_table',1),(31,'2017_12_10_114136_create_calendar_table',1),(32,'2017_12_10_114137_create_class_status_table',1),(33,'2017_12_10_114138_create_event_table',1),(34,'2017_12_10_141950_populate_calendar_privacy_table',1),(35,'2017_12_10_155206_populate_weekday_table',1),(36,'2017_12_10_214201_populate_calendar_table',1),(37,'2018_02_01_000001_create_city_table',1),(38,'2018_02_01_000001_create_registry_status_table',1),(39,'2018_02_01_000005_create_leads_status_table',1),(40,'2018_02_01_000006_create_guest_book_status_table',1),(41,'2018_02_02_200002_create_leads_phone_calls_table',2),(42,'2018_02_02_200004_create_guest_book_table',3),(43,'2018_02_02_200005_create_guest_book_phone_calls_table',3),(44,'2018_05_28_145040_create_payment_history_table',4),(45,'2018_05_28_200005_create_registry_phone_calls_table',5),(46,'2018_06_28_144046_create_galery_table',5),(47,'2018_06_28_144058_create_photo_galery_table',5),(48,'2019_07_25_122742_create_config_app_table',5),(49,'2019_08_08_190951_create_parameters_app_table',5),(50,'2019_08_13_133232_create_goal_pcx_table',5),(51,'2019_08_14_122244_create_activities_goal_pcx_table',5),(52,'2019_08_15_135251_create_goal_pcx_full_pcx_table',6),(53,'2019_08_15_135321_create_goal_pcx_full_activities_table',6),(54,'2019_08_27_125919_create_question_table',6),(55,'2019_08_27_130011_create_alternative_table',6),(56,'2019_08_28_150741_create_answer_table',6),(57,'2019_09_15_162148_create_blog_tag_table',6),(58,'2019_09_15_162815_create_blogs_tags_table',6),(59,'2019_09_18_211949_create_comment_table',6),(60,'2019_11_16_000003_create_place_table',6),(61,'2019_11_21_211949_create_banner_table',6),(62,'2019_11_21_211949_create_feature_table',6),(63,'2019_11_25_000000_create_course_category_type_table',6),(64,'2019_11_25_000001_create_course_category_table',6),(65,'2019_11_25_000002_create_course_table',6),(66,'2019_11_25_000003_create_class_table',7),(67,'2019_12_01_000003_create_content_course_table',7),(68,'2019_12_16_000002_create_form_payment_table',7),(69,'2019_12_16_000002_create_type_payment_table',7),(70,'2019_12_16_000003_create_class_teacher_table',7),(71,'2019_12_16_000003_create_course_form_payment_table',7),(72,'2019_12_16_000003_create_course_teacher_table',7),(73,'2019_12_16_000003_create_patient_table',7),(74,'2019_12_16_000003_create_psychologist_table',7),(75,'2020_01_15_102321_create_course_default_value_table',7),(76,'2020_01_15_102321_create_course_supervision_table',7),(77,'2020_01_15_102322_create_corresponding_course_category_table',7),(78,'2020_01_15_102322_create_course_supervision_courses_table',7),(79,'2020_02_01_000004_create_bonus_course_table',7),(80,'2020_02_02_200001_create_leads_table',7),(81,'2020_02_02_200003_create_leads_visit_table',7),(82,'2020_02_14_102322_create_faq_table',7),(83,'2020_02_14_102322_create_responsible_seller_table',7),(84,'2020_02_20_102322_create_productivity_table',7),(85,'2020_02_20_102323_create_productivity_content_table',7),(86,'2020_03_10_141620_create_course_bonus_course_table',7),(87,'2020_03_11_091620_create_meta_tag_table',7),(88,'2020_03_16_173819_create_bank_table',7),(89,'2020_03_16_173820_create_bank_account_table',8),(90,'2020_03_16_173820_create_bank_account_type_table',8),(91,'2020_03_16_173820_create_introduction_table',8),(92,'2020_03_16_173820_create_phrase_table',8),(93,'2020_03_16_173820_create_student_table',8),(94,'2020_03_16_173820_create_video_table',8),(95,'2020_04_01_173820_create_order_table',8),(96,'2020_04_17_173820_create_file_content_course_table',9),(97,'2020_04_17_173820_create_order_parcel_table',9),(98,'2020_04_30_093323_create_contract_table',9),(99,'2020_05_08_143323_create_newsletter_table',9),(100,'2020_05_10_000002_create_course_module_table',9),(101,'2020_05_10_000003_create_classes_table',9),(102,'2020_05_10_173820_create_additional_table',9),(103,'2020_05_10_173820_create_app_conf_table',9),(104,'2020_05_10_173820_create_classes_video_lesson_table',9),(105,'2020_05_10_173820_create_error_asaas_table',9),(106,'2020_05_10_173820_create_periodicity_table',9),(107,'2020_05_10_173820_create_student_class_control_table',9),(108,'2020_05_10_173820_create_theses_monograph_table',9),(109,'2020_05_28_141047_create_registry_table',9),(110,'2020_05_28_145052_create_file_table',9),(111,'2020_06_10_173820_create_course_additional_table',9),(112,'2020_06_11_173820_create_discount_table',9),(113,'2020_06_11_173823_create_course_discount_table',9),(114,'3017_12_10_214201_populate_periodicity_table',9),(115,'3017_12_10_214201_populate_user_type_table',9),(116,'3017_12_11_214201_populate_user_table',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `month`
--

DROP TABLE IF EXISTS `month`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `month` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviation_pt` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviation_en` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviation_es` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suffix` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `month`
--

LOCK TABLES `month` WRITE;
/*!40000 ALTER TABLE `month` DISABLE KEYS */;
INSERT INTO `month` VALUES (1,'Janeiro','January','Enero','JAN','JAN','ENE','JR',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Fevereiro','February','Febrero','FEV','FEB','FEB','FB',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Março','March','Marzo','MAR','MAR','MAR','MR',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Abril','April','Abril','ABR','APR','ABR','AB',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Maio','May','Mayo','MAI','MAY','MAY','MI',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Junho','June','Junio','JUN','JUN','JUN','JN',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Julho','July','Julio','JUL','JUL','JUL','JL',NULL,NULL,NULL,NULL,NULL,NULL),(8,'Agosto','August','Agosto','AGO','AUG','AGO','AG',NULL,NULL,NULL,NULL,NULL,NULL),(9,'Setembro','September','Septiembre','SET','SEP','SEP','ST',NULL,NULL,NULL,NULL,NULL,NULL),(10,'Outubro','October','Octubre','OUT','OCT','OCT','OT',NULL,NULL,NULL,NULL,NULL,NULL),(11,'Novembro','November','Noviembre','NOV','NOV','NOV','NV',NULL,NULL,NULL,NULL,NULL,NULL),(12,'Dezembro','December','Diciembre','DEZ','DEC','DIC','DZ',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `month` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `office`
--

DROP TABLE IF EXISTS `office`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `office` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `office`
--

LOCK TABLES `office` WRITE;
/*!40000 ALTER TABLE `office` DISABLE KEYS */;
/*!40000 ALTER TABLE `office` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'PE',
  `form_payment` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned DEFAULT NULL,
  `course_form_payment_id` int(10) unsigned DEFAULT NULL,
  `form_payment_id` int(10) unsigned DEFAULT NULL,
  `bank_id` int(10) unsigned DEFAULT NULL,
  `supervision_id` int(10) unsigned DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `value` double(11,2) DEFAULT 0.00,
  `value_paid` double(11,2) DEFAULT 0.00,
  `payday` timestamp NULL DEFAULT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `number_parcel` int(11) DEFAULT NULL,
  `cardholder` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_card` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `security_code` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `shelf_life` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_number` varchar(96) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contract` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `repetition` int(11) DEFAULT NULL,
  `permanence` int(11) DEFAULT NULL,
  `permanence_all` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asaas_payments_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asaas_customers_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asaas_json` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `imported` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_student_id_foreign` (`student_id`),
  KEY `order_course_id_foreign` (`course_id`),
  KEY `order_class_id_foreign` (`class_id`),
  KEY `order_course_form_payment_id_foreign` (`course_form_payment_id`),
  KEY `order_form_payment_id_foreign` (`form_payment_id`),
  KEY `order_bank_id_foreign` (`bank_id`),
  CONSTRAINT `order_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`),
  CONSTRAINT `order_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  CONSTRAINT `order_course_form_payment_id_foreign` FOREIGN KEY (`course_form_payment_id`) REFERENCES `course_form_payment` (`id`),
  CONSTRAINT `order_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `order_form_payment_id_foreign` FOREIGN KEY (`form_payment_id`) REFERENCES `form_payment` (`id`),
  CONSTRAINT `order_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_parcel`
--

DROP TABLE IF EXISTS `order_parcel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_parcel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `form_payment_id` int(10) unsigned DEFAULT NULL,
  `bank_id` int(10) unsigned DEFAULT NULL,
  `n` int(11) DEFAULT NULL,
  `code` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `payday` timestamp NULL DEFAULT NULL,
  `value` double(11,2) DEFAULT 0.00,
  `value_paid` double(11,2) DEFAULT 0.00,
  `asaas_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asaas_json` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_parcel_order_id_foreign` (`order_id`),
  KEY `order_parcel_form_payment_id_foreign` (`form_payment_id`),
  KEY `order_parcel_bank_id_foreign` (`bank_id`),
  CONSTRAINT `order_parcel_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`),
  CONSTRAINT `order_parcel_form_payment_id_foreign` FOREIGN KEY (`form_payment_id`) REFERENCES `form_payment` (`id`),
  CONSTRAINT `order_parcel_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_parcel`
--

LOCK TABLES `order_parcel` WRITE;
/*!40000 ALTER TABLE `order_parcel` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_parcel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parameters_app`
--

DROP TABLE IF EXISTS `parameters_app`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameters_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parameters_app_user_id_foreign` (`user_id`),
  CONSTRAINT `parameters_app_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parameters_app`
--

LOCK TABLES `parameters_app` WRITE;
/*!40000 ALTER TABLE `parameters_app` DISABLE KEYS */;
/*!40000 ALTER TABLE `parameters_app` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_reset_email_index` (`email`),
  KEY `password_reset_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset`
--

LOCK TABLES `password_reset` WRITE;
/*!40000 ALTER TABLE `password_reset` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recommendation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `initial_complaint` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_state_id_foreign` (`state_id`),
  CONSTRAINT `patient_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_history`
--

DROP TABLE IF EXISTS `payment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registry_id` int(10) unsigned DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `value` double(8,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_history`
--

LOCK TABLES `payment_history` WRITE;
/*!40000 ALTER TABLE `payment_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodicity`
--

DROP TABLE IF EXISTS `periodicity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodicity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodicity`
--

LOCK TABLES `periodicity` WRITE;
/*!40000 ALTER TABLE `periodicity` DISABLE KEYS */;
INSERT INTO `periodicity` VALUES (1,'Diária',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Semanal',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Quinzenal',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Mensal',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Bimestral',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Trimestral',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Quadrimestral',NULL,NULL,NULL,NULL,NULL,NULL),(8,'Semestral',NULL,NULL,NULL,NULL,NULL,NULL),(9,'Anual',NULL,NULL,NULL,NULL,NULL,NULL),(10,'Bienal',NULL,NULL,NULL,NULL,NULL,NULL),(11,'Trienal',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `periodicity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo_galery`
--

DROP TABLE IF EXISTS `photo_galery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo_galery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `galery_id` int(10) unsigned NOT NULL,
  `title_pt` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_galery_galery_id_foreign` (`galery_id`),
  CONSTRAINT `photo_galery_galery_id_foreign` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo_galery`
--

LOCK TABLES `photo_galery` WRITE;
/*!40000 ALTER TABLE `photo_galery` DISABLE KEYS */;
/*!40000 ALTER TABLE `photo_galery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phrase`
--

DROP TABLE IF EXISTS `phrase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phrase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phrase` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phrase`
--

LOCK TABLES `phrase` WRITE;
/*!40000 ALTER TABLE `phrase` DISABLE KEYS */;
INSERT INTO `phrase` VALUES (1,'Duke Ellington','enar-2019-y.jpg','<p>Os problemas são oportunidades para se mostrar o que sabe.</p>',1,1,NULL,'2020-09-17 18:27:19','2020-09-21 16:39:02',NULL),(2,' Henry Ford',NULL,'<p>Nossos fracassos, às vezes, são mais frutíferos do que os êxitos.<br></p>',1,NULL,NULL,'2020-09-21 16:39:29','2020-09-21 16:39:29',NULL),(3,'Samuel Beckett',NULL,'<p>Tente de novo. Fracasse de novo. Mas fracasse melhor.<br></p>',1,NULL,NULL,'2020-09-21 16:39:54','2020-09-21 16:39:54',NULL);
/*!40000 ALTER TABLE `phrase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `place` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productivity`
--

DROP TABLE IF EXISTS `productivity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productivity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `weekday` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productivity_user_id_foreign` (`user_id`),
  CONSTRAINT `productivity_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productivity`
--

LOCK TABLES `productivity` WRITE;
/*!40000 ALTER TABLE `productivity` DISABLE KEYS */;
/*!40000 ALTER TABLE `productivity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productivity_content`
--

DROP TABLE IF EXISTS `productivity_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productivity_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productivity_id` int(10) unsigned NOT NULL,
  `type` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `productivity_content_productivity_id_foreign` (`productivity_id`),
  CONSTRAINT `productivity_content_productivity_id_foreign` FOREIGN KEY (`productivity_id`) REFERENCES `productivity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productivity_content`
--

LOCK TABLES `productivity_content` WRITE;
/*!40000 ALTER TABLE `productivity_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `productivity_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `psychologist`
--

DROP TABLE IF EXISTS `psychologist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `psychologist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialties` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `crp` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `met` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `complement` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `psychologist_state_id_foreign` (`state_id`),
  CONSTRAINT `psychologist_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `psychologist`
--

LOCK TABLES `psychologist` WRITE;
/*!40000 ALTER TABLE `psychologist` DISABLE KEYS */;
/*!40000 ALTER TABLE `psychologist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `flg_type` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `flg_pcx` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flg_source` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registry`
--

DROP TABLE IF EXISTS `registry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `leads_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned DEFAULT NULL,
  `city_id` int(10) unsigned DEFAULT NULL,
  `consultant` int(10) unsigned DEFAULT NULL,
  `start_payment_date` date DEFAULT NULL,
  `form_payment` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_value` double(8,2) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `total_payble` double(8,2) DEFAULT NULL,
  `number_installments` int(11) DEFAULT NULL,
  `installments_sd` int(11) DEFAULT NULL,
  `installments_cd` int(11) DEFAULT NULL,
  `expiry_payment_day` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_payment` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_person` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cnpj` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insc_est` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_cpf` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_rg` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_address` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_number` int(11) DEFAULT NULL,
  `responsible_complement` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_district` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_city` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_state` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_zip_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_cel_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_email` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_contact_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_contact_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_contact_cel_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_contact_email` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_observation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registry_leads_id_foreign` (`leads_id`),
  KEY `registry_course_id_foreign` (`course_id`),
  KEY `registry_class_id_foreign` (`class_id`),
  KEY `registry_city_id_foreign` (`city_id`),
  KEY `registry_consultant_foreign` (`consultant`),
  CONSTRAINT `registry_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `registry_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  CONSTRAINT `registry_consultant_foreign` FOREIGN KEY (`consultant`) REFERENCES `user` (`id`),
  CONSTRAINT `registry_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `registry_leads_id_foreign` FOREIGN KEY (`leads_id`) REFERENCES `leads` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registry`
--

LOCK TABLES `registry` WRITE;
/*!40000 ALTER TABLE `registry` DISABLE KEYS */;
/*!40000 ALTER TABLE `registry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registry_phone_calls`
--

DROP TABLE IF EXISTS `registry_phone_calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registry_phone_calls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registry_id` int(10) unsigned DEFAULT NULL,
  `contact_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_contact` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registry_status_id` int(10) unsigned DEFAULT NULL,
  `observation` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registry_phone_calls`
--

LOCK TABLES `registry_phone_calls` WRITE;
/*!40000 ALTER TABLE `registry_phone_calls` DISABLE KEYS */;
/*!40000 ALTER TABLE `registry_phone_calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registry_status`
--

DROP TABLE IF EXISTS `registry_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registry_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `initials` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registry_status`
--

LOCK TABLES `registry_status` WRITE;
/*!40000 ALTER TABLE `registry_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `registry_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rel_category_blog`
--

DROP TABLE IF EXISTS `rel_category_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rel_category_blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(10) unsigned DEFAULT NULL,
  `blog_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rel_category_blog_blog_category_id_foreign` (`blog_category_id`),
  KEY `rel_category_blog_blog_id_foreign` (`blog_id`),
  CONSTRAINT `rel_category_blog_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_category` (`id`),
  CONSTRAINT `rel_category_blog_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rel_category_blog`
--

LOCK TABLES `rel_category_blog` WRITE;
/*!40000 ALTER TABLE `rel_category_blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_category_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsible_seller`
--

DROP TABLE IF EXISTS `responsible_seller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsible_seller` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `leads_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responsible_seller_user_id_foreign` (`user_id`),
  KEY `responsible_seller_leads_id_foreign` (`leads_id`),
  CONSTRAINT `responsible_seller_leads_id_foreign` FOREIGN KEY (`leads_id`) REFERENCES `leads` (`id`),
  CONSTRAINT `responsible_seller_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsible_seller`
--

LOCK TABLES `responsible_seller` WRITE;
/*!40000 ALTER TABLE `responsible_seller` DISABLE KEYS */;
/*!40000 ALTER TABLE `responsible_seller` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_information`
--

DROP TABLE IF EXISTS `school_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_information` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `complement` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `uf` int(11) NOT NULL,
  `cep` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `phone1` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone3` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_phone1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_phone2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_phone3` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email3` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_pt` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_en` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_es` varchar(4000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `multilanguage` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_information` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `asaas_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asaas_token` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flg_main` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `map_iframe` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_information`
--

LOCK TABLES `school_information` WRITE;
/*!40000 ALTER TABLE `school_information` DISABLE KEYS */;
INSERT INTO `school_information` VALUES (1,'Enar','Centro de Eventos da União Sul City Castello','00','','Bairro','Itu',25,'00000-000','(00) 0000-0000','',NULL,'(11) 1 1111-1111','',NULL,'contato@enar.com.br','',NULL,'logo.png','@enar','','@enar','','','@enar',NULL,NULL,NULL,NULL,'','','','1',1,1,NULL,'2020-09-18 18:36:56','2020-09-21 14:03:49',NULL,'			<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14646.31835617144!2d-47.2880744!3d-23.4034215!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xbab1db5d5222bb94!2sCentro%20de%20Eventos%20da%20Uni%C3%A3o%20Sul!5e0!3m2!1spt-BR!2sbr!4v1600115442437!5m2!1spt-BR!2sbr\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>');
/*!40000 ALTER TABLE `school_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slide`
--

DROP TABLE IF EXISTS `slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slide` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pretitle_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pretitle_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pretitle_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_page_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slide_content_page_id_foreign` (`content_page_id`),
  CONSTRAINT `slide_content_page_id_foreign` FOREIGN KEY (`content_page_id`) REFERENCES `content_page` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slide`
--

LOCK TABLES `slide` WRITE;
/*!40000 ALTER TABLE `slide` DISABLE KEYS */;
INSERT INTO `slide` VALUES (1,'',NULL,NULL,'PREPARE-SE PARA O ENAR 2020',NULL,NULL,'Agora de um jeito mais facil e pratico para fazer, sem sair de casa.',NULL,NULL,'carosel01.png',NULL,'Participar','#link',1,1,1,NULL,'2020-09-16 12:49:30','2020-09-21 19:13:27',NULL),(2,'',NULL,NULL,'#1 PLACE',NULL,NULL,'Agora de um jeito mais facil e pratico para fazer, sem sair de casa.',NULL,NULL,'carosel02.png',NULL,'Participar','#link',1,1,1,NULL,'2020-09-16 12:50:59','2020-09-21 19:15:55',NULL),(3,'',NULL,NULL,'#2 PLACE',NULL,NULL,'Agora de um jeito mais facil e pratico para fazer, sem sair de casa.',NULL,NULL,'carosel03.png',NULL,'Participar','#link',1,1,1,NULL,'2020-09-16 12:51:46','2020-09-21 19:16:03',NULL),(4,'',NULL,NULL,'Calendário',NULL,NULL,'',NULL,NULL,'banner_calendar.png',NULL,'','',2,1,NULL,NULL,'2020-09-17 19:32:23','2020-09-17 19:32:23',NULL),(5,'',NULL,NULL,'Provas e Gabaritos',NULL,NULL,'',NULL,NULL,'avaliation_banner.png',NULL,'','',3,1,NULL,NULL,'2020-09-18 11:18:53','2020-09-18 11:18:53',NULL),(6,'',NULL,NULL,'Contato',NULL,NULL,'',NULL,NULL,'banner_contato.png',NULL,'','/contact',5,1,NULL,NULL,'2020-09-21 14:39:59','2020-09-21 14:39:59',NULL),(7,'',NULL,NULL,'Perguntas Frequêntes',NULL,NULL,'',NULL,NULL,'faq_banner.png',NULL,'','/faq',4,1,NULL,NULL,'2020-09-21 16:19:01','2020-09-21 16:19:01',NULL),(8,'',NULL,NULL,'Inscrição',NULL,NULL,'',NULL,NULL,'register.png',NULL,'','',7,1,NULL,NULL,'2020-09-22 17:09:49','2020-09-22 17:09:49',NULL);
/*!40000 ALTER TABLE `slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviation` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES (1,'Acre','AC',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Alagoas','AL',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Amapá','AP',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Amazonas','AM',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Bahia','BA',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Ceará','CE',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Distrito Federal','DF',NULL,NULL,NULL,NULL,NULL,NULL),(8,'Espírito Santo','ES',NULL,NULL,NULL,NULL,NULL,NULL),(9,'Goiás','GO',NULL,NULL,NULL,NULL,NULL,NULL),(10,'Maranhão','MA',NULL,NULL,NULL,NULL,NULL,NULL),(11,'Mato Grosso','MT',NULL,NULL,NULL,NULL,NULL,NULL),(12,'Mato Grosso do Sul','MS',NULL,NULL,NULL,NULL,NULL,NULL),(13,'Minas Gerais','MG',NULL,NULL,NULL,NULL,NULL,NULL),(14,'Pará','PA',NULL,NULL,NULL,NULL,NULL,NULL),(15,'Paraíba','PB',NULL,NULL,NULL,NULL,NULL,NULL),(16,'Paraná','PR',NULL,NULL,NULL,NULL,NULL,NULL),(17,'Pernambuco','PE',NULL,NULL,NULL,NULL,NULL,NULL),(18,'Piauí','PI',NULL,NULL,NULL,NULL,NULL,NULL),(19,'Rio de Janeiro','RJ',NULL,NULL,NULL,NULL,NULL,NULL),(20,'Rio Grande do Norte','RN',NULL,NULL,NULL,NULL,NULL,NULL),(21,'Rio Grande do Sul','RS',NULL,NULL,NULL,NULL,NULL,NULL),(22,'Rôndonia','RO',NULL,NULL,NULL,NULL,NULL,NULL),(23,'Roraima','RR',NULL,NULL,NULL,NULL,NULL,NULL),(24,'Santa Catarina','SC',NULL,NULL,NULL,NULL,NULL,NULL),(25,'São Paulo','SP',NULL,NULL,NULL,NULL,NULL,NULL),(26,'Sergipe','SE',NULL,NULL,NULL,NULL,NULL,NULL),(27,'Tocantins','TO',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asaas_code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_phone` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complement` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `formation` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tcc_experience` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_confirmation_code` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `more_information` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_state_id_foreign` (`state_id`),
  CONSTRAINT `student_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_class_control`
--

DROP TABLE IF EXISTS `student_class_control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_class_control` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `student_id` int(10) unsigned DEFAULT NULL,
  `course_id` int(10) unsigned DEFAULT NULL,
  `class_id` int(10) unsigned DEFAULT NULL,
  `classes_id` int(10) unsigned DEFAULT NULL,
  `content_course_id` int(10) unsigned DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `presence` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_class_control_order_id_foreign` (`order_id`),
  KEY `student_class_control_student_id_foreign` (`student_id`),
  KEY `student_class_control_course_id_foreign` (`course_id`),
  KEY `student_class_control_class_id_foreign` (`class_id`),
  KEY `student_class_control_classes_id_foreign` (`classes_id`),
  KEY `student_class_control_content_course_id_foreign` (`content_course_id`),
  CONSTRAINT `student_class_control_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  CONSTRAINT `student_class_control_classes_id_foreign` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `student_class_control_content_course_id_foreign` FOREIGN KEY (`content_course_id`) REFERENCES `content_course` (`id`),
  CONSTRAINT `student_class_control_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  CONSTRAINT `student_class_control_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `student_class_control_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_class_control`
--

LOCK TABLES `student_class_control` WRITE;
/*!40000 ALTER TABLE `student_class_control` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_class_control` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `description_pt` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_pt` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_en` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label_image_es` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `crp` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `school_information_id` int(10) unsigned DEFAULT NULL,
  `graduation_id` int(10) unsigned DEFAULT NULL,
  `function_id` int(10) unsigned DEFAULT NULL,
  `office_id` int(10) unsigned DEFAULT NULL,
  `english_level_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_school_information_id_foreign` (`school_information_id`),
  KEY `team_graduation_id_foreign` (`graduation_id`),
  KEY `team_function_id_foreign` (`function_id`),
  KEY `team_office_id_foreign` (`office_id`),
  KEY `team_english_level_id_foreign` (`english_level_id`),
  CONSTRAINT `team_english_level_id_foreign` FOREIGN KEY (`english_level_id`) REFERENCES `english_level` (`id`),
  CONSTRAINT `team_function_id_foreign` FOREIGN KEY (`function_id`) REFERENCES `function` (`id`),
  CONSTRAINT `team_graduation_id_foreign` FOREIGN KEY (`graduation_id`) REFERENCES `graduation` (`id`),
  CONSTRAINT `team_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `office` (`id`),
  CONSTRAINT `team_school_information_id_foreign` FOREIGN KEY (`school_information_id`) REFERENCES `school_information` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testemonial`
--

DROP TABLE IF EXISTS `testemonial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testemonial` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_pt` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_en` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_es` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `abstract_pt` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abstract_en` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abstract_es` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_page_id` int(10) unsigned NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testemonial_content_page_id_foreign` (`content_page_id`),
  CONSTRAINT `testemonial_content_page_id_foreign` FOREIGN KEY (`content_page_id`) REFERENCES `content_page` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testemonial`
--

LOCK TABLES `testemonial` WRITE;
/*!40000 ALTER TABLE `testemonial` DISABLE KEYS */;
INSERT INTO `testemonial` VALUES (1,'Helen Russell','Regular Client','I am extremely pleased with the process of purchasing my new Honda Africa Twin from Brightcycle. I knew exactly what I wanted so it was easy to choose and purchase this motorcycle.										',NULL,NULL,'I am extremely pleased with the process of purchasing my new Honda Africa Twin from Brightcycle. I knew exactly what I wanted so it was easy to choose and purchase this motorcycle.',NULL,NULL,'user-5-69x69.jpg','1',1,1,1,NULL,'2020-09-16 21:01:10','2020-09-17 14:16:08',NULL),(2,'ERIC THOMPSON','Regular Client','										',NULL,NULL,'Extremely helpful staff. The team at Brightcycle saved my road trip! I called all over town looking for a new motorcycle and they provided me with what I needed, quickly and efficiently.',NULL,NULL,'user-13-89x89.jpg','1',1,1,1,NULL,'2020-09-17 12:24:42','2020-09-17 14:08:24',NULL),(3,'JOSEPH WILSON','Regular Client','										',NULL,NULL,'I\'ve bought two motorcycles from this place and never plan to shop anywhere else! Low-pressure atmosphere, friendly mechanics, and excellent prices. I\'m treated like family here!',NULL,NULL,'user-12-89x89.jpg','1',1,1,1,NULL,'2020-09-17 12:26:00','2020-09-17 14:12:11',NULL),(4,'Gary Wood','Regular Client','<font color=\"#6a9955\">Great, friendly service. Brightcycle never tried to sell me something I don\'t need. They\'ve never snobbed my weird taste in motorbikes and that’s why I recommend them to everyone!</font>',NULL,NULL,'Great, friendly service. Brightcycle never tried to sell me something I don\'t need. They\'ve never snobbed my weird taste in motorbikes and that’s why I recommend them to everyone!',NULL,NULL,'user-14-89x89.jpg','1',1,1,1,NULL,'2020-09-17 13:13:39','2020-09-17 14:12:17',NULL),(5,'Amy Washington','Regular Client','										',NULL,NULL,'This place is awesome.  I was looking for a reliable place to buy a motorcycle and Brightcycle team proved to be extremely friendly and helpful. They set me up with the Kawasaki Ninja.',NULL,NULL,'user-11-450x541.jpg','1',1,1,1,NULL,'2020-09-17 13:17:18','2020-09-17 14:12:22',NULL);
/*!40000 ALTER TABLE `testemonial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theses_monograph`
--

DROP TABLE IF EXISTS `theses_monograph`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theses_monograph` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_category_id` int(10) unsigned DEFAULT NULL,
  `author` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `theses_monograph_course_category_id_foreign` (`course_category_id`),
  CONSTRAINT `theses_monograph_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theses_monograph`
--

LOCK TABLES `theses_monograph` WRITE;
/*!40000 ALTER TABLE `theses_monograph` DISABLE KEYS */;
/*!40000 ALTER TABLE `theses_monograph` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_payment`
--

DROP TABLE IF EXISTS `type_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_payment`
--

LOCK TABLES `type_payment` WRITE;
/*!40000 ALTER TABLE `type_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `consultant` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `admin` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `user_type_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_user_name_unique` (`user_name`),
  UNIQUE KEY `user_email_unique` (`email`),
  KEY `user_user_type_id_foreign` (`user_type_id`),
  CONSTRAINT `user_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,NULL,'Administrador','admin','joel.zanata@gigapixel.com.br','$2y$10$zJ2OXPXl62q1gz6orRU14.mlysv.tUP.nLqxbpkTSiC57siH0atWe','S','N','S',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Administrador','1',NULL,NULL,NULL,NULL,NULL),(2,'Consultor de vendas','2',NULL,NULL,NULL,NULL,NULL),(3,'Autor do Blog','3',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (1,'Criatividade','','https://www.youtube.com/watch?v=FAwSi4L37_8&ab_channel=VivaJovem',1,1,NULL,'2020-09-17 17:26:18','2020-09-17 18:22:26',NULL,'video1.jpg'),(2,'Sigam-me os bons','<p><br></p>','https://www.youtube.com/watch?v=EPjoHCejsjA&ab_channel=VivaJovem',1,1,NULL,'2020-09-17 17:52:53','2020-09-17 18:23:09',NULL,'video2.jpg'),(3,'Tamo Junto','<p><br></p>','https://www.youtube.com/watch?v=f0jNTMVKBYQ&ab_channel=VivaJovem',1,1,NULL,'2020-09-17 17:53:10','2020-09-17 18:24:03',NULL,'video3.jpg'),(4,'Identidade','<p><br></p>','https://www.youtube.com/watch?v=3qQeAb1GTQQ&ab_channel=VivaJovem',1,1,NULL,'2020-09-17 18:03:24','2020-09-17 18:24:29',NULL,'video4.jpg'),(5,'teste33','<p>ertertete</p>','/about',1,NULL,NULL,'2020-09-17 18:05:03','2020-09-17 18:05:03',NULL,NULL),(6,'testeasasa','<p>ertertete</p>','/about',1,NULL,NULL,'2020-09-17 18:08:24','2020-09-17 18:08:24',NULL,NULL),(7,'teste2324234','<p>ertertete</p>','/about',1,NULL,NULL,'2020-09-17 18:10:44','2020-09-17 18:10:44',NULL,NULL),(8,'teste2324234','<p>ertertete</p>','/about',1,NULL,NULL,'2020-09-17 18:11:14','2020-09-17 18:11:14',NULL,NULL),(9,'teste2','<p>ertertete</p>','/about',1,NULL,NULL,'2020-09-17 18:11:24','2020-09-17 18:11:24',NULL,NULL);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weekday`
--

DROP TABLE IF EXISTS `weekday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weekday` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_pt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_en` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_es` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviation_pt` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviation_en` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `abbreviation_es` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `suffix` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weekday`
--

LOCK TABLES `weekday` WRITE;
/*!40000 ALTER TABLE `weekday` DISABLE KEYS */;
INSERT INTO `weekday` VALUES (1,'Domingo','Sunday','Domingo','DOM','SUN','DOM','SU',NULL,NULL,NULL,NULL,NULL,NULL),(2,'Segunda','Monday','Lunes','SEG','MON','LUN','MO',NULL,NULL,NULL,NULL,NULL,NULL),(3,'Terça','Tuesday','Martes','TER','TUE','MAR','TU',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Quarta','Wednesday','Miércoles','QUA','WED','MIÉ','WE',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Quinta','Thursday','Jueves','QUI','THU','JUE','TH',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Sexta','Friday','Viernes','SEX','FRI','VIE','FR',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Sábado','Saturday','Sábado','SÁB','SAT','SÁB','SA',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `weekday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_with_us`
--

DROP TABLE IF EXISTS `work_with_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_with_us` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genre` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_birth` datetime DEFAULT NULL,
  `profession` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complement` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `neighborhood` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_phone1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_phone2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `curriculum` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_pt` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_en` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_es` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `graduation_id` int(10) unsigned DEFAULT NULL,
  `function_id` int(10) unsigned DEFAULT NULL,
  `office_id` int(10) unsigned DEFAULT NULL,
  `english_level_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_with_us_graduation_id_foreign` (`graduation_id`),
  KEY `work_with_us_function_id_foreign` (`function_id`),
  KEY `work_with_us_office_id_foreign` (`office_id`),
  KEY `work_with_us_english_level_id_foreign` (`english_level_id`),
  CONSTRAINT `work_with_us_english_level_id_foreign` FOREIGN KEY (`english_level_id`) REFERENCES `english_level` (`id`),
  CONSTRAINT `work_with_us_function_id_foreign` FOREIGN KEY (`function_id`) REFERENCES `function` (`id`),
  CONSTRAINT `work_with_us_graduation_id_foreign` FOREIGN KEY (`graduation_id`) REFERENCES `graduation` (`id`),
  CONSTRAINT `work_with_us_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `office` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_with_us`
--

LOCK TABLES `work_with_us` WRITE;
/*!40000 ALTER TABLE `work_with_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_with_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'enar'
--

--
-- Dumping routines for database 'enar'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-25 12:31:57
