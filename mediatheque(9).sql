-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 16 jan. 2019 à 13:44
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_souscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `date_achat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_video` (`id_video`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achat`
--

INSERT INTO `achat` (`id`, `id_utilisateur`, `id_video`, `date_achat`) VALUES
(10, 2, 6, '2019-01-08 19:24:58'),
(11, 2, 8, '2019-01-08 20:45:44'),
(12, 1, 8, '2019-01-14 09:44:19'),
(13, 1, 6, '2019-01-14 10:00:28'),
(14, 13, 6, '2019-01-14 13:22:50'),
(15, 1, 3, '2019-01-14 22:39:37'),
(16, 1, 1, '2019-01-16 13:38:01');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_video` (`id_video`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_utilisateur`, `id_video`, `commentaire`, `date_commentaire`) VALUES
(1, 1, 2, 'Super vidéo!! :D', '2018-12-29 10:06:55'),
(2, 2, 2, 'Like si tu regardes cette vidéo en 2024!', '2018-12-29 10:08:55'),
(3, 1, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ornare lorem eu ultrices blandit. Integer consectetur cursus purus, nec consectetur sapien semper in. Aliquam erat volutpat. Fusce augue urna, condimentum at molestie id, fermentum maximus turpis. Ut tincidunt tellus et molestie laoreet. Curabitur rutrum sodales neque, eu lobortis ipsum blandit at. Donec facilisis sapien hendrerit nibh bibendum convallis. Nam sodales nisl non efficitur euismod. Praesent et nisl a urna ultricies convallis. Pellentesque et condimentum massa. Etiam tempor mi nisi, iaculis venenatis nunc pellentesque ac. Mauris porta justo nec metus laoreet, sit amet aliquam justo lacinia.\r\n\r\nCurabitur commodo ullamcorper lacus et feugiat. Sed posuere nibh sit amet purus pellentesque, nec auctor massa finibus. Praesent nulla risus, tristique et eleifend et, faucibus at mi. Morbi vel aliquam metus. Vivamus ac nunc nulla. Phasellus viverra, neque ut vehicula pulvinar, est urna venenatis nibh, sit amet mattis orci risus eget ligula. Quisque vitae libero odio. Mauris ut nibh egestas, scelerisque turpis eget, pharetra ante. Fusce erat lorem, hendrerit ut pellentesque eget, convallis ac dui. Suspendisse consectetur est enim, a molestie ipsum euismod lacinia. Pellentesque mollis et ante vel consequat.\r\n\r\nCurabitur malesuada nisl nec lacus convallis ullamcorper et eget leo. Integer eu finibus lectus, at tincidunt enim. Vivamus sapien metus, tempus nec cursus quis, suscipit non lacus. Duis sagittis nisl ut ante pretium, sed blandit purus ultrices. Aliquam erat volutpat. Aliquam erat volutpat. Maecenas nec diam mi. In blandit commodo sem, finibus vestibulum urna euismod eget. Sed ipsum arcu, faucibus nec auctor sed, tincidunt in sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus ultrices condimentum condimentum.\r\n\r\nIn hac habitasse platea dictumst. Nunc nec purus et tellus viverra tincidunt. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ut mauris id lorem volutpat consectetur. Ut rutrum non orci sed mattis. Praesent sagittis orci eu ex maximus, fermentum rhoncus orci laoreet. Sed tincidunt velit purus, in volutpat nibh egestas sed. Sed tincidunt sollicitudin libero id gravida. Maecenas mattis lacus quis finibus scelerisque. Nunc vel eleifend est, vitae ultrices sapien. Cras tortor elit, fermentum nec neque eu, vestibulum tempus elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\r\n\r\nDonec egestas eros dolor, quis tristique nisl tristique eget. Duis eu lacinia odio. Cras laoreet justo non mi malesuada dapibus. Etiam tincidunt tristique purus sit amet porttitor. Suspendisse dui eros, dapibus ut facilisis sed, dapibus at magna. Quisque congue sollicitudin nibh, at accumsan erat tempus eget. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla facilisi. Aenean sit amet mauris diam. Nam elementum rutrum diam at sagittis. Quisque sed scelerisque orci, eu efficitur turpis. Proin egestas sagittis arcu egestas imperdiet. Donec et augue gravida, tincidunt eros non, scelerisque eros. ', '2018-12-29 11:38:31'),
(4, 2, 2, 'Test', '2019-01-03 16:02:18'),
(5, 2, 2, 'Bonjour à tous', '2019-01-03 16:05:49'),
(6, 2, 2, 'J\'ai faim', '2019-01-03 16:07:05'),
(7, 2, 2, 'Moi aussi', '2019-01-03 16:07:33'),
(8, 2, 2, 'jjjj', '2019-01-03 16:07:54'),
(9, 2, 2, 'Quentin c\'est le plus beau zebi!', '2019-01-03 16:08:34'),
(10, 2, 2, 'Bite', '2019-01-03 16:13:10'),
(11, 2, 2, 'Zzi', '2019-01-03 16:14:11'),
(12, 2, 2, 'Zizi*', '2019-01-03 16:14:34'),
(13, 2, 2, 'Adem la poutre', '2019-01-03 16:15:38'),
(14, 2, 2, 'Yes', '2019-01-03 16:17:00'),
(15, 2, 2, 'Non', '2019-01-03 16:25:48'),
(16, 2, 4, 'Test', '2019-01-03 16:28:16'),
(17, 2, 4, 'Je m\'appelle Remy', '2019-01-03 16:34:50'),
(18, 2, 4, 'Quelle super chanson!!!', '2019-01-03 16:36:24'),
(19, 2, 4, 'J\'adore!', '2019-01-03 16:36:52'),
(20, 2, 4, 'C\'est trop bien!', '2019-01-03 16:38:35'),
(21, 2, 4, 'NTM KEVIN MAIS JTM QUAND MEME SALE PUTE!!!!!!! ', '2019-01-03 16:38:53'),
(22, 2, 4, 'ADEM!!', '2019-01-03 16:39:03'),
(23, 2, 4, 'JJJJJJ BITE', '2019-01-03 16:39:23'),
(24, 2, 7, 'First', '2019-01-03 16:56:02'),
(25, 2, 9, 'C\'est pas de la tarte au citron :(', '2019-01-03 16:57:08'),
(26, 2, 4, 'Ce commentaire est écrit depuis un téléphone', '2019-01-04 09:23:41'),
(27, 2, 4, 'Et celui-ci pendant que la vidéo est en cours pour voir', '2019-01-04 09:24:13'),
(28, 1, 4, 'Remy tu parles trop ferme la STP', '2019-01-04 13:36:17'),
(29, 1, 4, 'test', '2019-01-04 15:58:37'),
(30, 8, 4, 'Super bien!', '2019-01-04 16:00:59'),
(31, 2, 4, '#JUL', '2019-01-05 01:21:45'),
(32, 10, 4, 'Les gars je suis nouveau sur le site, ça va?', '2019-01-09 21:22:25'),
(33, 2, 4, 'Test avec set et render', '2019-01-09 22:37:14'),
(34, 1, 2, 'alert(\'test\')', '2019-01-14 10:06:38'),
(35, 12, 4, 'Nouveau test', '2019-01-14 10:49:33'),
(36, 12, 4, 'Test1', '2019-01-14 10:51:38'),
(37, 12, 4, 'Test2', '2019-01-14 10:51:41'),
(38, 13, 7, 'Salut', '2019-01-14 13:21:40'),
(39, 13, 9, 'Ah putain fais chier je m\'ai fait prank...', '2019-01-14 15:05:26'),
(40, 1, 1, 'Woooooow!!!', '2019-01-16 13:38:20');

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_id` varchar(255) NOT NULL,
  `payment_status` text NOT NULL,
  `payment_amount` text NOT NULL,
  `payment_currency` text NOT NULL,
  `payment_date` datetime NOT NULL,
  `payer_email` text NOT NULL,
  `payer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `payment_id`, `payment_status`, `payment_amount`, `payment_currency`, `payment_date`, `payer_email`, `payer_id`) VALUES
(6, 'PAY-47589533Y86810416LQZ56NI', 'approved', '1.00', 'EUR', '2019-01-08 00:22:29', 'quentin.schifferle-buyer@gmail.com', 2),
(36, 'PAY-8PT585412T055592GLQ6EVQA', 'created', '9.99', 'EUR', '2019-01-14 09:39:29', '', 1),
(35, 'PAY-37U57714HC409333HLQ6ESVQ', 'created', '1.00', 'EUR', '2019-01-14 09:33:28', '', 1),
(24, 'PAY-5UT29966T6900443LLQ2OH6Y', 'approved', '1.00', 'EUR', '2019-01-08 18:55:07', 'quentin.schifferle-buyer@gmail.com', 1),
(25, 'PAY-47V35586UJ024060CLQ2OIXQ', 'approved', '0.55', 'EUR', '2019-01-08 18:56:46', 'quentin.schifferle-buyer@gmail.com', 1),
(28, 'PAY-9F769176UD440094PLQ2OMEY', 'approved', '0.55', 'EUR', '2019-01-08 19:04:03', 'quentin.schifferle-buyer@gmail.com', 1),
(29, 'PAY-72J589606T386453NLQ2OMTA', 'created', '0.55', 'EUR', '2019-01-08 19:05:00', '', 2),
(30, 'PAY-0NX6003763322140TLQ2ONFY', 'created', '0.55', 'EUR', '2019-01-08 19:06:15', '', 2),
(31, 'PAY-2KA750441D6007738LQ2OONY', 'created', '0.55', 'EUR', '2019-01-08 19:08:56', '', 2),
(32, 'PAY-77Y29676PN8189353LQ2OPNQ', 'approved', '0.55', 'EUR', '2019-01-08 19:11:01', 'quentin.schifferle-buyer@gmail.com', 1),
(33, 'PAY-2L556516KD184522ULQ2OVTQ', 'approved', '0.55', 'EUR', '2019-01-08 19:24:14', 'quentin.schifferle-buyer@gmail.com', 1),
(34, 'PAY-3US85659G8673742YLQ2P3QI', 'approved', '9.99', 'EUR', '2019-01-08 20:45:05', 'quentin.schifferle-buyer@gmail.com', 2),
(42, 'PAY-7N073113FV954041SLQ7SLCA', 'approved', '1.00', 'EUR', '2019-01-16 13:37:32', 'quentin.schifferle-buyer@gmail.com', 1),
(41, 'PAY-26V9469757927702LLQ6QC3A', 'approved', '2.00', 'EUR', '2019-01-14 22:38:54', 'quentin.schifferle-buyer@gmail.com', 1),
(40, 'PAY-2F9159048Y6846635LQ6H52I', 'approved', '0.55', 'EUR', '2019-01-14 13:22:02', 'quentin.schifferle-buyer@gmail.com', 13),
(39, 'PAY-01P89874RK046503YLQ6E7DA', 'approved', '0.55', 'EUR', '2019-01-14 09:59:58', 'quentin.schifferle-buyer@gmail.com', 1),
(38, 'PAY-7E622631UV040824GLQ6EXNQ', 'approved', '9.99', 'EUR', '2019-01-14 09:43:35', 'quentin.schifferle-buyer@gmail.com', 1),
(37, 'PAY-03T32827GM8914932LQ6EV7A', 'created', '9.99', 'EUR', '2019-01-14 09:40:29', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `couleur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `nom`, `couleur`) VALUES
(1, 'Cinéma', '#33B2FF'),
(2, 'Musique', '#49FF33'),
(3, 'Cuisine', '#C433FF');

-- --------------------------------------------------------

--
-- Structure de la table `type_abonnement`
--

DROP TABLE IF EXISTS `type_abonnement`;
CREATE TABLE IF NOT EXISTS `type_abonnement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` double NOT NULL,
  `essai` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_abonnement`
--

INSERT INTO `type_abonnement` (`id`, `nom`, `description`, `prix`, `essai`) VALUES
(1, 'Quotidien', 'Toutes les vidéos pendant 24h', 1.99, 0),
(2, 'Hebdomadaire', 'Toutes les vidéos pendant 7j', 9.99, 0),
(3, 'Mensuel', 'Toutes les vidéos pendant 1 mois', 39.99, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail` varchar(255) DEFAULT NULL,
  `pic` varchar(255) NOT NULL DEFAULT 'profils/default.jpg',
  `pass` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `pseudo`, `date_creation`, `mail`, `pic`, `pass`) VALUES
