-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2021 at 05:21 PM
-- Server version: 5.7.32
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `FBI_APP_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
                         `id` int(11) NOT NULL,
                         `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `roles` json NOT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `roles`, `password`, `last_name`, `first_name`, `created_at`) VALUES
(1, 'admin@fbi.com', '{\"0\": \"ROLE_ADMIN\"}', '$argon2id$v=19$m=65536,t=4,p=1$T1h9vNcO9x118kKO1+Glmw$gFud7wf3jBbj0GHpY8GB0LumjDwhOoVpVsiU9KKfXsg', 'Admini', 'Strateur', '2021-03-23 16:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
                          `id` int(11) NOT NULL,
                          `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `last_name`, `first_name`, `code_name`, `nationality`) VALUES
(1, 'Durden', 'Tyler', 'FigterBoy', 'American'),
(2, 'Vincent', 'Alberte', 'The Made in France', 'French'),
(3, 'Yang', 'Kyoungjong', 'The Bad Luck', 'Chinese'),
(4, 'Hiro', 'Onoda', 'The Last Samuraï', 'Japanese');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
                            `id` int(11) NOT NULL,
                            `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `last_name`, `first_name`, `birth_date`, `code_name`, `nationality`) VALUES
(1, 'Ladombes', 'Lucien', '23/09/1979', 'La Chouette', 'France'),
(2, 'Alkha', 'Khabar', 'unknown', 'Sultan', 'Saudi Arabia'),
(3, 'Almada', 'Thiago', '20/09/1990', 'Narco', 'Colombia'),
(4, 'Vovocic', 'Yvann', 'unknown', 'Vodka', 'Slovaquia');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_missions`
--

CREATE TABLE `contacts_missions` (
                                     `contacts_id` int(11) NOT NULL,
                                     `missions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts_missions`
--

INSERT INTO `contacts_missions` (`contacts_id`, `missions_id`) VALUES
(1, 8),
(2, 7),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
                                               `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
                                               `executed_at` datetime DEFAULT NULL,
                                               `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210319095849', '2021-03-19 09:59:08', 919),
('DoctrineMigrations\\Version20210322095323', '2021-03-22 09:53:37', 168),
('DoctrineMigrations\\Version20210322095538', '2021-03-22 09:55:43', 118);

-- --------------------------------------------------------

--
-- Table structure for table `hideouts`
--

CREATE TABLE `hideouts` (
                            `id` int(11) NOT NULL,
                            `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hideouts`
--

INSERT INTO `hideouts` (`id`, `address`, `type`, `country`) VALUES
(1, 'Alben Lake', 'Maison discrète', 'Afghanistan'),
(2, '12, Liberty Street', 'Flat room, 4th floor', 'France'),
(3, 'Fri\'s Temple', 'Old farm', 'Saudi Arabia'),
(4, 'Corona Motel', 'Motel', 'Colombia');

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
                            `id` int(11) NOT NULL,
                            `skills_id` int(11) NOT NULL,
                            `hideouts_id` int(11) DEFAULT NULL,
                            `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`id`, `skills_id`, `hideouts_id`, `title`, `description`, `country`, `type`, `status`, `start_date`, `end_date`) VALUES
