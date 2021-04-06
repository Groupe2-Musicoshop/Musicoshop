DROP DATABASE IF EXISTS musicoshop;

CREATE DATABASE musicoshop;

USE musicoshop;

CREATE TABLE categorie(
   idCategorie INT AUTO_INCREMENT,
   libele VARCHAR(50),
   PRIMARY KEY(idCategorie)
);

CREATE TABLE utilisateur(
   idUtilisateur INT AUTO_INCREMENT,
   userName VARCHAR(100),
   email VARCHAR(100),
   type VARCHAR(100),
   password VARCHAR(100),
   sexe VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   tel VARCHAR(50),
   adresse VARCHAR(50),
   ville VARCHAR(50),
   codePostal INT,   
   PRIMARY KEY(idUtilisateur)   
);

CREATE TABLE commande(
   idCmd INT NOT NULL AUTO_INCREMENT,
   dateCmd VARCHAR(50),
   total DECIMAL(15,2),
   description VARCHAR(50),
   PRIMARY KEY(idCmd),
   idUtilisateur INT NOT NULL,
   FOREIGN KEY(idUtilisateur) REFERENCES utilisateur(idUtilisateur)
);

CREATE TABLE panier(
   Id_Panier INT,
   idUtilisateur INT,
   idArticle INT,
   PRIMARY KEY(Id_Panier, idUtilisateur, idArticle)
);

CREATE TABLE instruments(
   Id_Instruments INT AUTO_INCREMENT,
   designation VARCHAR(50),
   prix VARCHAR(50),
   img VARCHAR(50),
   description VARCHAR(50),
   idCategorie INT NOT NULL,
   PRIMARY KEY(Id_Instruments),
   FOREIGN KEY(idCategorie) REFERENCES categorie(idCategorie)
);

CREATE TABLE article(
   Id_Article INT AUTO_INCREMENT,
   designation VARCHAR(50),
   qtestock INT,
   prix DECIMAL(15,2),
   tauremise DECIMAL(15,2),
   img VARCHAR(50),
   description VARCHAR(50),
   Id_Instruments INT NOT NULL,
   PRIMARY KEY(Id_Article),
   FOREIGN KEY(Id_Instruments) REFERENCES instruments(Id_Instruments)
);

CREATE TABLE ligne_Commande(
   Id_Article INT AUTO_INCREMENT,
   idCmd INT NOT NULL,
   PRIMARY KEY(Id_Article, idCmd),
   FOREIGN KEY(Id_Article) REFERENCES article(Id_Article),
   FOREIGN KEY(idCmd) REFERENCES commande(idCmd)
);

INSERT INTO `utilisateur` (`idUtilisateur`, `username`, `email`, `type`, `password`) VALUES
(1, 'toto', 'constmatsima@gmail.com', 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
(2, 'Afpatoto', 'constmatsima@gmail.com', 'user', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');