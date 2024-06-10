drop database if exists Waffenverwaltung;

-- Crearea bazei de date
CREATE DATABASE Waffenverwaltung;
USE Waffenverwaltung;

-- Crearea tabelei Administratoren
CREATE TABLE Administratoren (
                                 ID INT AUTO_INCREMENT PRIMARY KEY,
                                 Name VARCHAR(100),
                                 email VARCHAR(100),
                                 Kontakt VARCHAR(100),
                                 Adresse VARCHAR(255),
                                 pwhash VARCHAR(255)
);

-- Crearea tabelei Lieferanten
CREATE TABLE Lieferanten (
                             Lieferant_ID INT AUTO_INCREMENT PRIMARY KEY,
                             Name VARCHAR(100),
                             Kontakt VARCHAR(100)
);

-- Crearea tabelei Produkte
CREATE TABLE Produkte (
                          Produkt_ID INT AUTO_INCREMENT PRIMARY KEY,
                          Name VARCHAR(100),
                          Kategorien VARCHAR(100),
                          Menge INT,
                          Lieferant_ID INT,
                          FOREIGN KEY (Lieferant_ID) REFERENCES Lieferanten(Lieferant_ID)
);

-- Crearea tabelei Bestellungen
CREATE TABLE Bestellungen (
                              Bestell_ID INT AUTO_INCREMENT PRIMARY KEY,
                              Produkt_ID INT,
                              Bestelldatum DATE,
                              Menge INT,
                              Status VARCHAR(50),
                              FOREIGN KEY (Produkt_ID) REFERENCES Produkte(Produkt_ID)
);
