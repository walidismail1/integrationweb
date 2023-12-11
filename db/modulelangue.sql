-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 11 déc. 2023 à 20:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `modulelangue`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `price`, `description`, `image_url`) VALUES
(30, 'Orgueil et préjugés', 'Jane Austen ', '5.9', 'Élisabeth Bennet a quatre sœurs et une mère qui ne songe qu\'à les marier. Quand parvient la nouvelle de l\'installation à Netherfield, le domaine voisin, de Mr Bingley, célibataire et beau parti, toutes les dames des alentours sont en émoi, d\'autant plus qu\'il est accompagné de son ami Mr Darcy, un jeune et riche aristocrate. Les préparatifs du prochain bal occupent tous les esprits...', 'orgueil_et_prejuges-651-264-432.jpg'),
(31, '1984', 'George Orwell ', '4.1', '\"De tous les carrefours importants, le visage à la moustache noire vous fixait du regard. Il y en avait un sur le mur d\'en face. BIG BROTHER VOUS REGARDE, répétait la légende, tandis que le regard des yeux noirs pénétrait les yeux de Winston... Au loin, un hélicoptère glissa entre les toits, plana un moment, telle une mouche bleue, puis repartir comme un flèche, dans un vol courbe. C\'était une patrouille qui venait mettre le feu aux fenêtres des gens. Mais les patrouilles n\'avaient pas d\'importance. Seule comptait la Police de la Pensée.\"  George Orwell dépeint dans le prophétique -1984- un terrifiant monde totalitaire.', '1984-72084-264-432.jpg'),
(32, 'L\'Étranger', 'Albert Camus', '6.3', 'Quand la sonnerie a encore retenti, que la porte du box s\'est ouverte, c\'est le silence de la salle qui est monté vers moi, le silence, et cette singulière sensation que j\'ai eue lorsque j\'ai constaté que le jeune journaliste avait détourné les yeux. Je n\'ai pas regardé du côté de Marie. Je n\'en ai pas eu le temps parce que le président m\'a dit dans une forme bizarre que j\'aurais la tête tranchée sur une place publique au nom du peuple français...', 'letranger-603252-264-432.jpg'),
(33, 'Hamlet', 'William Shakespeare ', '2', 'Hamlet est le fils du Roi de Danemark, remplacé sur le trône et en tant qu’époux de la reine Gertrude par son frère aîné, Claudius. Le spectre du souverain défunt apparaît une nuit à Hamlet pour lui révéler qu’il a été empoisonné par Claudius, et le pousser à le venger.  Hamlet feint la folie afin de démasquer son oncle usurpateur. On met cette folie passagère sur le compte de l’amour qu’il porterait à Ophélie, fille de Polonius, conseiller du roi.  Hamlet ourdit une nouvelle ruse et fait jouer par une troupe de théâtre la reconstitution des véritables circonstances de la mort de son père. Claudius, en interrompant les comédiens au beau milieu de la représentation, conforte Hamlet dans sa certitude. Il se résout à assassiner son oncle, mais hésite. Il décide de tout révéler à sa mère, et croyant que Claudius se dissimule derrière un rideau, y plante son épée, tuant non pas le régicide, mais son conseiller, Polonius. Claudius contraint Hamlet à l’exil en Angleterre. Ophélie folle de douleur se suicide par noyade, et Laërte, son frères, jure de venger sa sœur et son père en tuant Hamlet.  Hamlet ne tard pas à faire savoir qu’il retourne au Danemark, son bateau ayant été attaqué par des pirates. Claudius saisit l’opportunité de se débarrasser du dangereux héritier légitime, et fait en sorte que celui-ci affronte Laërte en duel. Il prend la double précaution d’enduire de poison la lame de ce dernier, et d’en verser également dans la coupe de vin de Hamlet.  Durant le combat, Gertrude boit à cette coupe et décède. Laërte quant à lui parvient à blesser Hamlet de sa lame empoisonnée, mais se blesse lui-même avec l’arme mortelle, et trépasse. Hamlet parvient à assassiner Claudius avant de succomber lui-même à sa blessure empoisonnée.  Fortinbras, seigneur norvégien qui s’apprêtait à déclarer la guerre au Danemark, arrive à Elseneur où l’histoire de Hamlet lui est contée. Il ordonne d’inhumer celui qui aurait été son ennemi avec tous les honneurs.', 'hamlet-4070553-264-432.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `comment_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
