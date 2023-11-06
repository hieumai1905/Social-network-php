-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: social_network
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comment_replies`
--

DROP TABLE IF EXISTS `comment_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment_replies`
(
    `comment_reply_id` bigint        NOT NULL AUTO_INCREMENT,
    `reply_at`         datetime      NOT NULL,
    `content`          varchar(2000) NOT NULL,
    `user_id`          varchar(36)   NOT NULL,
    `comment_id`       bigint        NOT NULL,
    PRIMARY KEY (`comment_reply_id`),
    KEY                `fk_comment_replies_users_idx` (`user_id`),
    KEY                `fk_comment_replies_comments_idx` (`comment_id`),
    CONSTRAINT `fk_comment_replies_comments` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`),
    CONSTRAINT `fk_comment_replies_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_replies`
--

LOCK
TABLES `comment_replies` WRITE;
/*!40000 ALTER TABLE `comment_replies` DISABLE KEYS */;
INSERT INTO `comment_replies`
VALUES (1, '2023-10-21 20:02:00', 'Cũng bình thường', '7', 1),
       (2, '2023-10-21 20:03:00', 'Đúng đúng', '8', 2),
       (3, '2023-10-21 20:04:00', 'Khen ghê dị', '2', 1),
       (4, '2023-10-21 19:02:00', 'Đúng vậy', '5', 3),
       (5, '2023-10-21 19:00:00', 'Ồ gì', '5', 5);
