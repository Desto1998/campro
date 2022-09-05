drop table if exists employe;
create table employe(
                        id_emp int primary key auto_increment,
                        nom_emp varchar(500) not null,
                        prenom_emp varchar(500) null,
                        nomu_emp varchar(255) not null,
                        tel_emp varchar(25) not null,
                        email_emp varchar(255) null,
                        sexe_emp varchar(25),
                        ca_emp varchar(255) null,
                        ent_emp varchar(255) null,
                        lieus_emp varchar(500) not null,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists formation;
create table formation(
                          id_formation int primary key auto_increment,
                          titre_for varchar(50) not null,
                          des_for varchar(100) null,
                          type_for varchar(100) null,
                          type_cout varchar(100) null,
                          cout_for int not null,
                          ex_for varchar(25) not null,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists fournisseur;
create table fournisseur(
                            id_four int primary key auto_increment,
                            nom_four varchar(500) not null,
                            type_four varchar(50) null,
                            nomu_four varchar(255) not null,
                            tel_four varchar(25) not null,
                            email_four varchar(255) null,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists domaine;
create table domaine(
                        id_do int primary key auto_increment,
                        titre_do varchar(50) null,
                        des_do varchar(255) not null,

                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists sous_domaine;
create table sous_domaine(
                             id_sousdo int primary key auto_increment,
                             titre_sousdo varchar(50) null,
                             des_sousdo varchar(255) not null,
                             id_do int not null,
                             foreign key (id_do) references domaine(id_do),
                             created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                             updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists formateur;
create table formateur(
                          id_for int primary key auto_increment,
                          nom_for varchar(50) null,
                          prenom_for varchar(50) not null,
                          tel_for int not null,
                          id_four int not null,
                          id_formation int not null,
                          foreign key (id_four) references fournisseur(id_four),
                          foreign key (id_formation) references formation(id_formation),
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists do_re;
create table do_re(
                      id_dore int primary key auto_increment,
                      session_do varchar(50) null,
                      id_re int not null,
                      id_sousdo int not null,
                      foreign key (id_re) references requete(id_re),
                      foreign key (id_sousdo) references sous_domaine(id_sousdo),
                      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                      updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists sessions;
create table sessions(
                        id_session int primary key auto_increment,
                        reference varchar(50) null unique ,
                        titre varchar(50) null unique ,
                        description varchar(5000) null ,
                        date_debut varchar(255) not null,
                        date_fin varchar(255) not null,
                        statut int default 0,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists requete;
create table requete(
                        id_re int primary key auto_increment,
                        date_re date  not null,
                        object_re varchar(50) null,
                        dure_re int not null,
                        id_emp int not null,
                        statut int default 0,
--                         foreign key (id_emp) references users(id),
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists date_formation;
create table date_formation(
                        id_date int primary key auto_increment,
                        date_debut date null,
                        date_fin date  null,
                        id_for int not null,
                        id_re int not null,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage de la structure de la table campro. domaine
-- CREATE TABLE IF NOT EXISTS `domaine` (
--     `id_do` int(11) NOT NULL AUTO_INCREMENT,
--     `titre_do` varchar(50) DEFAULT NULL,
--     `des_do` varchar(255) NOT NULL,
--     `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
--     `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--     PRIMARY KEY (`id_do`)
--     ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Listage des données de la table campro.domaine : ~0 rows (environ)
/*!40000 ALTER TABLE `domaine` DISABLE KEYS */;
REPLACE INTO `domaine` (`id_do`, `titre_do`, `des_do`, `created_at`, `updated_at`) VALUES
	(1, '01 - Culture et connaissance du groupe', '', '2022-08-21 15:14:11', '2022-08-21 15:14:11'),
	(2, '02 - Formations métiers opérationnels', '', '2022-08-21 15:14:37', '2022-08-21 15:14:37'),
	(3, '03 - Sécurité', '', '2022-08-21 15:14:42', '2022-08-21 15:14:42'),
	(4, '04 - Formations fonctions support', '', '2022-08-21 15:14:57', '2022-08-21 15:14:57'),
	(5, '05 - Compétences individuelles', '', '2022-08-21 15:15:20', '2022-08-21 15:15:20'),
	(6, '06 - Management', '', '2022-08-21 15:15:31', '2022-08-21 15:15:31'),
	(7, '07 - Digital', '', '2022-08-21 15:15:35', '2022-08-21 15:15:35');
/*!40000 ALTER TABLE `domaine` ENABLE KEYS */;

-- Listage de la structure de la table campro. sous_domaine
-- CREATE TABLE IF NOT EXISTS `sous_domaine` (
--     `id_sousdo` int(11) NOT NULL AUTO_INCREMENT,
--     `titre_sousdo` varchar(50) DEFAULT NULL,
--     `des_sousdo` varchar(255) NOT NULL,
--     `id_do` int(11) NOT NULL,
--     `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
--     `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--     PRIMARY KEY (`id_sousdo`),
--     KEY `id_do` (`id_do`),
--     CONSTRAINT `sous_domaine_ibfk_1` FOREIGN KEY (`id_do`) REFERENCES `domaine` (`id_do`)
--     ) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- Listage des données de la table campro.sous_domaine : ~0 rows (environ)
/*!40000 ALTER TABLE `sous_domaine` DISABLE KEYS */;
REPLACE INTO `sous_domaine` (`id_sousdo`, `titre_sousdo`, `des_sousdo`, `id_do`, `created_at`, `updated_at`) VALUES
	(2, 'Connaissance du groupe et intégration', '', 1, '2022-08-21 15:16:21', '2022-08-21 15:16:21'),
	(3, 'Orientations générales stratégie', '', 1, '2022-08-21 15:16:38', '2022-08-21 15:16:38'),
	(5, ' Éthique et code de conduite', '', 1, '2022-08-21 15:17:07', '2022-08-21 15:17:07'),
	(6, 'Traction', '', 2, '2022-08-21 15:17:18', '2022-08-21 15:17:18'),
	(7, 'Trafic', '', 2, '2022-08-21 15:18:05', '2022-08-21 15:18:05'),
	(9, 'Matériel', '', 2, '2022-08-21 15:18:23', '2022-08-21 15:18:23'),
	(10, 'Infrastructure', '', 2, '2022-08-21 15:18:38', '2022-08-21 15:18:38'),
	(11, '   Voyageurs', '', 2, '2022-08-21 15:18:46', '2022-08-21 15:18:46'),
	(12, ' Sécurité ferroviaire', '', 3, '2022-08-21 15:19:25', '2022-08-21 15:19:25'),
	(13, 'Sécurité au travail', '', 3, '2022-08-21 15:19:34', '2022-08-21 15:19:34'),
	(15, 'Contrôle de gestion, finance et comptabilité', '', 4, '2022-08-21 15:19:55', '2022-08-21 15:19:55'),
	(17, 'Commercial & Communication', '', 4, '2022-08-21 15:20:20', '2022-08-21 15:20:20'),
	(18, 'Responsabilité Sociale et Environnementale', '', 4, '2022-08-21 15:20:53', '2022-08-21 15:20:53'),
	(19, 'Systèmes d\'information et informatique', '', 4, '2022-08-21 15:21:12', '2022-08-21 15:21:12'),
	(20, ' Juridique et fiscal', '', 4, '2022-08-21 15:21:33', '2022-08-21 15:21:33'),
	(21, ' Achats & logistique', '', 4, '2022-08-21 15:21:51', '2022-08-21 15:21:51'),
	(23, 'Qualité', '', 4, '2022-08-21 15:22:08', '2022-08-21 15:22:08'),
	(24, 'Ressources humaines', '', 4, '2022-08-21 15:22:22', '2022-08-21 15:22:22'),
	(25, 'Social', '', 4, '2022-08-21 15:22:38', '2022-08-21 15:22:38'),
	(26, 'Bureautique', '', 5, '2022-08-21 15:22:58', '2022-08-21 15:22:58'),
	(27, 'Langues', '', 5, '2022-08-21 15:23:22', '2022-08-21 15:23:22'),
	(28, 'Développement personnel', '', 5, '2022-08-21 15:23:37', '2022-08-21 15:23:37'),
	(29, ' Gestion de projet et organisation', '', 5, '2022-08-21 15:23:47', '2022-08-21 15:23:47'),
	(30, 'Leadership', '', 6, '2022-08-21 15:24:16', '2022-08-21 15:24:16'),
	(31, 'Management de la performance', '', 6, '2022-08-21 15:24:43', '2022-08-21 15:24:43'),
	(32, 'Les fondamentaux du management', '', 6, '2022-08-21 15:24:58', '2022-08-21 15:24:58'),
	(33, 'Autres thématiques de management', '', 6, '2022-08-21 15:25:07', '2022-08-21 15:25:07'),
	(35, 'Acculturation numérique', '', 7, '2022-08-21 15:25:49', '2022-08-21 15:25:49'),
	(38, 'Social Media', '', 7, '2022-08-21 15:26:02', '2022-08-21 15:26:02'),
	(39, 'Nouvelles méthodes de travail', '', 7, '2022-08-21 15:26:23', '2022-08-21 15:26:23');
