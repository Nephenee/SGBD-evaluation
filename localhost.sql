-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `evaluation` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `evaluation`;

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `price` decimal(6,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `adress` varchar(255) NOT NULL DEFAULT '5 place Charles Hernu, 69100 VILLEURBANNE',
  PRIMARY KEY (`bill_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `bills` (`bill_id`, `created`, `price`, `user_id`, `adress`) VALUES
(1,	'2019-09-05 08:51:13',	11.50,	1,	'5 place Charles Hernu, 69100 VILLEURBANNE');

DELIMITER ;;

CREATE TRIGGER `bills_ai` AFTER INSERT ON `bills` FOR EACH ROW
UPDATE users
SET users.lastbill = NEW.bill_id
WHERE users.user_id = NEW.bill_id;;

DELIMITER ;

DROP TABLE IF EXISTS `bills_lines`;
CREATE TABLE `bills_lines` (
  `line_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`line_id`),
  KEY `product_id` (`product_id`),
  KEY `bill_id` (`bill_id`),
  CONSTRAINT `bills_lines_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION,
  CONSTRAINT `bills_lines_ibfk_3` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO `bills_lines` (`line_id`, `product_id`, `quantity`, `bill_id`, `price`) VALUES
(1,	1,	1,	1,	2.50),
(2,	3,	2,	1,	4.50);

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) unsigned NOT NULL DEFAULT '10',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

INSERT INTO `products` (`product_id`, `name`, `description`, `created`, `image`, `price`, `quantity`) VALUES
(1,	'HUILE ESSENTIELLE DE CITRON BIO',	'Fortifiante, purifiante et assainissante, l\'huile essentielle de Citron est appréciée pour stimuler l\'organisme. Sa senteur fine et fruitée la rend très agréable et sa saveur de zeste de citron est idéale en cuisine.',	'2019-09-02 07:59:48',	'HE-citron.png',	2.50,	10),
(2,	'HUILE ESSENTIELLE DE CITRONNELLE DE JAVA BIO',	'Apaisante, cette huile est traditionnellement conseillée pour améliorer le confort articulaire, mais aussi pour calmer les piqûres d\'insectes. Son odeur caractéristique est largement réputée pour ses effets purifiants et assainissants.',	'2019-09-02 07:59:48',	'HE-citronnelle.png',	2.30,	10),
(3,	'HUILE ESSENTIELLE DE COMBAWA',	'Apaisante, cette huile essentielle est traditionnellement conseillée pour calmer les inconforts articulaires. Elle est aussi réputée pour lutter contre le stress et les insomnies.',	'2019-09-01 07:59:48',	'HE-combawa.png',	4.50,	10),
(4,	'HUILE ESSENTIELLE DE CURCUMA BIO',	'Sa richesse en turmérones lui offre de puissantes propriétés antioxydantes. C\'est donc une huile essentielle aussi efficace qu\'agréable grâce à son odeur poudrée. En cuisine, c\'est un arôme exotique et original, à utiliser à petite dose.',	'2019-09-01 07:59:48',	'HE-curcuma.png',	4.50,	10),
(5,	'HUILE ESSENTIELLE DE CYPRÈS DE PROVENCE BIO',	'Cette huile est connue depuis longtemps pour ses qualités toniques et circulatoires exceptionnelles. Elle est aussi traditionnellement réputée pour réguler les transpirations excessives et calmer les toussotements.',	'2019-09-01 07:59:48',	'HE-cypres.png',	4.50,	10),
(6,	'HUILE ESSENTIELLE D’EUCALYPTUS MENTHOLÉ BIO',	'Purifiante et puissante, cette huile est traditionnellement utilisée pour favoriser la respiration. Elle est aussi connue pour ses effets lipolytiques grâce à sa teneur en cétones.',	'2019-09-02 07:59:48',	'HE-eucalyptus.png',	2.90,	10),
(7,	'HUILE ESSENTIELLE DE GALBANUM BIO',	'Tonique et stimulante, cette huile est utilisée en cas de fatigue et de tensions. L\'huile essentielle de Galbanum est également appréciée pour son odeur verte et herbacée et était largement utilisée dans la composition d\'accords \"chypre\".',	'2019-09-01 07:59:48',	'HE-galbanum.png',	7.90,	10),
(8,	'HUILE ESSENTIELLE DE GENÉVRIER BIO',	'Réputée pour ses vertus apaisantes, cette huile contribue à soulager l\'inconfort lié aux problèmes d\'articulations, et à atténuer l\'aspect de la cellulite et des rétentions d\'eau. Energétique, elle apporte aussi force et courage.',	'2019-09-02 07:59:48',	'HE-genevrier.png',	5.90,	10),
(9,	'HUILE ESSENTIELLE DE GÉRANIUM EGYPTE BIO',	'Purifiante et tonique, cette huile essentielle est appréciée pour son parfum suave et ses vertus assainissantes grâce à sa richesse en monoterpénols. Elle est traditionnellement utilisée pour ses vertus astringentes et réparatrices.',	'2019-09-02 07:59:48',	'HE-geranium.png',	5.90,	10),
(10,	'HUILE ESSENTIELLE DE GINGEMBRE BIO',	'Réputée comme aphrodisiaque et tonique général, cette huile est aussi connue pour son aide en cas de mal des transports. Sa délicieuse senteur épicée de gingembre frais est un régal, et elle fait merveille en cuisine pour aromatiser des plats.',	'2019-09-01 07:59:48',	'HE-gingembre.png',	4.90,	10),
(11,	'HUILE ESSENTIELLE DE CLOUS DE GIROFLE BIO',	'Stimulant général, cette huile vivifiante est réputée en cas de grande fatigue physique ou intellectuelle. Le clou de girofle est traditionnellement utilisé en cas de caries et douleurs dentaires.',	'2019-09-01 07:59:48',	'HE-girofle-clous.png',	3.90,	10),
(12,	'HUILE ESSENTIELLE DE LAURIER BIO',	'Purifiante puissante, cette huile est traditionnellement utilisée pour dégager la respiration et assainir la bouche. Elle est également connue pour ses vertus apaisantes en cas d\'inconfort articulaire et réputée pour apporter force et courage.',	'2019-09-01 07:59:48',	'HE-laurier.png',	4.50,	10),
(13,	'HUILE ESSENTIELLE DE LAVANDE VRAIE DE BULGARIE BIO',	'Cette huile est depuis longtemps connue pour ses vertus réparatrices et apaisantes. Elle s\'emploie aussi pour ses vertus relaxantes et calmantes puissantes sur le système nerveux. Une alliée contre le stress ou les insomnies !',	'2019-09-03 07:59:48',	'HE-lavande.png',	5.50,	10),
(14,	'HUILE ESSENTIELLE DE MARJOLAINE À COQUILLES BIO',	'Cette huile est principalement connue pour ses propriétés calmantes relaxantes : elle s\'utilise ainsi pour soulager nervosité, angoisses et stress. Elle s\'emploie aussi en cas de fatigue ou de troubles du sommeil.',	'2019-09-03 07:59:48',	'HE-marjolaine.png',	7.90,	10),
(15,	'HUILE ESSENTIELLE DE MENTHE POIVRÉE BIO',	'Cette huile stimule et revigore corps et esprit, et est traditionnellement connue pour aider à lutter contre les nausées, le mal des transports et les maux de tête. Réfrigérante, elle s\'utilise aussi pour soulager les démangeaisons.',	'2019-09-03 07:59:48',	'HE-menthe-poivree.png',	3.20,	10),
(16,	'HUILE ESSENTIELLE DE NÉROLI BIO',	'Calmante puissante, cette huile aide à apaiser anxiété, stress et troubles du sommeil et favorise sentiment de paix intérieure. Elle est également connue pour ses effets régénérants et toniques. Son parfum subtil de fleur d\'oranger est divin.',	'2019-09-03 07:59:48',	'HE-neroli.png',	15.50,	10),
(17,	' HUILE ESSENTIELLE DE ROSE DE DAMAS BIO',	'L\'huile de Rose est magique. D\'odeur puissante, fleurie et envoûtante, c\'est une alliée pour lutter contre les signes du temps. Tonique, c\'est aussi une huile fabuleuse sur le plan énergétique, avec des vertus harmonisantes et aphrodisiaques.',	'2019-09-03 07:59:48',	'HE-rose-damas.png',	25.00,	10),
(18,	'HUILE ESSENTIELLE DE CANNELLE DE CEYLAN FEUILLES BIO',	'Les feuilles du cannelier donnent une huile épicée et proche du clou de girofle connue pour ses propriétés purifiantes. Elle est également intéressante pour atténuer les mauvaises odeurs (cuisson, tabac,...).',	'2019-09-03 07:59:48',	'HE-cannelle-ceylan.png',	2.50,	10),
(19,	'HUILE ESSENTIELLE DE BERGAMOTE BIO',	'Calmante et purifiante, l\'huile essentielle de Bergamote apaise les esprits tout en favorisant relaxation et bonne humeur. Appréciée pour son parfum tonique et délicat, elle apporte une saveur citronnée et fleurie très raffinée en cuisine.',	'2019-09-03 07:59:48',	'HE-bergamote.png',	4.50,	10),
(20,	'HUILE ESSENTIELLE DE BASILIC TROPICAL BIO',	'Calmante puissante, cette huile est traditionnellement utilisée en cas de stress, crispations, spasmes nerveux, ou encore pour le confort intestinal. Tonique et revigorante, elle lutte contre la fatigue.',	'2019-09-03 07:59:48',	'HE-basilic.png',	2.70,	10),
(35,	'Test',	'Lorem ipsum',	'2019-09-04 14:45:44',	'test.jpg',	15.50,	8);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`role_id`, `role`) VALUES
(1,	'user'),
(2,	'admin');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `lastbill` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `lastbill` (`lastbill`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`lastbill`) REFERENCES `bills` (`bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `role_id`, `email`, `password`, `firstname`, `lastname`, `adress`, `lastbill`) VALUES
(1,	2,	'admin@aromaBioHuiles.com',	'admin',	'Administrateur',	'aromaBioHuiles',	'2 rue Francis de Pressenssé, 69100 VILLEURBANNE',	1),
(2,	1,	'test1@test.com',	'test',	'Test1',	'User',	'561 boulevard Victor Hugo, 59000 LILLE',	NULL),
(3,	1,	'test2@test.com',	'test',	'Test2',	'User',	'17 rue du Général Leclerc, 13000 MARSEILLE',	NULL);

-- 2019-09-05 10:39:14
