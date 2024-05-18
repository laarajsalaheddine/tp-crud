# Guide de Configuration de la Base de Données

Ce guide fournit des instructions étape par étape pour configurer la base de données

## Étapes pour Configurer la Base de Données

Suivez ces étapes pour créer la base de données et configurer les tables et contraintes nécessaires.

### 1. Créer la Base de Données

Exécutez la requête SQL suivante pour créer la base de données :

```sql
CREATE DATABASE `authentification`;
```

### 2. Créer la table role

```sql
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `droit` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

### 3. Insérer une ligne dans la table des rôles

```sql
INSERT INTO `role` (`id`, `libelle`, `droit`) VALUES
(1, 'admin', 'a:4:{s:4:\"user\";a:4:{s:6:\"create\";i:1;s:4:\"read\";i:1;s:6:\"update\";i:1;s:6:\"delete\";i:1;}s:4:\"role\";a:4:{s:6:\"create\";i:1;s:4:\"read\";i:1;s:6:\"update\";i:1;s:6:\"delete\";i:1;}s:7:\"product\";a:4:{s:6:\"create\";i:1;s:4:\"read\";i:1;s:6:\"update\";i:1;s:6:\"delete\";i:1;}s:9:\"categorie\";a:4:{s:6:\"create\";i:1;s:4:\"read\";i:1;s:6:\"update\";i:1;s:6:\"delete\";i:1;}}');
```


### 4. Créer la table users

```sql

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` longtext NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
```

### 5. Insérer une ligne dans la table des users

```sql
INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `photo`, `role_id`) VALUES
(12, 'admin', 'admin', 'admin@gmail.com', '$2b$12$RZ1ftoLCV3kcoEQdFtwaau.t2J3K0a/fDGZxPcfL1unTfYdhPODB6', '', 1);
```


### 5. Ajouter les contraints

```sql
--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;
```