/*!40000 ALTER TABLE `comment_replies` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments`
(
    `comment_id` bigint        NOT NULL AUTO_INCREMENT,
    `comment_at` datetime      NOT NULL,
    `content`    varchar(5000) NOT NULL,
    `post_id`    varchar(36)   NOT NULL,
    `user_id`    varchar(36)   NOT NULL,
    PRIMARY KEY (`comment_id`),
    KEY          `fk_comments_posts_idx` (`post_id`),
    KEY          `fk_comments_users_idx` (`user_id`),
    CONSTRAINT `fk_comments_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
    CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK
TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments`
VALUES (1, '2023-10-21 20:01:00', 'Quá tuyệt', '9', '5'),
       (2, '2023-10-21 20:02:00', 'Tuyệt vời', '9', '6'),
       (3, '2023-10-21 19:01:00', 'hài dử dị', '8', '7'),
       (4, '2023-10-21 19:02:00', 'Có thôi đi không', '8', '8'),
       (5, '2023-10-21 18:01:00', 'Ồ', '7', '2'),
       (6, '2023-10-21 18:02:00', 'Khum ấy', '7', '3');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conversations`
(
    `conversation_id` varchar(36)  NOT NULL,
    `create_at`       datetime     NOT NULL,
    `name`            varchar(200) NOT NULL,
    `type`            varchar(20)  NOT NULL,
    `manager_id`      varchar(36)  NOT NULL,
    PRIMARY KEY (`conversation_id`),
    KEY               `fk_conversations_users_idx` (`manager_id`),
    CONSTRAINT `fk_conversations_users` FOREIGN KEY (`manager_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversations`
--

LOCK
TABLES `conversations` WRITE;
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
INSERT INTO `conversations`
VALUES ('1', '2023-10-21 00:00:00', 'Lê Hồng Phong', 'PRIVATE', '6'),
       ('2', '2023-10-21 01:00:00', 'Mai Văn Hiếu', 'PRIVATE', '6'),
       ('3', '2023-10-21 00:00:00', 'Tô Dương Hưng', 'PRIVATE', '7'),
       ('4', '2023-10-21 01:00:00', 'Tô Dương Hưng', 'PRIVATE', '5'),
       ('5', '2023-10-21 20:00:00', 'WebPHP', 'GROUP', '6');
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes`
(
    `like_id`          bigint      NOT NULL AUTO_INCREMENT,
    `user_id`          varchar(36) NOT NULL,
    `post_id`          varchar(36) DEFAULT NULL,
    `comment_id`       bigint      DEFAULT NULL,
    `comment_reply_id` bigint      DEFAULT NULL,
    PRIMARY KEY (`like_id`),
    KEY                `fk_likes_comments_idx` (`comment_id`),
    KEY                `fk_likes_comments_replies_idx` (`comment_reply_id`),
    KEY                `fk_likes_posts_idx` (`post_id`),
    KEY                `fk_likes_users_idx` (`user_id`),
    CONSTRAINT `fk_likes_comments` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`),
    CONSTRAINT `fk_likes_comments_replies` FOREIGN KEY (`comment_reply_id`) REFERENCES `comment_replies` (`comment_reply_id`),
    CONSTRAINT `fk_likes_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
    CONSTRAINT `fk_likes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK
TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes`
VALUES (1, '5', '7', NULL, NULL),
       (2, '6', '8', NULL, NULL),
       (3, '7', NULL, 1, 1),
       (4, '8', NULL, NULL, 2),
       (5, '8', '9', NULL, NULL);
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `medias`
--

DROP TABLE IF EXISTS `medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medias`
(
    `media_id` varchar(36)  NOT NULL,
    `url`      varchar(300) NOT NULL,
    `type`     varchar(30)  NOT NULL,
    `post_id`  varchar(36)  NOT NULL,
    PRIMARY KEY (`media_id`),
    KEY        `fk_media_post_idx` (`post_id`),
    CONSTRAINT `fk_media_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medias`
--

LOCK
TABLES `medias` WRITE;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;
INSERT INTO `medias`
VALUES ('1', 'media1.jpg', 'IMAGE', '1'),
       ('2', 'media2.jpg', 'IMAGE', '2'),
       ('3', 'media3.jpg', 'IMAGE', '3'),
       ('4', 'media4.jpg', 'IMAGE', '4'),
       ('5', 'media4.png', 'IMAGE', '5'),
       ('6', 'media5.mp4', 'VIDEO', '6');
/*!40000 ALTER TABLE `medias` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages`
(
    `message_id`      varchar(36)   NOT NULL,
    `send_at`         datetime      NOT NULL,
    `content`         varchar(2000) NOT NULL,
    `is_media`        bit(1)        NOT NULL,
    `conversation_id` varchar(36)   NOT NULL,
    `sender_id`       varchar(36)   NOT NULL,
    PRIMARY KEY (`message_id`),
    KEY               `fk_messages_conversations_idx` (`conversation_id`),
    KEY               `fk_messages_users_idx` (`sender_id`),
    CONSTRAINT `fk_messages_conversations` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`conversation_id`),
    CONSTRAINT `fk_messages_users` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK
TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages`
VALUES ('1', '2023-10-21 00:00:00', 'Hello', _binary '\0', '1', '6'),
       ('2', '2023-10-21 00:00:10', 'Ủa ai dẫy?', _binary '\0', '3', '7'),
       ('3', '2023-10-21 00:00:30', 'Tớ là Hưng nè!', _binary '\0', '1', '6'),
       ('4', '2023-10-21 00:00:50', 'Woaaa.Tớ không quen ai tên Hưng', _binary '\0', '3', '7'),
       ('5', '2023-10-21 00:01:50', 'Ồ.Bye cậu', _binary '\0', '1', '6'),
       ('6', '2023-10-21 01:00:00', 'Hello cậu.cho mình làm quen nhé', _binary '\0', '2', '6'),
       ('7', '2023-10-21 01:00:02', 'message1.jpg', _binary '', '2', '6'),
       ('8', '2023-10-21 01:00:10', 'Thôi mình đi ngủ dồi.', _binary '\0', '4', '5'),
       ('9', '2023-10-21 01:00:20', 'Huhu', _binary '\0', '2', '6');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications`
(
    `notification_id` varchar(36)  NOT NULL,
    `content`         varchar(200) NOT NULL,
    `notification_at` datetime     NOT NULL,
    `status`          varchar(20)  NOT NULL,
    `url_target`      varchar(200) NOT NULL,
    `user_id`         varchar(36)  NOT NULL,
    `user_recipient`  varchar(36)  NOT NULL,
    PRIMARY KEY (`notification_id`),
    KEY               `fk_notifications_users_id_idx` (`user_id`),
    KEY               `fk_notifications_users_recipient_idx` (`user_recipient`),
    CONSTRAINT `fk_notifications_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
    CONSTRAINT `fk_notifications_users_recipient` FOREIGN KEY (`user_recipient`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK
TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications`
VALUES ('1', 'Trần Diệu Quỳnh mời bạn follow trang cá nhân', '2023-10-21 17:35:00', 'SEEN',
        'https://www.facebook.com/profile.php?id=100010231870396', '8', '6'),
       ('2', 'Mai Văn Hiếu mời bạn follow trang cá nhân', '2023-10-21 17:30:00', 'SEEN',
        'https://www.facebook.com/hieushuyn', '5', '6'),
       ('3', 'Lê Hồng Phong  mời bạn follow trang cá nhân', '2023-10-21 17:30:00', 'UNSEEN',
        'https://www.facebook.com/phong.lehong.79656', '7', '6');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participants`
(
    `conversation_id` varchar(36) NOT NULL,
    `user_id`         varchar(36) NOT NULL,
    `status`          varchar(20) NOT NULL,
    PRIMARY KEY (`conversation_id`, `user_id`),
    KEY               `fk_participants_conversations_idx` (`conversation_id`),
    KEY               `fk_participants_users_idx` (`user_id`),
    CONSTRAINT `fk_participants_conversations` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`conversation_id`),
    CONSTRAINT `fk_participants_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK
TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
INSERT INTO `participants`
VALUES ('5', '5', 'GUEST'),
       ('5', '6', 'HOST'),
       ('5', '7', 'GUEST'),
       ('5', '8', 'GUEST');
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `post_interacts`
--

DROP TABLE IF EXISTS `post_interacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_interacts`
(
    `user_id` varchar(36)   NOT NULL,
    `post_id` varchar(36)   NOT NULL,
    `content` varchar(2000) NOT NULL,
    `type`    varchar(20)   NOT NULL,
    PRIMARY KEY (`user_id`, `post_id`),
    KEY       `fk_postinteracts_posts_idx` (`post_id`),
    KEY       `fk_postinteract_users_idx` (`user_id`),
    CONSTRAINT `fk_postinteracts_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
    CONSTRAINT `fk_postinteracts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_interacts`
--

LOCK
TABLES `post_interacts` WRITE;
/*!40000 ALTER TABLE `post_interacts` DISABLE KEYS */;
INSERT INTO `post_interacts`
VALUES ('2', '1', 'Làm phiền', 'HIDDEN'),
       ('2', '2', 'Nhìn thấy không vui', 'REPORT'),
       ('3', '3', 'Hay', 'SAVE'),
       ('4', '5', 'Lưu để bóc phốt', 'SAVE'),
       ('4', '6', 'Nội dung không liên quan', 'HIDDEN');
