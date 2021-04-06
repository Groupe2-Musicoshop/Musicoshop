DROP DATABASE IF EXISTS musicoshop;

CREATE DATABASE musicoshop;

USE musicoshop;

CREATE TABLE Categorie(
   idCategorie INT,
   libele VARCHAR(50),
   PRIMARY KEY(idCategorie)
);

CREATE TABLE Commande(
   idCmd INT,
   dateCmd VARCHAR(50),
   total DECIMAL(15,2),
   description VARCHAR(50),
   PRIMARY KEY(idCmd)
);

CREATE TABLE Panier(
   Id_Panier INT,
   idUtilisateur INT,
   idArticle INT,
   PRIMARY KEY(Id_Panier, idUtilisateur, idArticle)
);

CREATE TABLE Instruments(
   Id_Instruments INT,
   designation VARCHAR(50),
   prix VARCHAR(50),
   img VARCHAR(50),
   description VARCHAR(50),
   idCategorie INT NOT NULL,
   PRIMARY KEY(Id_Instruments),
   FOREIGN KEY(idCategorie) REFERENCES Categorie(idCategorie)
);

CREATE TABLE Article(
   Id_Article INT,
   designation VARCHAR(50),
   qtestock INT,
   prix DECIMAL(15,2),
   tauremise DECIMAL(15,2),
   img VARCHAR(50),
   description VARCHAR(50),
   Id_Instruments INT NOT NULL,
   PRIMARY KEY(Id_Article),
   FOREIGN KEY(Id_Instruments) REFERENCES Instruments(Id_Instruments)
);

CREATE TABLE Utilisateur(
   idUtilisateur INT,
   mail VARCHAR(50),
   login VARCHAR(50),
   pass VARCHAR(50),
   sexe VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   tel VARCHAR(50),
   adresse VARCHAR(50),
   ville VARCHAR(50),
   codePostal INT,
   idCmd INT NOT NULL,
   PRIMARY KEY(idUtilisateur),
   FOREIGN KEY(idCmd) REFERENCES Commande(idCmd)
);

CREATE TABLE Ligne_Commande(
   Id_Article INT,
   idCmd INT,
   PRIMARY KEY(Id_Article, idCmd),
   FOREIGN KEY(Id_Article) REFERENCES Article(Id_Article),
   FOREIGN KEY(idCmd) REFERENCES Commande(idCmd)
);
