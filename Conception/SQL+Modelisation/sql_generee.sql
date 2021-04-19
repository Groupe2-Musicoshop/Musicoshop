DROP DATABASE IF EXISTS musicoshop;

CREATE DATABASE musicoshop;

USE musicoshop;

CREATE TABLE categorie(
   idCategorie INT AUTO_INCREMENT,
   libele VARCHAR(50),
   page VARCHAR(50),
   PRIMARY KEY(idCategorie)
);

CREATE TABLE utilisateur(
   idUtilisateur INT AUTO_INCREMENT,
   userName VARCHAR(100),
   email VARCHAR(100),
   type VARCHAR(100),
   password VARCHAR(100),
   valideuser Boolean,
   changepwd Boolean,
   sexe VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   tel VARCHAR(50),
   adresse VARCHAR(50),
   ville VARCHAR(50),
   codePostal INT,   
   PRIMARY KEY(idUtilisateur)   
);

CREATE TABLE instruments(
   Id_Instrument INT AUTO_INCREMENT,
   designation VARCHAR(50),   
   img text,   
   idCategorie INT NOT NULL,
   PRIMARY KEY(Id_Instrument),
   FOREIGN KEY(idCategorie) REFERENCES categorie(idCategorie) 
);

CREATE TABLE article(
   Id_Article INT AUTO_INCREMENT,   
   qtestock INT,
   prix DECIMAL(15,2),
   note DECIMAL(15,2),
   Id_Instrument INT NOT NULL,
   PRIMARY KEY(Id_Article),
   FOREIGN KEY(Id_Instrument) REFERENCES instruments(Id_Instrument) ON DELETE CASCADE
);

/*drop table panier; */
CREATE TABLE panier(
   Id_Panier INT AUTO_INCREMENT,
   sessId VARCHAR(50),
   qtite_Art INT,
   Id_Article INT,
   prixT DECIMAL(15,2),
   PRIMARY KEY(Id_Panier)
);

CREATE TABLE commande(
   idCmd INT NOT NULL AUTO_INCREMENT,
   numCmd VARCHAR(50),
   idUtilisateur INT NOT NULL,
   dateCmd VARCHAR(50),
   description TEXT(250),
   total DECIMAL(15,2),
   PRIMARY KEY(idCmd),
   FOREIGN KEY(idUtilisateur) REFERENCES utilisateur(idUtilisateur)
);

CREATE TABLE ligne_Commande(
   idLigneCmd INT AUTO_INCREMENT,
   idCmd INT NOT NULL,
   Id_Article INT NOT NULL,
   qtite INT NOT NULL,
   PRIMARY KEY(idLigneCmd),
   FOREIGN KEY(Id_Article) REFERENCES article(Id_Article),
   FOREIGN KEY(idCmd) REFERENCES commande(idCmd)
);

INSERT INTO `utilisateur` (`idUtilisateur`, `username`, `email`, `type`,`valideuser`,`changepwd`, `password`,`sexe`,`nom`,`prenom`) VALUES
(1, 'Pierre', 'pierre.lange@free.fr', 'admin','1','0', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92','','','');