/*!40000 ALTER TABLE `post_interacts` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts`
(
    `post_id`         varchar(36)   NOT NULL,
    `create_at`       datetime      NOT NULL,
    `content`         varchar(2000) NOT NULL,
    `access_modifier` varchar(30)   NOT NULL,
    `post_type`       varchar(30)   NOT NULL,
    `user_id`         varchar(36)   NOT NULL,
    PRIMARY KEY (`post_id`),
    KEY               `fk_posts_user` (`user_id`),
    CONSTRAINT `fk_posts_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK
TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts`
VALUES ('1', '2023-10-20 12:00:00', 'Ông trời tạo ra địa chấn. Và cái bụng mỡ của em chính là điểm nhấn.', 'PUBLIC',
        'POST', '3'),
       ('10', '2023-10-21 21:00:00', ' Em không còn là một cô gái đợi anh nữa. Giờ em là cô gái đợi ăn.', 'PUBLIC',
        'COVER', '9'),
       ('2', '2023-10-20 15:30:00', 'Thanh xuân như một ly trà. Ăn vài miếng bánh hết bà thanh xuân', 'PUBLIC', 'POST',
        '4'),
       ('3', '2023-10-20 16:35:00', 'Độc thân không phải là ế mà đang tìm người tử tế để yêu.', 'PRIVATE', 'POST', '2'),
       ('4', '2023-10-20 13:00:00', 'Một phụ nữ toàn diện là: Sáng diện, trưa diện, chiều diện, tối diện…', 'PRIVATE',
        'POST', '3'),
       ('5', '2023-10-20 14:00:00', 'Ta về ta tắm ao ta.Dù trong dù đục cũng là cái ao.', 'PUBLIC', 'AVATAR', '5'),
       ('6', '2023-10-21 17:00:00', 'Con đường ngắn nhất để đi từ một trái tim đến 1 trái tim là con đường truyền máu.',
        'PUBLIC', 'AVATAR', '6'),
       ('7', '2023-10-21 18:00:00',
        'Xin bạn hãy dành ra vài giây để đọc hết câu này, đọc tới đây thì cũng mất vài giây rồi, cảm ơn bạn.', 'PUBLIC',
        'AVATAR', '7'),
       ('8', '2023-10-21 19:00:00',
        ' Mỗi lần tôi giảm cân mà thèm ăn tôi đều tự nói với bản thân: “Ăn nữa sẽ chết!”Và kết quả chứng minh: Căn bản là tôi không hề sợ chết!',
        'PUBLIC', 'COVER', '8'),
       ('9', '2023-10-21 20:00:00', 'Con cóc là cậu ông trời.Nếu ai bắt được có nồi cháo ngon.', 'PUBLIC', 'COVER',
        '9');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `relations`
--

DROP TABLE IF EXISTS `relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relations`
(
    `relation_id`    varchar(36) NOT NULL,
    `change_at`      datetime    NOT NULL,
    `type_relation`  varchar(30) NOT NULL,
    `user_id`        varchar(36) NOT NULL,
    `user_target_id` varchar(36) NOT NULL,
    PRIMARY KEY (`relation_id`),
    KEY              `fk_relations_users_id_idx` (`user_id`),
    KEY              `fk_relayions_users_target_id_idx` (`user_target_id`),
    CONSTRAINT `fk_relations_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
    CONSTRAINT `fk_relayions_users_target_id` FOREIGN KEY (`user_target_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relations`
--

LOCK
TABLES `relations` WRITE;
/*!40000 ALTER TABLE `relations` DISABLE KEYS */;
INSERT INTO `relations`
VALUES ('1', '2023-10-20 23:59:59', 'FRIEND', '6', '7'),
       ('2', '2023-10-21 17:00:00', 'FRIEND', '3', '4'),
       ('3', '2023-10-21 18:00:00', 'BLOCK', '2', '3'),
       ('4', '2023-10-22 21:00:00', 'FOLLOW', '4', '5'),
       ('5', '2023-10-21 17:30:00', 'FRIEND', '6', '8'),
       ('6', '2023-10-21 00:00:00', 'FRIEND', '6', '5');
