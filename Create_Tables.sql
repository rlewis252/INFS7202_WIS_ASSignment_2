DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Items;
DROP TABLE IF EXISTS Sales;
DROP PROCEDURE IF EXISTS PurchaseItem;

CREATE TABLE Users(
UserID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
USERNAME VARCHAR(40) NOT NULL UNIQUE,
PASSWORD VARCHAR (40) NOT NULL,
NAME VARCHAR(40) NOT NULL
--IMAGEURL VARCHAR(80) DEFAULT "images/avatar.png"
);

CREATE TABLE Items(
ItemID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
NAME VARCHAR(40) NOT NULL,
PRICE DECIMAL(13, 2) NOT NULL,
DESCRIPTION TINYTEXT,
IMAGEURL VARCHAR(80) DEFAULT "http://placehold.it/150x80?text=IMAGE",
SellerID INTEGER NOT NULL,
SalesNumber INTEGER NOT NULL DEFAULT 0,
isAvailable BOOLEAN NOT NULL DEFAULT TRUE,
FOREIGN KEY (SellerID) REFERENCES Users(UserID)
);

CREATE TABLE Sales(
SaleID INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
BuyerID INTEGER NOT NULL,
ItemID INTEGER NOT NULL,
FOREIGN KEY (BuyerID) REFERENCES Users(UserID),
FOREIGN KEY (ItemID) REFERENCES Items(ItemID)
);

-- Login
SELECT *
FROM Users
WHERE USERNAME = ? AND PASSWORD = ?;
-- Sign Up
INSERT INTO User (USERNAME, PASSWORD, NAME) 
VALUES (?, ?, ?);
-- Search based on query
SELECT ItemID, NAME, PRICE, IMAGEURL
FROM Items
WHERE NAME LIKE '%?%';
-- Retrieve Top results based on sales numbers
SELECT ItemID, NAME, IMAGEURL
FROM Items
ORDER BY SalesNumber DESC
LIMIT 8;
-- Products a user is currently selling
SELECT NAME, PRICE, SalesNumber
FROM Items
WHERE SellerID = ?;
-- Products a user has bought
SELECT I.NAME, I.PRICE
FROM Items I, Sales S
WHERE S.BuyerID = ? AND S.ItemID = I.ItemID;
-- Update user details
UPDATE Users
SET USERNAME = ?, NAME = ?
WHERE UserID = ?;
-- Get all item data based on id number
SELECT *
FROM Items
WHERE ItemID = ?;
-- Put Item up for sale
INSERT INTO Items (NAME, PRICE, DESCRIPTION, IMAGEURL, ItemSellerID, SalesNumber) 
VALUES (?, ?, ?, ?, ?, 0);
-- Purchase item stored procedure
DELIMITER //
CREATE PROCEDURE PurchaseItem(IN uID INTEGER, IN iID INTEGER)
	BEGIN
		INSERT INTO Sales (BuyerID, ItemID) VALUES (uID, iID);
		UPDATE Items SET SalesNumber = SalesNumber + 1 WHERE ItemID = iID;
	END
DELIMITER ;
CALL PurchaseItem(?, ?);