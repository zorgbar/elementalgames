CREATE DATABASE
IF
  NOT EXISTS elementalGamesDB;

  USE elementalGamesDB;




  CREATE TABLE
  IF
    NOT EXISTS queries (
      Name VARCHAR(100)
      , Email VARCHAR(100) PRIMARY KEY
      , Message LONGTEXT
    ) CREATE TABLE
    IF
      NOT EXISTS products (
        ProductID INT AUTO_INCREMENT PRIMARY KEY
        , ProductName VARCHAR(100)
        , ProductType VARCHAR(50)
        , ProductPrice DECIMAL(10, 2)
        , ProductStock INT
        , ProductPic VARCHAR(100)
      );

      CREATE TABLE cart_items (
        id INT AUTO_INCREMENT PRIMARY KEY
        , product_id INT
        , quantity INT
        , FOREIGN KEY (product_id) REFERENCES products(id)
      );


      CREATE TABLE
      IF
        NOT EXISTS users (
          userID INT AUTO_INCREMENT PRIMARY KEY
          , userEmail VARCHAR(100)
          , userPass VARCHAR(100)
        );

        INSERT INTO
          products (ProductName, ProductType, ProductPrice)
        VALUES
          ('Space Marine Captain', 'Miniature', 250.99)
          , ('Chaos Cultists', 'Miniature', 140.99)
          , (
            'Imperial Guard Infantry Squad'
            , 'Miniature'
            , 340.99
          )
          , ('Ork Boyz', 'Miniature', 190.99)
          , ('Eldar Guardians', 'Miniature', 270.99)
          , ('Tyranid Warriors', 'Miniature', 320.99)
          , ('Necron Immortals', 'Miniature', 280.99)
          , ('Blood Angels Tactical Squad', 'Miniature', 310.99)
          , ('Dark Angels Intercessors', 'Miniature', 290.99)
          , ('Tau Fire Warriors', 'Miniature', 260.99)
          , ('Astra Militarum Paint Set', 'Paint', 490.99)
          , ('Chaos Space Marines Paint Set', 'Paint', 490.99)
          , ('Ultramarines Paint Set', 'Paint', 490.99)
          , ('Ork Boyz Paint Set', 'Paint', 490.99)
          , ('Eldar Guardians Paint Set', 'Paint', 490.99)
          , ('Tyranid Warriors Paint Set', 'Paint', 490.99)
          , ('Necron Immortals Paint Set', 'Paint', 490.99)
          , ('Blood Angels Paint Set', 'Paint', 490.99)
          , ('Dark Angels Paint Set', 'Paint', 490.99)
          , ('Tau Fire Warriors Paint Set', 'Paint', 490.99)
          , ('Space Marine Lieutenant', 'Miniature', 270.99)
          , ('Imperial Guardsmen', 'Miniature', 160.99)
          , ('Ork Warboss', 'Miniature', 390.99)
          , (
            'Craftworlds Start Collecting Box'
            , 'Miniature'
            , 790.99
          )
          , (
            'Tyranid Start Collecting Box'
            , 'Miniature'
            , 840.99
          )
          , ('Necron Start Collecting Box', 'Miniature', 790.99)
          , (
            'Blood Angels Start Collecting Box'
            , 'Miniature'
            , 840.99
          )
          , (
            'Dark Angels Start Collecting Box'
            , 'Miniature'
            , 840.99
          )
          , (
            'Tau Empire Start Collecting Box'
            , 'Miniature'
            , 790.99
          )
          , ('Citadel Base Paint Set', 'Paint', 340.99)
          , ('Citadel Layer Paint Set', 'Paint', 340.99)
          , ('Citadel Shade Paint Set', 'Paint', 340.99)
          , ('Citadel Dry Paint Set', 'Paint', 340.99)
          , ('Citadel Technical Paint Set', 'Paint', 340.99)
          , ('Chaos Space Marines', 'Miniature', 290.99)
          , ('Primaris Intercessors', 'Miniature', 390.99)
          , ('Necron Warriors', 'Miniature', 320.99)
          , ('Ork Boyz', 'Miniature', 290.99)
          , ('Space Marine Scouts', 'Miniature', 310.99)
          , ('Harlequin Troupe', 'Miniature', 390.99)
          , ('Tyranid Hive Tyrant', 'Miniature', 590.99)
          , ('Tau Commander', 'Miniature', 390.99)
          , (
            'Astra Militarum Cadian Infantry Squad'
            , 'Miniature'
            , 320.99
          )
          , ('Necron Destroyers', 'Miniature', 390.99)
          , ('Blood Angels Death Company', 'Miniature', 390.99)
          , (
            'Dark Angels Deathwing Knights'
            , 'Miniature'
            , 390.99
          )
          , ('Eldar Wraithguard', 'Miniature', 390.99)
          , ('Chaos Cultists Paint Set', 'Paint', 190.99)
          , ('Space Wolves Paint Set', 'Paint', 190.99)
          , ('Death Guard Paint Set', 'Paint', 190.99)
          , ('Drukhari Paint Set', 'Paint', 190.99)
          , ('Tau Empire Paint Set', 'Paint', 190.99);