(1, 'Schifferle', 'Quentin', 'SynGates', '2018-11-23 14:24:15', 'quentin.schifferle@gmail.com', 'profils/syngates/quentin.JPG', 'b7e8324ec0be8a1389937a0be7e7d52a'),
(2, 'Mouttet', 'Remy', 'LaStreetDu67', '2019-01-03 11:31:15', 'lastreetdu67@gmail.com', 'profils/lastreetdu67/remy.png', '1f32aa4c9a1d2ea010adcf2348166a04'),
(3, 'Knittel', 'Kévin', 'Keks68', '2019-01-03 12:23:12', 'kevin.knittel@gmail.com', 'profils/default.jpg', 'ec6a6536ca304edf844d1d248a4f08dc'),
(8, 'Schaeffer', 'Philippe', 'phillou68', '2019-01-04 16:00:19', 'philippe.schaeffer@gmail.com', 'profils/default.jpg', 'ec6a6536ca304edf844d1d248a4f08dc'),
(10, 'Schifferle', 'Nathan', 'NathanCavani', '2019-01-09 21:17:19', 'nathan.schifferle@gmail.com', 'profils/default.jpg', '1f32aa4c9a1d2ea010adcf2348166a04'),
(11, 'Couchot', 'Emilie', 'MissPandawa68', '2019-01-09 23:30:04', 'mimi-couchot@live.fr', 'profils/default.jpg', 'b590c7e0c00a7f68927108ebbeb180ae'),
(12, 'dede', 'le javelin', 'lejavelin', '2019-01-14 10:23:11', 'lejavelin.dede@gmail.com', 'profils/default.jpg', 'ec6a6536ca304edf844d1d248a4f08dc'),
(13, 'Kalk', 'Anthonin', 'cnam1', '2019-01-14 12:20:20', 'anthonin.kalk@gmail.com', 'profils/cnam1/anto.jpg', 'ec6a6536ca304edf844d1d248a4f08dc'),
(17, 'Eppler', 'Julien', 'julthedeath', '2019-01-16 11:11:21', 'julien.eppler@gmail.com', 'profils/default.jpg', '14e1b600b1fd579f47433b88e8d85291');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `id_theme` int(11) NOT NULL,
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gratuite` tinyint(4) NOT NULL DEFAULT '0',
  `lien` varchar(255) DEFAULT NULL,
  `miniature` varchar(255) NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_theme` (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `titre`, `description`, `id_theme`, `date_ajout`, `gratuite`, `lien`, `miniature`, `prix`) VALUES
