-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 04 juin 2024 à 12:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blindly`
--

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `name` varchar(100) NOT NULL,
  `popularity` int(8) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`name`, `popularity`, `color`) VALUES
('Blues', 98, '#2d32b5'),
('Classic', 41, '#4c9430'),
('Electro', 65, '#e6e208'),
('Hip-Hop', 36, '#676963'),
('Pop', 20, '#60D7D8'),
('Rock', 25, '#5E5A5A');

-- --------------------------------------------------------

--
-- Structure de la table `song`
--

CREATE TABLE `song` (
  `id` int(64) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `song`
--

INSERT INTO `song` (`id`, `title`, `author`, `genre`, `image`, `url`) VALUES
(1, 'Always and Forever', 'Zane Little', 'Pop', '../media/imgSong/AlwaysandForever.webp', '../media/song/AlwaysandForever.mp3'),
(2, 'Kung Fu', 'Bored With Four', 'Pop', '../media/imgSong/BoredWithFour.webp', '../media/song/KungFu.mp3'),
(3, 'Thank You', 'Bored With Four', 'Pop', '../media/imgSong/BoredWithFour.webp', '../media/song/ThankYou.mp3'),
(4, 'Powerless Together', 'Bored With Four', 'Pop', '../media/imgSong/BoredWithFour2.webp', '../media/song/PowerlessTogether.mp3'),
(5, 'Owl be yours', 'Amil Byleckie', 'Pop', '../media/imgSong/Owlbeyours.webp', '../media/song/Owlbeyours.mp3'),
(6, 'All the Pleasures Of the World', 'The Crayon Fields', 'Pop', '../media/imgSong/AllthePleasuresOftheWorld.webp', '../media/song/AllthePleasuresOftheWorld.mp3'),
(7, 'Spiders Are Everywhere !', 'Flaccid Ashbacks', 'Pop', '../media/imgSong/SpidersAreEverywhere.webp', '../media/song/SpidersAreEverywhere.mp3'),
(8, 'Susie Sunday', 'Flaccid Ashbacks', 'Pop', '../media/imgSong/SpidersAreEverywhere.webp', '../media/song/SusieSunday.mp3'),
(9, 'Maxim Gun', 'Red Crickets', 'Pop', '../media/imgSong/MaximGun.webp', '../media/song/MaximGun.mp3'),
(10, 'A La Fraîche', 'Wintermitts', 'Pop', '../media/imgSong/ALaFraiche.webp', '../media/song/ALaFraiche.mp3'),
(11, 'Vous ressemblez à mon ex', 'Le Manque', 'Pop', '../media/imgSong/Vousressemblezamonex.webp', '../media/song/Vousressemblezamonex.mp3'),
(12, 'Chop Chop', 'Shwa Losben', 'Pop', '../media/imgSong/ChopChop.webp', '../media/song/ChopChop.mp3'),
(13, 'Everything Fell Into Place', 'Shwa Losben', 'Pop', '../media/imgSong/ChopChop.webp', '../media/song/EverythinFellIntoPlace.mp3'),
(14, 'To The Wind', 'A la Mode', 'Pop', '../media/imgSong/ToTheWind.webp', '../media/song/ToTheWind.mp3'),
(15, 'Mind Reader Blues', 'Blind Boy Paxton', 'Blues', '../media/imgSong/MindReaderBlues.webp', '../media/song/MindReaderBlues.mp3'),
(16, 'Come on in My Kitchen', 'Nobody\'s Bizness', 'Blues', '../media/imgSong/ComeoninMyKitchen.webp', '../media/song/ComeoninMyKitchen.mp3'),
(17, 'If You Love Me Like You Say', 'Fat Possum Blues Caravan', 'Blues', '../media/imgSong/IfYouLoveMeLikeYouSay.webp', '../media/song/IfYouLoveMeLikeYouSay.mp3'),
(18, 'Nothing Really', 'Brother JT', 'Blues', '../media/imgSong/NothingReally.webp', '../media/song/NothingReally.mp3'),
(19, 'Down in the Dumps', 'Nobody\'s Bizness', 'Blues', '../media/imgSong/ComeoninMyKitchen.webp', '../media/song/DownintheDumps.mp3'),
(20, 'Workin Boy Blues', 'Bombay Laughing Club', 'Blues', '../media/imgSong/WorkinBoyBlues.webp\r\n', '../media/song/WorkinBoyBlues.mp3'),
(21, 'Gone Away', 'Cullah', 'Blues', '../media/imgSong/GoneAway.webp', '../media/song/GoneAway.mp3'),
(22, 'Riverse', 'Cullah', 'Blues', '../media/imgSong/GoneAway.webp', '../media/song/Riverse.mp3'),
(23, 'Paint Me (The Bad Guy)', 'Jon Shuemaker', 'Rock', '../media/imgSong/PaintMeTheBadGuy.webp', '../media/song/PaintMeTheBadGuy.mp3'),
(24, 'Year Of The Nines', 'The New Lines', 'Rock', '../media/imgSong/YearOfTheNines.webp', '../media/song/YearOfTheNines.mp3'),
(25, 'Tell me how', 'June Ryah', 'Rock', '../media/imgSong/Tellmehow.webp', '../media/song/Tellmehow.mp3'),
(26, 'Black Cat', 'June Ryah', 'Rock', '../media/imgSong/Tellmehow.webp', '../media/song/BlackCat.mp3'),
(27, 'Is it Summit ', 'The Sea Life', 'Rock', '../media/imgSong/IsItSummit.webp', '../media/song/IsItSummit.mp3'),
(28, 'Winter In Your Heart', 'Ultimate Painting', 'Rock', '../media/imgSong/WinterInYourHeart.webp', '../media/song/WinterInYourHeart.mp3'),
(29, 'Johnny Diesel', 'Noise Problems Selections', 'Rock', '../media/imgSong/NoiseProblemsSelections.webp', '../media/song/NoiseProblemsSelections.mp3'),
(30, 'Reaper', 'The Sea Life', 'Rock', '../media/imgSong/IsItSummit.webp', '../media/song/TheSeaLife.mp3'),
(31, 'Ejected From the Passenger Seat', 'Hot Garbage', 'Rock', '../media/imgSong/EjectedFromthePassengerSeat.webp', '../media/song/EjectedFromthePassengerSeat.mp3'),
(32, 'Pretty Ugly', '50FOOTWAVE', 'Rock', '../media/imgSong/PrettyUgly.webp', '../media/song/PrettyUgly.mp3'),
(33, 'This Is The Place', 'Litmus', 'Electro', '../media/imgSong/ThisIsThePlace.webp', '../media/song/ThisIsThePlace.mp3'),
(34, 'sync', 'SHOMOMOSE', 'Electro', '../media/imgSong/sync.webp', '../media/song/sync.mp3'),
(35, 'Big Dream', 'Chad Crouch', 'Electro', '../media/imgSong/BigDream.webp', '../media/song/BigDream.mp3'),
(36, 'Planetarium', 'Christian H. Soetemann', 'Electro', '../media/imgSong/Planetarium.webp', '../media/song/Planetarium.mp3'),
(37, 'yeah', 'Tep', 'Electro', '../media/imgSong/yeah.webp', '../media/song/yeah.mp3'),
(38, '23 Light Years', 'CavalloPazzo', 'Electro', '../media/imgSong/23LightYears.webp', '../media/song/23LightYears.mp3'),
(39, 'the white feathers of a little angel', 'ish10 yow1r0', 'Electro', '../media/imgSong/thewhitefeathersofalittleangel.webp', '../media/song/thewhitefeathersofalittleangel.mp3'),
(40, 'I know Who Killed Us', 'Bobb Bruno', 'Electro', '../media/imgSong/IknowWhoKilledUs.webp', '../media/song/IknowWhoKilledUs.mp3'),
(41, 'Pem Rajadahane Rukmani Devi', 'Milton Mallawarachchi', 'Classic', '../media/imgSong/PemRajadahaneRukmaniDevi.webp', '../media/song/PemRajadahaneRukmaniDevi.mp3'),
(42, 'Cantate Domino', 'Anonymous Choir', 'Classic', '../media/imgSong/PemRajadahaneRukmaniDevi.webp', '../media/song/CantateDomino.mp3'),
(43, 'Unus Ex Discipulis Meis', 'Anonymous Choir', 'Classic', '../media/imgSong/PemRajadahaneRukmaniDevi.webp', '../media/song/UnusExDiscipulisMeis.mp3'),
(44, 'Maio Maduro Maio', 'Lovira', 'Classic', '../media/imgSong/MaioMaduroMaio.webp', '../media/song/MaioMaduroMaio.mp3'),
(45, 'Chloe', 'Al Jolson', 'Classic', '../media/imgSong/PemRajadahaneRukmaniDevi.webp', '../media/song/Chloe.mp3'),
(46, 'The girl from the U.S.A.', 'Henry Burr', 'Classic', '../media/imgSong/PemRajadahaneRukmaniDevi.webp', '../media/song/ThegirlfromtheUSA.mp3'),
(47, 'Metamorphosis', 'Semion Krivenko-Adamov', 'Classic', '../media/imgSong/PemRajadahaneRukmaniDevi.webp', '../media/song/Metamorphosis.mp3'),
(48, 'No Coincidence', 'Brakhage', 'Hip-Hop', '../media/imgSong/NoCoincidence.webp', '../media/song/NoCoincidence.mp3'),
(49, 'Permission To Bash', 'THEESatisfaction', 'Hip-Hop', '../media/imgSong/PermissionToBash.webp', '../media/song/PermissionToBash.mp3'),
(50, 'Tijolo', 'J-K', 'Hip-Hop', '../media/imgSong/Tijolo.webp', '../media/song/Tijolo.mp3'),
(51, 'Dope Man', 'Yshwa', 'Hip-Hop', '../media/imgSong/DopeMan.webp', '../media/song/DopeMan.mp3'),
(52, 'Far Out', 'Opio', 'Hip-Hop', '../media/imgSong/FarOut.webp', '../media/song/FarOut.mp3'),
(53, 'Good lookin', 'Yshwa', 'Hip-Hop', '../media/imgSong/DopeMan.webp', '../media/song/Goodlookin.mp3'),
(54, 'DillA Remix', 'Alaclair Ensemble', 'Hip-Hop', '../media/imgSong/DillARemix.webp', '../media/song/DillARemix.mp3'),
(55, 'iBeast', 'Wildabeast', 'Hip-Hop', '../media/imgSong/PemRajadahaneRukmaniDevi.webp', '../media/song/iBeast.mp3'),
(56, 'Six Feet', 'Tha Connection', 'Hip-Hop', '../media/imgSong/SixFeet.webp', '../media/song/SixFeet.mp3'),
(57, 'Creative Commerce', 'Cadence', 'Hip-Hop', '../media/imgSong/CreativeCommerce.webp', '../media/song/CreativeCommerce.mp3');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`name`);

--
-- Index pour la table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainte` (`genre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `contrainte` FOREIGN KEY (`genre`) REFERENCES `genre` (`name`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
