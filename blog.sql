CREATE DATABASE blog;
USE blog;
CREATE TABLE utilisateur(
	id_util int primary key auto_increment not null,
    nom_util varchar(50) not null,
    prenom_util varchar(50) not null,
    mail_util varchar(50) not null,
    password_util varchar(100) not null,
    img_util varchar(100) null,
	validate_util tinyint(1),
    id_role int null
)Engine=InnoDB;
CREATE TABLE article(
	id_art int primary key auto_increment not null,
    nom_art varchar(50) not null,
    contenu_art text not null,
	date_art date not null,
	img_art varchar(100) null,
    validate_art tinyint(1),
    id_cat int null,
    id_util int null
)Engine=InnoDB;
CREATE TABLE categorie(
	id_cat int primary key auto_increment  not null,
	nom_cat varchar(50)
)Engine=InnoDB;
CREATE TABLE role(
	id_role int primary key auto_increment null,
	nom_role varchar(50)
)Engine=InnoDB;
CREATE TABLE ajouter(
	id_util int null,
	id_art int null,
    com varchar(255) null,
    date_com date null,
    validate_com tinyint(1) null,
    primary key(id_util, id_art, date_com)
)Engine=InnoDB;
ALTER TABLE utilisateur
add constraint fk_posseder_role
foreign key(id_role)
references role(id_role);
ALTER TABLE article
add constraint fk_ecrire_utilisateur
foreign key(id_util)
references utilisateur(id_util);
ALTER TABLE article
add constraint fk_completer_categorie
foreign key(id_cat)
references categorie(id_cat);
ALTER TABLE ajouter
add constraint fk_ajouter_utilisateur
foreign key(id_util)
references utilisateur(id_util);
ALTER TABLE ajouter
add constraint fk_ajouter_article
foreign key(id_art)
references article(id_art);