/*!40000 ALTER TABLE `relations` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests`
(
    `request_id`    bigint       NOT NULL,
    `request_at`    datetime     NOT NULL,
    `email_request` varchar(100) NOT NULL,
    `type_request`  varchar(30)  NOT NULL,
    `request_code`  varchar(30)  NOT NULL,
    PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK
TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests`
VALUES (1, '2023-10-22 00:01:00', 'trandieuquynh@.com', 'CHANGE_PASSWORD', '005666'),
       (2, '2023-10-22 00:02:00', 'toduonghung@gmail.com', 'CHANGE_EMAIL', '123000'),
       (3, '2023-10-22 00:03:00', 'lehongphong@gmail.com', 'FORGOT', '666888'),
       (4, '2023-10-22 00:04:00', 'ahihi@gmail.com', 'REGISTER', '888888');
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users`
(
    `user_id`     varchar(36)  NOT NULL,
    `full_name`   varchar(50)  NOT NULL,
    `avatar`      varchar(300)  DEFAULT NULL,
    `password`    varchar(100) NOT NULL,
    `email`       varchar(100)  DEFAULT NULL,
    `dob`         date          DEFAULT NULL,
    `address`     varchar(300)  DEFAULT NULL,
    `gender`      varchar(20)   DEFAULT NULL,
    `phone`       varchar(12)   DEFAULT NULL,
    `status`      varchar(20)  NOT NULL,
    `user_role`   varchar(20)  NOT NULL,
    `about_me`    varchar(1000) DEFAULT NULL,
    `cover_image` varchar(300)  DEFAULT NULL,
    `register_at` datetime     NOT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK
TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users`
VALUES ('1', 'Ngô Văn Anh', 'avt1.jpg', '123456', 'ngovananh@gmail.com', '2002-08-22', 'Hà Nội', 'Nam', '0369428002',
        'LOCK', 'USER', 'Nam.Sinh năm 2002.', NULL, '2023-10-12 20:21:11'),
       ('10', 'Tô Hưng', 'avt8.jpg', '123456', 'tohung@gmail.com', '2003-12-08', 'Quảng Ninh', 'Nam', '0369428011',
        'ACTIVE', 'ADMIN', 'Nam', 'ci4.jpg', '2023-10-09 17:18:11'),
       ('11', 'Lê Phong', NULL, '123456', 'lephong@gmail.com', '2003-04-10', 'Hà Nội', 'Nam', '0369428012', 'ACTIVE',
        'ADMIN', 'Nam', NULL, '2023-10-10 18:19:11'),
       ('12', 'Trần Quỳnh', NULL, '123456', 'diuking@gmail.com', '2003-12-11', 'Thanh Hóa', 'Nữ', '0369428013', 'LOCK',
        'ADMIN', 'Nữ', NULL, '2023-10-11 19:20:11'),
       ('2', 'Vũ Trường Phước', 'avt2.jpg', '123456', 'vutruongphuoc@gmail.com', '2002-07-07', 'Hà Nội', 'Nam',
        '0369428003', 'ACTIVE', 'USER', 'Nam.Học CNTT4', NULL, '2023-10-20 11:11:11'),
       ('3', 'Phạm Minh Quân', NULL, '123456', 'phamminhquan@gmail.com', '2003-08-08', 'Hà Nội', 'Nam', '0369428004',
        'ACTIVE', 'USER', 'Nam.Học tại Hà Nội', NULL, '2023-10-01 11:11:12'),
       ('4', 'Vương Kiến Quốc', NULL, '123456', 'vuongkienquoc@gmail.com', '2004-12-26', 'Hà Nội', 'Nam', '0369428005',
        'ACTIVE', 'USER', 'Nam.Học gtvt', 'ci1.jpg', '2023-10-02 12:12:11'),
       ('5', 'Mai Văn Hiếu', 'avt3.jpg', '123456', 'maivanhieu@gmail.com', '1997-05-19', 'Thanh Hóa', 'Nam',
        '0369428006', 'ACTIVE', 'USER', 'Nam.Sinh năm 1997', NULL, '2023-10-03 13:11:11'),
       ('6', 'Tô Dương Hưng', 'avt4.jpg', '123456', 'toduonghung@gmail.com', '1999-12-08', 'Quảng Ninh', 'Nam',
        '0369428007', 'ACTIVE', 'USER', 'Nam.Đến từ Quảng Ninh', 'ci2.jpg', '2023-10-04 11:15:11'),
       ('7', 'Lê Hồng Phong', 'avt5.jpg', '123456', 'lehongphong@gmail.com', '2002-04-10', 'Hà Nội', 'Nam',
        '0369428008', 'ACTIVE', 'USER', 'Nam.Đến từ Hà Nội', NULL, '2023-10-06 14:15:11'),
       ('8', 'Trần Diệu Quỳnh', 'avt6.jpg', '123456', 'trandieuquynh@gmail.com', '2002-12-11', 'Thanh Hóa', 'Nữ',
        '0369428009', 'ACTIVE', 'USER', 'Nữ.Lạc quan yêu đời', 'ci3.jpg', '2023-10-07 15:16:11'),
       ('9', 'Mai Hiếu', 'avt7.jpg', '123456', 'maihieu@gmail.com', '1998-05-19', 'Thanh Hóa', 'Nam', '0369428010',
        'ACTIVE', 'ADMIN', 'Nam.Sinh năm 1998', NULL, '2023-10-08 16:17:11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK
TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-31  8:54:51
