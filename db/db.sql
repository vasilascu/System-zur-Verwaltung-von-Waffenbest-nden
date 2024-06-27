drop database if exists Waffenverwaltung;

-- Crearea bazei de date
CREATE DATABASE Waffenverwaltung;
USE Waffenverwaltung;

-- Crearea tabelei Administratoren
CREATE TABLE Administratoren (
                                 id INT AUTO_INCREMENT PRIMARY KEY,
                                 name VARCHAR(100),
                                 email VARCHAR(100),
                                 kontakt VARCHAR(100),
                                 adresse VARCHAR(255),
                                 pwhash VARCHAR(255)
);

-- Crearea tabelei Lieferanten
CREATE TABLE Lieferanten (
                             lieferant_id INT AUTO_INCREMENT PRIMARY KEY,
                             name VARCHAR(100),
                             kontakt VARCHAR(100),
                             adresse VARCHAR(100)
);

-- Crearea tabelei Produkte
CREATE TABLE Produkte (
                          produkt_id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(100),
                          kategorien VARCHAR(100),
                          menge INT,
                          lieferant_id INT,
                          FOREIGN KEY (lieferant_id) REFERENCES Lieferanten(lieferant_id)
);

-- Crearea tabelei Bestellungen
CREATE TABLE Bestellungen (
                              bestell_id INT AUTO_INCREMENT PRIMARY KEY,
                              produkt_id INT,
                              bestelldatum DATE,
                              menge INT,
                              status VARCHAR(50),
                              FOREIGN KEY (produkt_id) REFERENCES Produkte(produkt_id)
);