(3, 2, 4, 'Friday Night', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Colombia', 'Information', 'In preparation', '12/05/2022', '29/03/2023'),
(4, 7, NULL, 'Bratislava\'s Fiesta', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'Slovaquia', 'Assassination', 'In progress', '14/04/2021', '15/04/2021'),
(7, 1, 3, 'Black Ops', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Saudi Arabia', 'Spying', 'Stand by', '12/03/2019', '01/01/2022'),
(8, 1, NULL, 'Desert Storm', 'Neque vitae tempus quam pellentesque nec. Mi eget mauris pharetra et ultrices neque ornare. Nunc vel risus commodo viverra maecenas accumsan lacus vel facilisis. Eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim. Purus in massa tempor nec feug', 'France', 'Spying', 'Done', '01/01/2019', '01/01/2021');

-- --------------------------------------------------------

--
-- Table structure for table `missions_agents`
--

CREATE TABLE `missions_agents` (
                                   `missions_id` int(11) NOT NULL,
                                   `agents_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missions_agents`
--

INSERT INTO `missions_agents` (`missions_id`, `agents_id`) VALUES
(3, 2),
(3, 3),
(4, 4),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `missions_targets`
--

CREATE TABLE `missions_targets` (
                                    `missions_id` int(11) NOT NULL,
                                    `targets_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `missions_targets`
--

INSERT INTO `missions_targets` (`missions_id`, `targets_id`) VALUES
(3, 2),
(4, 1),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
                          `id` int(11) NOT NULL,
                          `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `description`) VALUES
(1, 'Spy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. '),
(2, 'Infiltration', 'In dapibus risus ut odio mattis, ut molestie mi lobortis. Nunc pretium at velit sit amet dictum. Duis lectus mi, condimentum vitae libero nec.'),
(3, 'Hitman', 'Mauris vel sem sem. Nullam gravida tempus nibh, scelerisque venenatis ipsum viverra sit amet. Vestibulum ac posuere magna. Nam sagittis libero fermentum ultrices luctus. Aenean blandit iaculis purus ac aliquam. Ut in neque dapibus, aliquet massa quis, ullamcorper justo.'),
(6, 'Hacker', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(7, 'Assassination', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Table structure for table `skills_agents`
--

CREATE TABLE `skills_agents` (
                                 `skills_id` int(11) NOT NULL,
                                 `agents_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills_agents`
--

INSERT INTO `skills_agents` (`skills_id`, `agents_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(3, 2),
(3, 3),
(6, 2),
(6, 3),
(6, 4),
(7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `targets`
--

CREATE TABLE `targets` (
                           `id` int(11) NOT NULL,
                           `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `targets`
--

INSERT INTO `targets` (`id`, `last_name`, `first_name`, `birth_date`, `code_name`, `nationality`) VALUES
(1, 'Krakovič', 'Nikolaï', '08/01/1985', 'East Beast', 'Russian'),
(2, 'Smithson', 'Andy Jr.', '30/06/1995', 'Hood Boyz', 'American');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `UNIQ_880E0D76E7927C74` (`email`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts_missions`
--
ALTER TABLE `contacts_missions`
    ADD PRIMARY KEY (`contacts_id`,`missions_id`),
    ADD KEY `IDX_21A1513B719FB48E` (`contacts_id`),
    ADD KEY `IDX_21A1513B17C042CF` (`missions_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
    ADD PRIMARY KEY (`version`);

--
-- Indexes for table `hideouts`
--
ALTER TABLE `hideouts`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
    ADD PRIMARY KEY (`id`),
    ADD KEY `IDX_34F1D47E7FF61858` (`skills_id`),
    ADD KEY `IDX_34F1D47EFF2F627D` (`hideouts_id`);

--
-- Indexes for table `missions_agents`
--
ALTER TABLE `missions_agents`
    ADD PRIMARY KEY (`missions_id`,`agents_id`),
    ADD KEY `IDX_5340AFB917C042CF` (`missions_id`),
    ADD KEY `IDX_5340AFB9709770DC` (`agents_id`);

--
-- Indexes for table `missions_targets`
--
ALTER TABLE `missions_targets`
    ADD PRIMARY KEY (`missions_id`,`targets_id`),
    ADD KEY `IDX_B7328F6017C042CF` (`missions_id`),
    ADD KEY `IDX_B7328F6043B5F743` (`targets_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills_agents`
--
ALTER TABLE `skills_agents`
    ADD PRIMARY KEY (`skills_id`,`agents_id`),
    ADD KEY `IDX_D889A5DD7FF61858` (`skills_id`),
    ADD KEY `IDX_D889A5DD709770DC` (`agents_id`);

--
-- Indexes for table `targets`
--
ALTER TABLE `targets`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hideouts`
--
ALTER TABLE `hideouts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `targets`
--
ALTER TABLE `targets`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts_missions`
--
ALTER TABLE `contacts_missions`
    ADD CONSTRAINT `FK_21A1513B17C042CF` FOREIGN KEY (`missions_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_21A1513B719FB48E` FOREIGN KEY (`contacts_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `missions`
--
ALTER TABLE `missions`
    ADD CONSTRAINT `FK_34F1D47E7FF61858` FOREIGN KEY (`skills_id`) REFERENCES `skills` (`id`),
    ADD CONSTRAINT `FK_34F1D47EFF2F627D` FOREIGN KEY (`hideouts_id`) REFERENCES `hideouts` (`id`);

--
-- Constraints for table `missions_agents`
--
ALTER TABLE `missions_agents`
    ADD CONSTRAINT `FK_5340AFB917C042CF` FOREIGN KEY (`missions_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_5340AFB9709770DC` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `missions_targets`
--
ALTER TABLE `missions_targets`
    ADD CONSTRAINT `FK_B7328F6017C042CF` FOREIGN KEY (`missions_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_B7328F6043B5F743` FOREIGN KEY (`targets_id`) REFERENCES `targets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skills_agents`
--
ALTER TABLE `skills_agents`
    ADD CONSTRAINT `FK_D889A5DD709770DC` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `FK_D889A5DD7FF61858` FOREIGN KEY (`skills_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE;