(1, 'Faire une pizza (en 1min)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque lacus orci, eget venenatis felis iaculis quis. Cras leo quam, efficitur id lectus id, rhoncus fringilla purus. Aenean vehicula laoreet nunc vitae rhoncus. Integer condimentum rutrum metus, et mollis tellus dapibus in. Nulla faucibus dolor a finibus tempus. Phasellus et nibh ex. Integer suscipit facilisis elit, vitae pharetra magna laoreet nec. Nulla dapibus vel felis ut rhoncus. Etiam porttitor nulla vitae posuere viverra. ', 3, '2017-11-18 23:18:26', 0, 'http://localhost/mediatheque/public/fichiers/videos/test.MP4', 'fichiers/pizza.jpg', '1.00'),
(2, 'Architects - Royal Beggars', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque lacus orci, eget venenatis felis iaculis quis. Cras leo quam, efficitur id lectus id, rhoncus fringilla purus. Aenean vehicula laoreet nunc vitae rhoncus. Integer condimentum rutrum metus, et mollis tellus dapibus in. Nulla faucibus dolor a finibus tempus. Phasellus et nibh ex. Integer suscipit facilisis elit, vitae pharetra magna laoreet nec. Nulla dapibus vel felis ut rhoncus. Etiam porttitor nulla vitae posuere viverra. ', 2, '2018-11-21 23:18:26', 1, 'https://www.youtube.com/embed/HNpWuwSVyDk', 'fichiers/architects.jpg', NULL),
(3, 'Halloween (Bande Annonce - 2018)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque lacus orci, eget venenatis felis iaculis quis. Cras leo quam, efficitur id lectus id, rhoncus fringilla purus. Aenean vehicula laoreet nunc vitae rhoncus. Integer condimentum rutrum metus, et mollis tellus dapibus in. Nulla faucibus dolor a finibus tempus. Phasellus et nibh ex. Integer suscipit facilisis elit, vitae pharetra magna laoreet nec. Nulla dapibus vel felis ut rhoncus. Etiam porttitor nulla vitae posuere viverra. ', 1, '2014-01-04 23:21:04', 0, 'https://www.youtube.com/embed/wqts5qBX8ZA', 'fichiers/halloween.jpg', '2.00'),
(4, 'While She Sleeps - ANTI SOCIAL', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque lacus orci, eget venenatis felis iaculis quis. Cras leo quam, efficitur id lectus id, rhoncus fringilla purus. Aenean vehicula laoreet nunc vitae rhoncus. Integer condimentum rutrum metus, et mollis tellus dapibus in. Nulla faucibus dolor a finibus tempus. Phasellus et nibh ex. Integer suscipit facilisis elit, vitae pharetra magna laoreet nec. Nulla dapibus vel felis ut rhoncus. Etiam porttitor nulla vitae posuere viverra. ', 2, '2018-12-28 23:21:04', 1, 'https://www.youtube.com/embed/22CmxMJU2V0', 'fichiers/wss.jpeg', NULL),
(6, 'While She Sleeps - Haunt Me', 'Order the new album So What? out March 1st via Sleeps Brothers \r\n\r\nhttps://whileshesleeps.lnk.to/sowhat \r\n\r\nLyrics \r\n\r\nWE WON\'T LEAVE TIL YOU REALISE, \r\nTHESE ARE THE REASONS WHY WE WON\'T SURVIVE ON OUR OWN, \r\nNOBODY GETS LEFT BEHIND. \r\n\r\nDON\'T SAY YOU DIDN\'T SEE IT COMING, \r\nNOW THE WORLD’S IN DISARRAY \r\nAND ALL THAT I HAVE SAID COMES BACK TO HAUNT ME. \r\n\r\nI DIDN\'T SEE THE LIGHTS, \r\nEVEN THOUGH THEY\'RE BLINDING ME RIGHT IN THE EYES. \r\nCOULDN\'T READ THE SIGNS TELLING ME TO SWIM AGAINST THE CURRENT \r\nAS THEY\'RE PULLING ME UNDER.\r\n\r\nI\'M INTOXICATED, LED ASTRAY BY THE FAKE. UNCONSCIOUS TO THE RIGHT SOLUTION, OUR MINDS ARE BARELY MOVING. \r\nWE MIGHT DESERVE A SECOND CHANCE IF I CAN PROVE WE\'RE ALIVE. \r\n\r\nDON\'T SAY YOU DIDN\'T SEE IT COMING, \r\nNOW THE WORLD’S IN DISARRAY \r\nAND ALL THAT I HAVE SAID COMES BACK TO HAUNT ME. \r\nDON\'T SAY YOU COULDN\'T SEE THE WARNINGS OR THE WOLVES OUTSIDE THE GATES \r\nAND ALL THAT I HAVE SAID COMES BACK TO HAUNT ME. \r\n\r\nWE WON\'T LEAVE TIL YOU REALISE, \r\nTHESE ARE THE REASONS WHY WE WON\'T SURVIVE ON OUR OWN, \r\nNOBODY GETS LEFT BEHIND. (WHO TOLD YOU IT\'S)\r\nOURS FOR THE TAKING,\r\nEVERY MAN FOR HIMSELF. \r\nIN FAVOUR OF ALL WHO TRADE INTELLIGENCE, ORDER FOR THE SELFISH WHO DON\'T DESERVE A SECOND CHANCE \r\nIF THEY\'RE STILL PICKING A SIDE. \r\n\r\nIT\'S THE DOSE THAT MAKES IT POISONOUS, IT TASTES BITTER \r\nBUT WE\'RE KEEPING OUR HEAD ABOVE THE SURFACE, \r\nWE\'RE STILL ALIVE ALTHOUGH WE\'VE BEEN BITTEN, \r\nIT\'S LIKE A SICKNESS WRITTEN INTO OUR ANATOMY. \r\nTHIS IS THE SOUND OF NO ONE LISTENING TO YOU RUNNING YOUR MOUTH, \r\nARE YOU THINKING OUT LOUD OR JUST CAN\'T SEE THROUGH THE AMOUNT OF SHIT YOU FEEL THE NEED TO SURROUND YOURSELF WITH? \r\nBACK UP I’M SICK OF TELLING YOU ENOUGH IS ENOUGH. \r\n\r\nIT TAKES MY BREATH AWAY \r\nBUT I DON\'T FEEL LIKE I DESERVE THE TASTE. \r\nYOU\'RE MISSING THE POINT, CAN\'T UNDERSTAND MY PAIN. \r\nSOME PEOPLE NEVER CHANGE, \r\nIT\'S LIKE A FIRE WITHOUT A FLAME.', 2, '2018-12-27 22:38:00', 0, 'https://www.youtube.com/embed/-0PfGJPO-k4', 'fichiers/wss.jpeg', '0.55'),
(7, 'Avenged Sevenfold - The Stage', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque lacus orci, eget venenatis felis iaculis quis. Cras leo quam, efficitur id lectus id, rhoncus fringilla purus. Aenean vehicula laoreet nunc vitae rhoncus. Integer condimentum rutrum metus, et mollis tellus dapibus in. Nulla faucibus dolor a finibus tempus. Phasellus et nibh ex. Integer suscipit facilisis elit, vitae pharetra magna laoreet nec. Nulla dapibus vel felis ut rhoncus. Etiam porttitor nulla vitae posuere viverra. ', 2, '2019-12-28 18:46:57', 1, 'https://www.youtube.com/embed/fBYVlFXsEME', 'fichiers/a7x.jpg', NULL),
(8, 'Bohemian Rhapsody - Trailer (VO)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque lacus orci, eget venenatis felis iaculis quis. Cras leo quam, efficitur id lectus id, rhoncus fringilla purus. Aenean vehicula laoreet nunc vitae rhoncus. Integer condimentum rutrum metus, et mollis tellus dapibus in. Nulla faucibus dolor a finibus tempus. Phasellus et nibh ex. Integer suscipit facilisis elit, vitae pharetra magna laoreet nec. Nulla dapibus vel felis ut rhoncus. Etiam porttitor nulla vitae posuere viverra. ', 1, '2018-12-28 18:50:29', 0, 'https://www.youtube.com/embed/mP0VHJYFOAU', 'fichiers/bohemian.jpg', '9.99'),
(9, '9 façons de faire la tarte au citron meringuée', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque lacus orci, eget venenatis felis iaculis quis. Cras leo quam, efficitur id lectus id, rhoncus fringilla purus. Aenean vehicula laoreet nunc vitae rhoncus. Integer condimentum rutrum metus, et mollis tellus dapibus in. Nulla faucibus dolor a finibus tempus. Phasellus et nibh ex. Integer suscipit facilisis elit, vitae pharetra magna laoreet nec. Nulla dapibus vel felis ut rhoncus. Etiam porttitor nulla vitae posuere viverra. ', 3, '2018-12-28 18:52:06', 1, 'http://localhost/mediatheque/public/fichiers/videos/test2.MOV', 'fichiers/tarte.jpg', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `abonnement_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_abonnement` (`id`),
  ADD CONSTRAINT `abonnement_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `achat_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `achat_ibfk_2` FOREIGN KEY (`id_video`) REFERENCES `video` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_video`) REFERENCES `video` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
