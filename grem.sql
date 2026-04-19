-- MySQL dump 10.13  Distrib 9.6.0, for Linux (x86_64)
--
-- Host: localhost    Database: grem
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
--


--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int DEFAULT NULL,
  `review_id` int NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CF675F31B` (`author_id`),
  KEY `IDX_9474526C3E2E969B` (`review_id`),
  CONSTRAINT `FK_9474526C3E2E969B` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,2,1,'The 2.0 overhaul changed the game completely. Build variety is genuinely impressive now and Night City finally feels reactive.','Published','2025-02-04 12:00:00','2025-02-04 12:00:00'),(2,3,1,'Agree on the story. The ending I got surprised me — did not expect them to take it in that direction. Worth a second run.','Published','2025-02-04 14:00:00','2025-02-04 14:00:00'),(3,4,2,'The underground map alone is worth the price of entry. Stumbled into it completely by accident and spent three hours there.','Published','2025-02-08 10:00:00','2025-02-08 10:00:00'),(4,5,2,'The DLC final boss is one of the hardest things I have ever encountered in a game. Took me four days. Do not regret a minute of it.','Published','2025-02-08 15:00:00','2025-02-08 15:00:00'),(5,2,3,'The Bloody Baron questline genuinely has no equivalent in the medium. Every choice feels real and the consequences follow through properly.','Published','2025-02-13 11:00:00','2025-02-13 11:00:00'),(6,4,3,'Blood and Wine is better than most full games. The ending of that expansion stayed with me longer than the main story did.','Published','2025-02-13 16:00:00','2025-02-13 16:00:00'),(7,3,4,'Chapter six is devastating. The writing in that section does things that prestige television rarely manages.','Published','2025-02-18 09:00:00','2025-02-18 09:00:00'),(8,5,4,'The strangers system is what I keep coming back to. Found a complete story arc across three separate encounters in different parts of the map.','Published','2025-02-18 17:00:00','2025-02-18 17:00:00'),(9,2,5,'The Atreus sections added more than I expected. His perspective on the events makes the overall story land differently.','Published','2025-02-23 10:00:00','2025-02-23 10:00:00'),(10,4,5,'The final realm set pieces are the most technically impressive things I have seen in a game this generation. Santa Monica knows what they are doing.','Published','2025-02-23 18:00:00','2025-02-23 18:00:00'),(11,2,6,'Two hundred hours and I am still encountering dialogue I have not seen. The volume of written content in this game is genuinely staggering.','Published','2025-02-28 11:00:00','2025-02-28 11:00:00'),(12,3,6,'Co-op is a completely different game. Four people making conflicting choices produces situations the designers clearly did not script. It is brilliant.','Published','2025-02-28 19:00:00','2025-02-28 19:00:00'),(13,4,7,'The boss design in this game is exceptional throughout. Each one introduces a mechanic it expects you to master before it escalates.','Published','2025-03-04 10:00:00','2025-03-04 10:00:00'),(14,5,7,'Three developers built this entire world. The scale of the achievement relative to the team size is almost impossible to explain to someone who has not played it.','Published','2025-03-04 16:00:00','2025-03-04 16:00:00'),(15,2,8,'The point where the full narrative picture assembled itself was one of the most affecting moments I have had in a game in years.','Published','2025-03-09 11:00:00','2025-03-09 11:00:00'),(16,3,8,'Every rogue-like I play now gets measured against this. Most of them fail the comparison.','Published','2025-03-09 20:00:00','2025-03-09 20:00:00'),(17,4,9,'Some of the boss arenas in chapter three are the most visually inventive I have encountered. The source material clearly gave the designers a lot to work with.','Published','2025-03-14 12:00:00','2025-03-14 12:00:00'),(18,5,9,'A remarkable first project at this scale. Whatever they build next will be very interesting to watch.','Published','2025-03-14 18:00:00','2025-03-14 18:00:00'),(19,2,10,'The final sequence tests everything the game taught you over sixty hours and does it fairly. That is harder to design than it sounds.','Published','2025-03-19 10:00:00','2025-03-19 10:00:00'),(20,3,10,'The moment the parry rhythm clicked was the most satisfying mechanical revelation I have experienced in any action game.','Published','2025-03-19 17:00:00','2025-03-19 17:00:00');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `developer`
--

DROP TABLE IF EXISTS `developer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `developer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developer`
--

LOCK TABLES `developer` WRITE;
/*!40000 ALTER TABLE `developer` DISABLE KEYS */;
INSERT INTO `developer` VALUES (1,'CD Projekt Red','cd-projekt-red','Poland','https://cdprojektred.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(2,'FromSoftware','fromsoftware','Japan','https://www.fromsoftware.jp','2025-01-01 00:00:00','2025-01-01 00:00:00'),(3,'Rockstar Games','rockstar-games','USA','https://www.rockstargames.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(4,'Santa Monica Studio','santa-monica-studio','USA','https://sms.playstation.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(5,'Larian Studios','larian-studios','Belgium','https://larian.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(6,'Naughty Dog','naughty-dog','USA','https://www.naughtydog.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(7,'Team Cherry','team-cherry','Australia','https://www.teamcherry.com.au','2025-01-01 00:00:00','2025-01-01 00:00:00'),(8,'Supergiant Games','supergiant-games','USA','https://www.supergiantgames.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(9,'Game Science','game-science','China','https://www.heishouyouxi.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(10,'Insomniac Games','insomniac-games','USA','https://insomniac.games','2025-01-01 00:00:00','2025-01-01 00:00:00');
/*!40000 ALTER TABLE `developer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20250401131023','2025-04-01 13:10:59',795);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_date_world` date DEFAULT NULL,
  `release_date_france` date DEFAULT NULL,
  `platform_requirements_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age_rating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` json DEFAULT NULL,
  `screenshot` json DEFAULT NULL,
  `trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'Cyberpunk 2077','Published','cyberpunk-2077','Cyberpunk 2077 is an open-world action RPG set in Night City, a megalopolis obsessed with power, glamour, and body modification. You play as V, a mercenary outlaw chasing a one-of-a-kind implant that is the key to immortality. The choices you make shape the story and the world around you.\n\nAfter a rough launch in 2020, CD Projekt Red spent years rebuilding the game. The 2.0 update and Phantom Liberty expansion in 2023 overhauled the police system, skill trees, and vehicle combat, adding a compelling spy-thriller storyline set in the new district of Dogtown.\n\nWith over 25 million copies sold, Cyberpunk 2077 is now considered one of the best RPGs of its generation — a redemption story as compelling as the game itself.','An open-world RPG set in the dystopian Night City. Play as V, a mercenary fighting for survival and immortality in a world of megacorporations and high technology.','2020-12-10','2020-12-10','High','18+','https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg','[\"en\", \"fr\", \"de\", \"ru\", \"pl\"]',NULL,'https://www.youtube.com/watch?v=8X2kIfS6fb8','https://www.cyberpunk.net','2025-01-10 12:00:00','2025-01-10 12:00:00'),(2,'Elden Ring','Published','elden-ring','Elden Ring is an action RPG developed by FromSoftware in collaboration with fantasy author George R.R. Martin, who provided the world\'s lore and mythos. Set in the Lands Between, players take on the role of a Tarnished, an outcast summoned back to restore the shattered Elden Ring and become the Elden Lord.\n\nThe game expands on FromSoftware\'s signature challenging combat with a fully open world, mounted exploration on a spectral steed, and a vast underground map to discover. Its interconnected legacy dungeons are some of the most intricately designed environments in gaming history.\n\nElden Ring won Game of the Year at The Game Awards 2022 and sold over 20 million copies, cementing FromSoftware\'s place as one of the most influential studios in the industry.','An open-world action RPG by FromSoftware and George R.R. Martin. Explore the Lands Between, conquer fearsome bosses, and claim the shattered Elden Ring.','2022-02-25','2022-02-25','Medium','16+','https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg','[\"en\", \"fr\", \"de\", \"ja\", \"ru\"]',NULL,'https://www.youtube.com/watch?v=E3Huy2cdih0','https://en.bandainamcoent.eu/elden-ring','2025-01-12 12:00:00','2025-01-12 12:00:00'),(3,'The Witcher 3: Wild Hunt','Published','the-witcher-3','The Witcher 3: Wild Hunt is an open-world RPG following Geralt of Rivia, a monster hunter for hire, as he searches for his missing adopted daughter across a war-ravaged fantasy world. The game\'s main questline is interwoven with two massive expansions — Hearts of Stone and Blood and Wine — that together add over 50 hours of content.\n\nThe world of The Witcher 3 is alive with detail: every village has its own troubles, every contract tells a story, and the choices players make have meaningful consequences. The game redefined storytelling standards for open-world RPGs.\n\nWith over 50 million copies sold across all platforms, The Witcher 3 remains a benchmark of the genre more than a decade after release. The next-gen update in 2022 brought ray tracing, faster loading, and hundreds of visual improvements.','Follow Geralt of Rivia across a vast open world teeming with monsters, politics, and moral choices. The gold standard of open-world RPG storytelling.','2015-05-19','2015-05-19','Medium','18+','https://cdn.akamai.steamstatic.com/steam/apps/292030/header.jpg','[\"en\", \"fr\", \"de\", \"pl\", \"ru\"]',NULL,'https://www.youtube.com/watch?v=c0i88t0Kacs','https://www.thewitcher.com','2025-01-14 12:00:00','2025-01-14 12:00:00'),(4,'Red Dead Redemption 2','Published','red-dead-redemption-2','Red Dead Redemption 2 is an epic open-world western developed by Rockstar Games. Set in 1899, it tells the story of Arthur Morgan, an outlaw in the Van der Linde gang, navigating the decline of the American frontier as federal agents and rival gangs close in from all sides.\n\nThe game features one of the most detailed open worlds ever created, with dynamic weather, realistic animal behavior, and a living ecosystem. Every character interaction, from bar fights to chance encounters in the wilderness, feels grounded and authentic.\n\nRed Dead Redemption 2 won numerous Game of the Year awards and is widely considered one of the greatest games ever made. Its online component, Red Dead Online, continues to receive updates years after launch.','An epic western adventure following outlaw Arthur Morgan as he navigates survival, loyalty, and the end of an era in a breathtaking open world.','2018-10-26','2018-10-26','High','18+','https://cdn.akamai.steamstatic.com/steam/apps/1174180/header.jpg','[\"en\", \"fr\", \"de\", \"es\"]',NULL,'https://www.youtube.com/watch?v=gmA6MrX81z4','https://www.rockstargames.com/reddeadredemption2','2025-01-16 12:00:00','2025-01-16 12:00:00'),(5,'God of War: Ragnarok','Published','god-of-war-ragnarok','God of War: Ragnarok is the direct sequel to the 2018 reboot, continuing the story of Kratos and his teenage son Atreus across the Nine Realms of Norse mythology. The game picks up three years after the events of the first game, with Fimbulwinter — the great winter preceding Ragnarok — already underway.\n\nThe combat system has been expanded with new weapons, abilities, and shield mechanics. Atreus becomes a fully playable character in several pivotal sections, allowing the story to explore his perspective and coming-of-age journey in depth.\n\nReleased on PlayStation 4 and 5, Ragnarok won multiple Game of the Year awards and was praised as one of the best action-adventure games ever crafted, combining spectacular set pieces with genuine emotional depth.','Continue the journey of Kratos and Atreus through the Norse realms as they face the coming of Ragnarok and the inevitable clash with the Aesir gods.','2022-11-09','2022-11-09','Medium','18+','https://cdn.akamai.steamstatic.com/steam/apps/2322010/header.jpg','[\"en\", \"fr\", \"de\", \"es\"]',NULL,'https://www.youtube.com/watch?v=EE-4GvjKcfs','https://www.playstation.com/en-us/games/god-of-war-ragnarok','2025-01-18 12:00:00','2025-01-18 12:00:00'),(6,'Baldur\'s Gate 3','Published','baldurs-gate-3','Baldur\'s Gate 3 is a story-rich party-based RPG developed by Larian Studios, set in the Forgotten Realms of Dungeons & Dragons. Players and up to three friends can create characters, gather a party of companions, and embark on a journey through Faer&#x00FB;n — from the depths of the Underdark to the shining city of Baldur\'s Gate itself.\n\nThe game adapts the D&D 5th Edition ruleset with remarkable fidelity, translating the freedom of tabletop roleplaying into a video game with branching dialogue, environmental storytelling, and combat that rewards creative thinking. Characters can be romanced, betrayed, or sacrificed — the world reacts to every choice.\n\nBaldur\'s Gate 3 won Game of the Year 2023 at The Game Awards and is considered a landmark achievement in RPG design, selling over 10 million copies within its first year.','A sprawling RPG set in the Forgotten Realms. Gather your party, roll for initiative, and forge your own path through a world of magic, mystery, and consequence.','2023-08-03','2023-08-03','Medium','18+','https://cdn.akamai.steamstatic.com/steam/apps/1086940/header.jpg','[\"en\", \"fr\", \"de\", \"es\", \"ru\"]',NULL,'https://www.youtube.com/watch?v=s8xfS2CiJNs','https://baldursgate3.game','2025-01-20 12:00:00','2025-01-20 12:00:00'),(7,'Hollow Knight','Published','hollow-knight','Hollow Knight is a challenging 2D action-adventure game developed by Team Cherry, an independent studio of just three people. Set in Hallownest, a vast underground kingdom of insects, the game follows a silent knight exploring labyrinthine tunnels and ruins to uncover the kingdom\'s ancient secrets.\n\nThe game is renowned for its hand-drawn art style, tight and responsive controls, and a sprawling interconnected world designed in the Metroidvania tradition. Combat is precise and demanding, with boss fights that have become legendary among fans of the genre.\n\nHollow Knight sold over 5 million copies and is widely celebrated as one of the greatest indie games ever made. Its sequel, Hollow Knight: Silksong, is one of the most anticipated games in development.','Explore the vast underground kingdom of Hallownest in this challenging 2D Metroidvania. Beautiful, mysterious, and brutally unforgiving.','2017-02-24','2017-02-24','Low','7+','https://cdn.akamai.steamstatic.com/steam/apps/367520/header.jpg','[\"en\", \"fr\", \"de\", \"ru\"]',NULL,'https://www.youtube.com/watch?v=UAO2urG23S4','https://www.hollowknight.com','2025-01-22 12:00:00','2025-01-22 12:00:00'),(8,'Hades','Published','hades','Hades is a rogue-like dungeon crawler developed by Supergiant Games in which you play as Zagreus, immortal son of the God of the Dead, attempting to escape from the Underworld. Each run through Tartarus, Asphodel, and Elysium is unique, fueled by a combination of powerful boons from the Olympian gods and a rich cast of mythological characters.\n\nWhat sets Hades apart is its narrative integration: every death advances the story, with new dialogue, revelations, and relationship developments. The writing is sharp and witty, making each failed escape attempt feel meaningful rather than frustrating.\n\nHades won numerous awards including Best Action Game and Best Indie Game at The Game Awards 2020. It was the first video game to win a Hugo Award, cementing its status as a cultural landmark.','Play as Zagreus and battle your way out of the Underworld in this genre-defining rogue-like. Every run tells a story; every death makes you stronger.','2020-09-17','2020-09-17','Low','12+','https://cdn.akamai.steamstatic.com/steam/apps/1145360/header.jpg','[\"en\", \"fr\", \"de\", \"ru\"]',NULL,'https://www.youtube.com/watch?v=91t0ha9x0AE','https://www.supergiantgames.com/games/hades','2025-01-24 12:00:00','2025-01-24 12:00:00'),(9,'Black Myth: Wukong','Published','black-myth-wukong','Black Myth: Wukong is an action RPG developed by Game Science, inspired by the 16th-century Chinese novel Journey to the West. Players take on the role of the Destined One, a monkey warrior who must battle mythological creatures and powerful bosses to uncover the truth behind the legendary Sun Wukong\'s legacy.\n\nThe game features fast-paced, staff-based combat with shapeshifting abilities, drawing mechanics from Souls-like games while maintaining a distinct identity. Its visual fidelity on PC and PlayStation 5 is considered among the best of any game released in 2024.\n\nBlack Myth: Wukong became the best-selling Chinese game of all time, selling over 10 million copies in its first three days. It opened a new chapter for the Chinese game development industry on the global stage.','An action RPG rooted in Chinese mythology. Master the staff, transform into mythical creatures, and uncover the legacy of the Great Sage, Sun Wukong.','2024-08-20','2024-08-20','High','16+','https://cdn.akamai.steamstatic.com/steam/apps/2358720/header.jpg','[\"en\", \"fr\", \"de\", \"zh\", \"ru\"]',NULL,'https://www.youtube.com/watch?v=lvOu8Xt7JVc','https://www.heishouyouxi.com/wukong','2025-01-26 12:00:00','2025-01-26 12:00:00'),(10,'Sekiro: Shadows Die Twice','Published','sekiro-shadows-die-twice','Sekiro: Shadows Die Twice is an action-adventure game developed by FromSoftware set in a reimagined late Sengoku-era Japan. Players control Wolf, a shinobi tasked with rescuing his kidnapped lord and taking revenge on the samurai clan that severed his arm.\n\nUnlike FromSoftware\'s Soulsborne games, Sekiro focuses on a single fixed protagonist with a defined skillset. Combat centers on a posture-breaking system that rewards aggressive play and precise parrying over cautious distance management. The result is one of the most demanding and satisfying combat systems ever designed.\n\nSekiro won Game of the Year at The Game Awards 2019. Despite its punishing difficulty, it remains one of the highest-rated games of its generation and is praised for its extraordinary mechanical depth.','Master the way of the shinobi in feudal Japan. Sekiro\'s uncompromising combat system rewards patience, aggression, and perfect timing above all else.','2019-03-22','2019-03-22','Medium','18+','https://cdn.akamai.steamstatic.com/steam/apps/814380/header.jpg','[\"en\", \"fr\", \"de\", \"ja\"]',NULL,'https://www.youtube.com/watch?v=rXMX4YJ7Lks','https://www.sekirothegame.com','2025-01-28 12:00:00','2025-01-28 12:00:00');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_developer`
--

DROP TABLE IF EXISTS `game_developer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_developer` (
  `game_id` int NOT NULL,
  `developer_id` int NOT NULL,
  PRIMARY KEY (`game_id`,`developer_id`),
  KEY `IDX_B75D4A98E48FD905` (`game_id`),
  KEY `IDX_B75D4A9864DD9267` (`developer_id`),
  CONSTRAINT `FK_B75D4A9864DD9267` FOREIGN KEY (`developer_id`) REFERENCES `developer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B75D4A98E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_developer`
--

LOCK TABLES `game_developer` WRITE;
/*!40000 ALTER TABLE `game_developer` DISABLE KEYS */;
INSERT INTO `game_developer` VALUES (1,1),(2,2),(3,1),(4,3),(5,4),(6,5),(7,7),(8,8),(9,9),(10,2);
/*!40000 ALTER TABLE `game_developer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_genre`
--

DROP TABLE IF EXISTS `game_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_genre` (
  `game_id` int NOT NULL,
  `genre_id` int NOT NULL,
  PRIMARY KEY (`game_id`,`genre_id`),
  KEY `IDX_B1634A77E48FD905` (`game_id`),
  KEY `IDX_B1634A774296D31F` (`genre_id`),
  CONSTRAINT `FK_B1634A774296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B1634A77E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_genre`
--

LOCK TABLES `game_genre` WRITE;
/*!40000 ALTER TABLE `game_genre` DISABLE KEYS */;
INSERT INTO `game_genre` VALUES (1,1),(1,4),(2,1),(2,2),(2,5),(3,1),(3,4),(4,2),(4,3),(4,4),(5,2),(5,3),(6,1),(6,6),(7,2),(7,7),(8,1),(8,2),(9,1),(9,2),(10,2),(10,3);
/*!40000 ALTER TABLE `game_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_news`
--

DROP TABLE IF EXISTS `game_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_news` (
  `game_id` int NOT NULL,
  `news_id` int NOT NULL,
  PRIMARY KEY (`game_id`,`news_id`),
  KEY `IDX_F6C6F57CE48FD905` (`game_id`),
  KEY `IDX_F6C6F57CB5A459A0` (`news_id`),
  CONSTRAINT `FK_F6C6F57CB5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F6C6F57CE48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_news`
--

LOCK TABLES `game_news` WRITE;
/*!40000 ALTER TABLE `game_news` DISABLE KEYS */;
INSERT INTO `game_news` VALUES (1,1),(2,2),(2,7),(3,3),(4,4),(5,8),(6,5),(7,9),(8,10),(9,6),(10,7);
/*!40000 ALTER TABLE `game_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_platform`
--

DROP TABLE IF EXISTS `game_platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_platform` (
  `game_id` int NOT NULL,
  `platform_id` int NOT NULL,
  PRIMARY KEY (`game_id`,`platform_id`),
  KEY `IDX_92162FEDE48FD905` (`game_id`),
  KEY `IDX_92162FEDFFE6496F` (`platform_id`),
  CONSTRAINT `FK_92162FEDE48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_92162FEDFFE6496F` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_platform`
--

LOCK TABLES `game_platform` WRITE;
/*!40000 ALTER TABLE `game_platform` DISABLE KEYS */;
INSERT INTO `game_platform` VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,2),(2,3),(2,4),(3,1),(3,2),(3,3),(3,5),(4,1),(4,3),(4,4),(5,2),(5,3),(6,1),(6,2),(7,1),(7,3),(7,5),(8,1),(8,2),(8,3),(8,4),(8,5),(9,1),(9,2),(10,1),(10,2),(10,3),(10,4);
/*!40000 ALTER TABLE `game_platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_publisher`
--

DROP TABLE IF EXISTS `game_publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_publisher` (
  `game_id` int NOT NULL,
  `publisher_id` int NOT NULL,
  PRIMARY KEY (`game_id`,`publisher_id`),
  KEY `IDX_4E4E1444E48FD905` (`game_id`),
  KEY `IDX_4E4E144440C86FCE` (`publisher_id`),
  CONSTRAINT `FK_4E4E144440C86FCE` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4E4E1444E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_publisher`
--

LOCK TABLES `game_publisher` WRITE;
/*!40000 ALTER TABLE `game_publisher` DISABLE KEYS */;
INSERT INTO `game_publisher` VALUES (1,1),(2,2),(3,1),(4,3),(5,4),(6,5),(7,6),(8,7),(9,8),(10,2);
/*!40000 ALTER TABLE `game_publisher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_review`
--

DROP TABLE IF EXISTS `game_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game_review` (
  `game_id` int NOT NULL,
  `review_id` int NOT NULL,
  PRIMARY KEY (`game_id`,`review_id`),
  KEY `IDX_4762C0EE48FD905` (`game_id`),
  KEY `IDX_4762C0E3E2E969B` (`review_id`),
  CONSTRAINT `FK_4762C0E3E2E969B` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4762C0EE48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_review`
--

LOCK TABLES `game_review` WRITE;
/*!40000 ALTER TABLE `game_review` DISABLE KEYS */;
INSERT INTO `game_review` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);
/*!40000 ALTER TABLE `game_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'RPG','rpg','2025-01-01 00:00:00','2025-01-01 00:00:00'),(2,'Action','action','2025-01-01 00:00:00','2025-01-01 00:00:00'),(3,'Adventure','adventure','2025-01-01 00:00:00','2025-01-01 00:00:00'),(4,'Open World','open-world','2025-01-01 00:00:00','2025-01-01 00:00:00'),(5,'Souls-like','souls-like','2025-01-01 00:00:00','2025-01-01 00:00:00'),(6,'Strategy','strategy','2025-01-01 00:00:00','2025-01-01 00:00:00'),(7,'Platformer','platformer','2025-01-01 00:00:00','2025-01-01 00:00:00'),(8,'Shooter','shooter','2025-01-01 00:00:00','2025-01-01 00:00:00');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1DD39950F675F31B` (`author_id`),
  CONSTRAINT `FK_1DD39950F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,1,'Cyberpunk 2077 Expansion Pushes Past Major Sales Milestone','cyberpunk-2077-expansion-sales-milestone','The post-launch expansion for Cyberpunk 2077 has continued to perform strongly in the market, crossing a significant sales threshold that few standalone DLC products ever reach. CD Projekt Red confirmed the figures in a quarterly investor update, describing the results as exceeding internal projections.\n\nMuch of the expansion\'s commercial success has been attributed to the simultaneous release of a sweeping gameplay overhaul that addressed long-standing criticisms of the base game. The combination drew back lapsed players and attracted newcomers, resulting in some of the highest concurrent player counts the game had seen since launch.\n\nThe studio has indicated that no further major expansions are planned for this title, with resources now directed toward the next project in the pipeline. However, the game itself will continue to receive smaller maintenance updates for the foreseeable future.','CD Projekt Red\'s expansion for Cyberpunk 2077 surpassed a major commercial milestone, fueled by strong player engagement following the simultaneous release of a major gameplay update.','https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg','Published','2025-02-01 10:00:00','2025-02-01 10:00:00'),(2,1,'Elden Ring DLC Sets New Benchmark for Expansion Content','elden-ring-dlc-benchmark','The first major paid expansion for Elden Ring has established a new commercial benchmark for DLC products in the action RPG space, according to sales data released by the publisher. The figures represent the fastest opening week for any expansion in the studio\'s catalog.\n\nThe expansion introduces a substantial new region with its own progression mechanics layered on top of the base game systems. Early player feedback has been polarized on difficulty, with many praising the ambition of the encounter design while others questioned whether the challenge had been calibrated appropriately for the intended audience.\n\nCritics have largely been enthusiastic, with several noting that the new content expands meaningfully on the world\'s lore while providing dozens of additional hours for players who completed the main campaign. The studio has not yet indicated plans for additional paid content.','Elden Ring\'s first paid expansion posted record-breaking opening sales figures, setting a new standard for what players can expect from action RPG downloadable content.','https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg','Published','2025-02-05 10:00:00','2025-02-05 10:00:00'),(3,2,'New Witcher Title Transitions Into Full Development Phase','new-witcher-title-full-development','CD Projekt Red has announced that the next installment in the Witcher franchise has formally entered full production, marking a transition from the pre-production and prototyping phase that the project has been in for the past two years. The studio shared the update as part of a broader company roadmap presentation.\n\nThe new title will shift the series\' protagonist focus, introducing a different lead character with connections to the existing lore. The narrative will be built to function as both a continuation for longtime fans and an accessible entry point for players new to the world.\n\nDevelopment is proceeding on an engine that represents a significant technical departure from the studio\'s previous projects. The team has expressed confidence that the switch will result in improvements to development efficiency and final visual quality, though no release window has been announced.','The next Witcher game has officially moved into full production at CD Projekt Red, with a new protagonist and a different engine powering the experience.','https://cdn.akamai.steamstatic.com/steam/apps/292030/header.jpg','Published','2025-02-10 10:00:00','2025-02-10 10:00:00'),(4,2,'Rockstar Confirms Release Period for Long-Awaited Open-World Sequel','rockstar-open-world-sequel-release','Rockstar Games has confirmed a release period for its next open-world title, ending a period of extended speculation among the gaming community. The confirmation came via an official update that included new details about the game\'s setting and playable cast.\n\nThe game is set in a fictional recreation of a sun-drenched American city and surrounding region, and will feature two playable protagonists whose stories intertwine across the main narrative. Early materials suggest a significant leap in environmental detail and NPC behavior compared to the studio\'s previous output.\n\nThe title is targeting current-generation platforms at launch, with no immediate announcement regarding a PC version. Given the studio\'s previous release pattern, industry analysts expect a staggered release schedule, though Rockstar has not commented on post-launch platform availability.','Rockstar Games has confirmed a release period for its next major open-world game, providing the first concrete timeline for one of the most anticipated titles in recent memory.','https://cdn.akamai.steamstatic.com/steam/apps/1174180/header.jpg','Published','2025-02-15 10:00:00','2025-02-15 10:00:00'),(5,3,'Party-Based RPG Takes Top Honor at Annual Industry Awards','party-rpg-takes-top-award','Larian Studios\' party-based role-playing game claimed the top prize at a prominent annual industry ceremony, capping a year in which it dominated sales charts and critical rankings across the genre. The studio founder accepted the award on behalf of the full development team.\n\nThe acceptance speech drew widespread attention for its candid remarks about working conditions in the industry and the importance of listening to community feedback during development. The game had benefited from an extended early access period during which player response shaped a number of key design decisions.\n\nThe win was notable given the strength of the competition, which included several high-profile titles from major publishers. The result was interpreted by many in the industry as a signal that production scale and marketing budgets are no longer reliable predictors of critical recognition.','An independently published party-based RPG won the top prize at one of gaming\'s most prestigious annual ceremonies, edging out several high-profile releases.','https://cdn.akamai.steamstatic.com/steam/apps/1086940/header.jpg','Published','2025-02-20 10:00:00','2025-02-20 10:00:00'),(6,3,'Chinese Action RPG Breaks Regional and Global Sales Records','chinese-action-rpg-sales-records','A debut action RPG from a Chinese independent studio has set new records for the regional games industry, posting opening sales figures that no Chinese-developed title had previously achieved. The game sold several million copies within the first few days of its worldwide release across PC and console platforms.\n\nThe game\'s success has been attributed to a combination of exceptionally high visual quality, a combat system influenced by well-established action RPG conventions, and strong cultural resonance with its source material. Marketing materials released over a four-year development period built sustained international anticipation.\n\nAnalysts have noted that the result marks a meaningful shift in the global games market, suggesting that Chinese studios are now capable of competing at the highest commercial and critical level with established developers from Japan, North America, and Europe.','A Chinese-developed action RPG posted record-breaking global sales on launch, marking a new era for the country\'s position in the premium games industry.','https://cdn.akamai.steamstatic.com/steam/apps/2358720/header.jpg','Published','2025-02-25 10:00:00','2025-02-25 10:00:00'),(7,4,'FromSoftware Studio Head Discusses Direction After Open-World Success','fromsoftware-direction-after-open-world','Hidetaka Miyazaki, the studio head at FromSoftware, has discussed the direction of the company\'s next project in a rare extended interview, hinting that the team is inclined toward new creative territory rather than a direct follow-up to their most recent release.\n\nMiyazaki described the studio\'s ongoing interest in subverting player expectations and cited the value of exploring unfamiliar settings and mechanics. While he did not provide specifics about the next project, he indicated that a formal announcement would come when the team felt the concept was ready to be shared publicly.\n\nThe comments have generated significant speculation in the gaming community, with fans proposing various interpretations of Miyazaki\'s phrasing. The studio has a track record of surprising its audience with significant departures between releases, and most observers expect the next title to diverge meaningfully from recent output.','FromSoftware\'s Hidetaka Miyazaki has hinted that the studio\'s next game will explore new creative directions rather than directly continuing recent successful formulas.','https://cdn.akamai.steamstatic.com/steam/apps/814380/header.jpg','Published','2025-03-01 10:00:00','2025-03-01 10:00:00'),(8,4,'Action-Adventure Franchise Crosses Major Lifetime Sales Threshold','action-adventure-franchise-lifetime-sales','Sony Interactive Entertainment has confirmed that one of its flagship action-adventure franchises has surpassed a significant lifetime sales milestone, reflecting the series\' continued relevance across multiple console generations. The announcement covered all entries in the franchise from its original release onward.\n\nThe most recent mainline entry contributed substantially to the milestone, having sold exceptionally well since its launch on PlayStation hardware. The title was notable for its narrative ambition and the depth of its character writing, which drew comparisons to prestige television rather than conventional video game storytelling.\n\nA PC release of the most recent sequel has been confirmed for a future date, following the positive reception of its predecessor on that platform. No details regarding a follow-up entry in the franchise have been announced, though the studio has indicated that the property remains a priority.','One of PlayStation\'s most celebrated action-adventure franchises has crossed a major lifetime sales milestone, reflecting strong performance across multiple generations.','https://cdn.akamai.steamstatic.com/steam/apps/2322010/header.jpg','Published','2025-03-05 10:00:00','2025-03-05 10:00:00'),(9,5,'Anticipated Indie Sequel Remains in Development, Studio Confirms','indie-sequel-development-confirmed','Team Cherry has provided a brief update confirming that development on the sequel to their acclaimed underground exploration game is continuing, following an extended period of near-silence from the studio. The update did not include a release date or detailed information about the current state of the project.\n\nThe studio reiterated its commitment to delivering the game only when it meets the standard they have set for themselves, pointing to the extended development of the original title as evidence of their process. The sequel was first announced several years ago and has become one of the most discussed unreleased games in the independent games space.\n\nCommunity reaction to the update was mixed, with many players expressing understanding of the studio\'s small size and independent status, while others voiced frustration at the lack of concrete information. Team Cherry has not addressed the question of whether the scope of the project has grown beyond original intentions.','Team Cherry confirmed that their highly anticipated indie sequel is still in active development, though no release window or new gameplay details were shared.','https://cdn.akamai.steamstatic.com/steam/apps/367520/header.jpg','Published','2025-03-10 10:00:00','2025-03-10 10:00:00'),(10,5,'Rogue-Like Sequel Enters Early Access to Strong Initial Response','roguelike-sequel-early-access','Supergiant Games has launched the early access phase of the sequel to their award-winning rogue-like dungeon crawler, receiving an enthusiastic initial response from both critics and the player community. The early access build contains a substantial portion of the planned content, with additional story and gameplay content to be added throughout the access period.\n\nThe sequel introduces a new protagonist and expands the scope of the original game\'s setting in ways that reviewers have described as both surprising and coherent with the existing lore. New mechanics including a broader ability set and a surface-world exploration component have been highlighted as significant additions to the formula.\n\nThe studio has historically used the early access model to incorporate player feedback into the final product, a practice that was credited with improving several key systems in the original title before its full release. No estimated date for the completion of early access has been provided.','Supergiant Games\' sequel to their acclaimed rogue-like entered early access to strong reviews, introducing a new protagonist and expanded mechanics.','https://cdn.akamai.steamstatic.com/steam/apps/1145360/header.jpg','Published','2025-03-15 10:00:00','2025-03-15 10:00:00');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_tag`
--

DROP TABLE IF EXISTS `news_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news_tag` (
  `news_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`news_id`,`tag_id`),
  KEY `IDX_BE3ED8A1B5A459A0` (`news_id`),
  KEY `IDX_BE3ED8A1BAD26311` (`tag_id`),
  CONSTRAINT `FK_BE3ED8A1B5A459A0` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_BE3ED8A1BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_tag`
--

LOCK TABLES `news_tag` WRITE;
/*!40000 ALTER TABLE `news_tag` DISABLE KEYS */;
INSERT INTO `news_tag` VALUES (1,1),(1,7),(2,2),(2,6),(3,3),(3,9),(4,1),(4,10),(5,3),(5,4),(6,2),(6,9),(7,2),(7,6),(8,3),(8,5),(9,5),(9,8),(10,3),(10,8);
/*!40000 ALTER TABLE `news_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platform`
--

DROP TABLE IF EXISTS `platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `platform` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platform`
--

LOCK TABLES `platform` WRITE;
/*!40000 ALTER TABLE `platform` DISABLE KEYS */;
INSERT INTO `platform` VALUES (1,'PC','pc','2025-01-01 00:00:00','2025-01-01 00:00:00'),(2,'PlayStation 5','playstation-5','2025-01-01 00:00:00','2025-01-01 00:00:00'),(3,'PlayStation 4','playstation-4','2025-01-01 00:00:00','2025-01-01 00:00:00'),(4,'Xbox Series X/S','xbox-series','2025-01-01 00:00:00','2025-01-01 00:00:00'),(5,'Nintendo Switch','nintendo-switch','2025-01-01 00:00:00','2025-01-01 00:00:00');
/*!40000 ALTER TABLE `platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publisher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher`
--

LOCK TABLES `publisher` WRITE;
/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
INSERT INTO `publisher` VALUES (1,'CD Projekt','cd-projekt','Poland','https://cdprojekt.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(2,'Bandai Namco Entertainment','bandai-namco','Japan','https://www.bandainamcoent.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(3,'Rockstar Games','rockstar-games-pub','USA','https://www.rockstargames.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(4,'Sony Interactive Entertainment','sony-interactive','USA','https://www.sie.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(5,'Larian Studios','larian-studios-pub','Belgium','https://larian.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(6,'Team Cherry','team-cherry-pub','Australia','https://www.teamcherry.com.au','2025-01-01 00:00:00','2025-01-01 00:00:00'),(7,'Supergiant Games','supergiant-games-pub','USA','https://www.supergiantgames.com','2025-01-01 00:00:00','2025-01-01 00:00:00'),(8,'Game Science','game-science-pub','China','https://www.heishouyouxi.com','2025-01-01 00:00:00','2025-01-01 00:00:00');
/*!40000 ALTER TABLE `publisher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_rating` int NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_794381C6F675F31B` (`author_id`),
  CONSTRAINT `FK_794381C6F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,1,'Cyberpunk 2077: A City Worth Getting Lost In','cyberpunk-2077-review','Night City is one of the most visually dense urban environments ever constructed in a video game. Every street corner feels like it was designed by someone with a specific story in mind — the neon signs, the food stalls, the residents sitting in doorways. Walking through it without any objective in mind is a genuinely absorbing experience, and that alone justifies a significant portion of the time investment the game asks of you.\n\nThe core RPG loop has been meaningfully strengthened by a skills overhaul that arrived well after the initial release. Builds now feel genuinely distinct from one another, and the game rewards commitment to a chosen approach rather than punishing players for specializing. Whether you prefer to ghost through missions or approach them as a series of escalating firefights, the systems support both playstyles with enough depth to stay interesting.\n\nThe story, centered on a mercenary navigating a terminal diagnosis while hosting an increasingly intrusive digital passenger, is told with a confidence that the game\'s early reception obscured for too long. The final act in particular lands with real emotional weight, and multiple ending paths give the experience genuine replay value. Night City deserved a better launch than it got, but it deserves the attention it receives now.','Night City finally gets the game it deserved. Cyberpunk 2077 has matured into a compelling open-world RPG with strong writing and genuinely distinct build options.','https://cdn.akamai.steamstatic.com/steam/apps/1091500/capsule_616x353.jpg',9,'Published','2025-04-01 10:00:00','2025-04-01 10:00:00'),(2,1,'Elden Ring: Where Difficulty Meets Discovery','elden-ring-review','The most important thing to understand about Elden Ring is that its difficulty is a feature of the exploration, not a barrier to it. Every time the game turns you back from a direction you were heading, it is implicitly pointing you somewhere else. The open world is a tool for managing your own progression in a way that few games have attempted and fewer have executed well.\n\nCombat retains the deliberate, read-and-respond quality that defines this studio\'s output, but the variety of weapons, spells, and summon options creates a wider range of viable approaches than the studio\'s earlier works allowed. Players who struggled with previous entries will find the open-world structure genuinely accommodating without the game ever feeling like it has compromised on its identity.\n\nThe world design is exceptional. Each area has a visual identity and an implicit narrative told through enemy placement, item descriptions, and the ruined or inhabited state of the environments. Spending time piecing together what happened here before your character arrived is one of the game\'s primary pleasures. This is a substantial, carefully constructed work that more than justifies its reputation.','Elden Ring reframes the studio\'s signature challenge within an open world that rewards curiosity and makes player-directed progression genuinely satisfying.','https://cdn.akamai.steamstatic.com/steam/apps/1245620/capsule_616x353.jpg',10,'Published','2025-02-07 10:00:00','2025-02-07 10:00:00'),(3,2,'The Witcher 3: A Decade On and Still Unmatched','the-witcher-3-review','Very few games of the past ten years have aged as well as The Witcher 3. Its open world remains one of the most carefully realized in the medium — not merely large, but populated with content that was clearly written by people who cared about the specific village, the specific characters, the specific problem at hand. The result is a world that feels inhabited rather than generated.\n\nGeralt of Rivia is a reliable anchor for a sprawling narrative that moves between political intrigue, family drama, and monster hunting with unusual ease. The main storyline holds its shape across a runtime that many open-world games use as an excuse to pad. The two expansions extend the experience further, with one of them delivering a self-contained story that stands among the best the medium has produced.\n\nThe technical upgrades introduced in the current-generation version address many of the visual compromises that were apparent in the original release, making this the definitive way to experience a game that needed no improvement in any area that actually mattered. Required playing.','The Witcher 3 holds up remarkably well a decade after release. Its world, characters, and narrative remain benchmarks that most open-world games still fail to reach.','https://cdn.akamai.steamstatic.com/steam/apps/292030/capsule_616x353.jpg',10,'Published','2025-02-12 10:00:00','2025-02-12 10:00:00'),(4,2,'Red Dead Redemption 2: Patience as a Design Principle','red-dead-redemption-2-review','Red Dead Redemption 2 is a game about the pace of a dying era, and it has the courage to make you feel that pace. Travel is slow. Conversations take as long as they need to. The camp you return to between missions changes gradually, and the people in it respond to your presence differently depending on how you have behaved. These are design choices that will frustrate players looking for constant stimulation, and they are exactly right for what the game is trying to accomplish.\n\nArthur Morgan is the most fully realized protagonist Rockstar has produced. His arc across the game\'s six chapters moves from competence to reflection to something approaching grace, and the writing supports every stage of that transition without forcing it. The late-game sections in particular achieve a register that most narrative games never attempt.\n\nThe world itself is a genuine achievement — not just in its visual fidelity, which is extraordinary, but in the density of its incidental content. Strangers you meet once deliver small stories with beginnings and ends. Animals behave according to their own logic. The frontier feels like a place that would exist without you, which is the highest compliment you can pay to an open world.','Red Dead Redemption 2 commits fully to its slow, deliberate rhythm and is better for it. Arthur Morgan\'s story earns every hour it asks of you.','https://cdn.akamai.steamstatic.com/steam/apps/1174180/capsule_616x353.jpg',9,'Published','2025-02-17 10:00:00','2025-02-17 10:00:00'),(5,3,'God of War Ragnarok: A Sequel That Earns Its Scale','god-of-war-ragnarok-review','The challenge facing any sequel to a universally praised game is how to be more without simply being larger. God of War Ragnarok navigates this by deepening rather than widening — the relationship at its center is more complex, the moral questions are harder, and the narrative is willing to sit with ambiguity in a way that action games rarely attempt.\n\nKratos has become one of the medium\'s most interesting characters precisely because the game resists the temptation to resolve his contradictions. He is trying to be different from what he was, and the game acknowledges that trying and succeeding are not the same thing. The scenes between him and Atreus carry the weight of that effort, and the voice performances support it at every turn.\n\nCombat is expanded from the previous entry in ways that feel considered rather than additive for its own sake. New weapon options and enemy designs encourage more varied approaches, and the spectacle of the larger set pieces is handled with a confidence that comes from a studio at the height of its technical ability. A very strong entry in a franchise that has reinvented itself successfully.','God of War Ragnarok deepens its predecessor in ways that matter — stronger character work, harder questions, and combat that rewards the new tools it gives you.','https://cdn.akamai.steamstatic.com/steam/apps/2322010/capsule_616x353.jpg',9,'Published','2025-02-22 10:00:00','2025-02-22 10:00:00'),(6,3,'Baldur\'s Gate 3: The Tabletop Dream Realized','baldurs-gate-3-review','The central promise of Baldur\'s Gate 3 is that the world will respond to what you do with the flexibility and creativity of a skilled dungeon master, and the remarkable thing is that it largely keeps that promise. Solutions present themselves from unexpected directions. Characters remember what you did and respond accordingly. The systems interact in ways that produce outcomes the designers clearly did not specifically script.\n\nThe companion writing is the game\'s most consistent strength. Each character arrives with a history and a perspective that resists easy summary, and the arcs they travel across the game\'s three acts feel earned rather than prescribed. The co-operative mode amplifies everything — four players making divergent choices produces a kind of emergent narrative chaos that the game absorbs with surprising grace.\n\nAct three, set in the city the game is named after, is ambitious to the point of occasional incoherence, but the ambition itself is worth acknowledging. Few games attempt content at this scale while maintaining this level of quality in the writing. The result is imperfect and essential in equal measure.','Baldur\'s Gate 3 keeps its central promise: the world responds to what you do with genuine flexibility. The companion writing and co-op experience are exceptional throughout.','https://cdn.akamai.steamstatic.com/steam/apps/1086940/capsule_616x353.jpg',10,'Published','2025-02-27 10:00:00','2025-02-27 10:00:00'),(7,4,'Hollow Knight: Small Studio, Enormous World','hollow-knight-review','Hallownest is a kingdom with the texture of a place that once mattered. Its architecture suggests a civilization with its own rituals and hierarchies; the enemies that now inhabit it carry the remnants of roles they no longer serve. Wandering through it is an act of archaeology as much as combat, and the game is designed to reward the player who pays attention to what the environment is saying.\n\nThe Metroidvania structure is executed with unusual discipline. New abilities open old paths in ways that feel logical rather than arbitrary, and the map — which you assemble manually using purchased pins — gives the navigation a tactile quality that most games in the genre skip past. Getting lost and finding your way out is part of the design, not a failure state.\n\nCombat asks you to be precise and aggressive within a limited range. This is a deliberate constraint — the nail is short, enemies are numerous, and many encounters require you to stay close to things that are trying to hurt you. Boss fights build on this tension into encounters that are demanding and fair in equal measure. This is a game made with real conviction by people who cared deeply about every corner of it.','Hollow Knight builds a world worth getting lost in, and fills it with combat that rewards the precision it demands. A genuine achievement from a tiny team.','https://cdn.akamai.steamstatic.com/steam/apps/367520/capsule_616x353.jpg',9,'Published','2025-03-03 10:00:00','2025-03-03 10:00:00'),(8,4,'Hades: Death as Narrative Progression','hades-review','The structural insight at the heart of Hades is that failure should advance the story rather than interrupt it. Every death returns the player to the starting point, but the world changes in response to each attempt — new dialogue appears, relationships develop, and information accumulates. The rogue-like loop and the narrative are not running in parallel; they are driving each other.\n\nThe combat is fast and readable, built around a boon system that creates meaningfully different configurations on each run. The God-granted abilities interact in ways that encourage experimentation, and the distinction between a strong build and a weak one is clear enough that improving your decision-making produces a tangible effect on outcomes. The core loop does not overstay its welcome because each run feels like a different version of the same challenge.\n\nThe writing deserves specific recognition. The script is expansive and consistently sharp, maintaining distinct voices for a large cast of mythological characters. The main narrative thread — a son trying to leave home, a family trying to prevent it — lands with real emotional resonance once the full picture emerges. A landmark achievement in genre design.','Hades integrates narrative and rogue-like structure more effectively than anything before it. The combat, writing, and loop design work together to create something exceptional.','https://cdn.akamai.steamstatic.com/steam/apps/1145360/capsule_616x353.jpg',10,'Published','2025-03-08 10:00:00','2025-03-08 10:00:00'),(9,5,'Black Myth: Wukong — A Confident Debut','black-myth-wukong-review','Black Myth: Wukong announces itself immediately as a game of serious technical ambition. The opening sequences establish a visual quality that places the game in direct comparison with the best-looking titles currently available, and the environmental art design draws on source material that Western and Japanese games have rarely touched. The world has a distinct look that does not feel derivative.\n\nThe combat system centers on a stance-shifting staff moveset supplemented by transformation abilities that allow the player character to assume the form of defeated enemies. The system has depth without requiring mastery to enjoy, and the boss encounters — which are numerous and inventive — are designed to showcase the full range of what the mechanics can do.\n\nNarrative pacing is uneven, and some mid-game sections suffer from a lack of environmental variety that the stronger areas make more apparent by contrast. These are minor reservations about a game that delivers on its core promise impressively. As a first project from a studio with no previous output at this scale, it represents a significant achievement and a strong foundation for future work.','Black Myth: Wukong is a technically impressive debut with inventive boss design and a distinctive visual identity rooted in Chinese mythology.','https://cdn.akamai.steamstatic.com/steam/apps/2358720/capsule_616x353.jpg',8,'Published','2025-03-13 10:00:00','2025-03-13 10:00:00'),(10,5,'Sekiro: The Case for Precision','sekiro-review','Sekiro argues, with its entire design, that precision is a more satisfying basis for a combat system than flexibility. Where other action RPGs offer builds and equipment as a buffer between player input and outcomes, Sekiro removes that buffer almost entirely. You succeed when your timing is correct. You fail when it is not. This is either a compelling proposition or an alienating one, depending entirely on what you want from the genre.\n\nFor players willing to meet the game on its own terms, the posture system is exceptional. Every fight is a structured conversation in which attacking and defending are not cleanly separated — an aggressive offense fills the opponent\'s posture bar and creates the vulnerability that ends the encounter. Learning to read enemy patterns and apply pressure continuously is a genuinely teachable skill, and the moment it clicks in a previously impossible fight is among the most satisfying experiences the medium offers.\n\nThe setting deserves acknowledgment independent of the mechanical discussion. Late Sengoku Japan, rendered with an attention to architectural and environmental detail that most historical settings lack, gives the game a visual coherence that enhances the atmosphere of its encounters. The final bosses are designed to test everything the game has taught you, and they are worthy of the build-up. Difficult, precise, and worth every attempt.','Sekiro builds its entire design around a single commitment to precision, and the result is one of the most satisfying combat systems in any action game.','https://cdn.akamai.steamstatic.com/steam/apps/814380/capsule_616x353.jpg',9,'Published','2025-03-18 10:00:00','2025-03-18 10:00:00');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review_tag`
--

DROP TABLE IF EXISTS `review_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review_tag` (
  `review_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`review_id`,`tag_id`),
  KEY `IDX_FBEBB4A3E2E969B` (`review_id`),
  KEY `IDX_FBEBB4ABAD26311` (`tag_id`),
  CONSTRAINT `FK_FBEBB4A3E2E969B` FOREIGN KEY (`review_id`) REFERENCES `review` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FBEBB4ABAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review_tag`
--

LOCK TABLES `review_tag` WRITE;
/*!40000 ALTER TABLE `review_tag` DISABLE KEYS */;
INSERT INTO `review_tag` VALUES (1,1),(1,7),(1,9),(2,2),(2,5),(2,6),(3,1),(3,3),(3,9),(4,1),(4,3),(4,10),(5,3),(5,5),(5,6),(6,3),(6,4),(6,9),(7,5),(7,6),(7,8),(8,3),(8,5),(8,8),(9,2),(9,5),(9,9),(10,2),(10,5),(10,6);
/*!40000 ALTER TABLE `review_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'Open World','open-world','2025-01-01 00:00:00','2025-01-01 00:00:00'),(2,'Souls-like','souls-like','2025-01-01 00:00:00','2025-01-01 00:00:00'),(3,'Story Rich','story-rich','2025-01-01 00:00:00','2025-01-01 00:00:00'),(4,'Multiplayer','multiplayer','2025-01-01 00:00:00','2025-01-01 00:00:00'),(5,'Single Player','single-player','2025-01-01 00:00:00','2025-01-01 00:00:00'),(6,'Dark Fantasy','dark-fantasy','2025-01-01 00:00:00','2025-01-01 00:00:00'),(7,'Cyberpunk','cyberpunk','2025-01-01 00:00:00','2025-01-01 00:00:00'),(8,'Indie','indie','2025-01-01 00:00:00','2025-01-01 00:00:00'),(9,'Action RPG','action-rpg','2025-01-01 00:00:00','2025-01-01 00:00:00'),(10,'Noir','noir','2025-01-01 00:00:00','2025-01-01 00:00:00');
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitch_account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  UNIQUE KEY `UNIQ_USER_NICKNAME` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'brie@gmail.com','$2y$13$DGBEw2JCqHq1SKlRYfYpiudYz2heUR/0tV5W/yiaicNA2VXzB3/oC','[\"ROLE_ADMIN\", \"ROLE_USER\"]','Brie','http://wiegand.com/','avatar.jpg','2025-04-01 13:11:14','2025-04-01 13:11:14'),(2,'kai@gmail.com','$2y$13$YUn182Pv1p0gwpgxGDiNYef1qErJDhkpi..1H5Y4xCAwQ/NBdFk1e','[\"ROLE_USER\"]','Kai','http://mosciski.com/','avatar.jpg','2025-04-01 13:11:14','2025-04-01 13:11:14'),(3,'sapphire@gmail.com','$2y$13$fogtV.SubPKhub2Cv.CdXeISQ13tsM4hhfdOlDcgro1j0bvHCxdZu','[\"ROLE_USER\"]','Sapphire','http://www.schowalter.net/','avatar.jpg','2025-04-01 13:11:14','2025-04-01 13:11:14'),(4,'muse@gmail.com','$2y$13$cM/PCvwkdLBXaiCgoQ2vIeNPGsnBgvSHZbFuk3pIU1hBGo60CMoWq','[\"ROLE_USER\"]','Muse','http://www.haley.com/rem-totam-doloremque-laudantium-voluptas-ut-sint-est','avatar.jpg','2025-04-01 13:11:15','2025-04-01 13:11:15'),(5,'oneeyed@gmail.com','$2y$13$JD6zTQIojvW245jQH8SAd.ay8ulKlMpr5d1bv4hHpPnRAOK6CEPAG','[\"ROLE_USER\"]','OneEyed','https://fay.com/soluta-minima-eum-dolor-sunt.html','avatar.jpg','2025-04-01 13:11:15','2025-04-01 13:11:15');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `is_revoked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BDF55A63A76ED395` (`user_id`),
  CONSTRAINT `FK_BDF55A63A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_token`
--

LOCK TABLES `user_token` WRITE;
/*!40000 ALTER TABLE `user_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-19 16:20:15
