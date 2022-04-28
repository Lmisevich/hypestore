DROP TABLE IF EXISTS SHOPPING_CART_TOTAL, SHOPPING_CART, ORDER_CONTENTS, `ORDER`,INVENTORY,USER;

CREATE TABLE USER (
    userName VARCHAR(20) PRIMARY KEY,
    isEmployee BOOLEAN
);

CREATE TABLE INVENTORY (
    productID INT PRIMARY KEY AUTO_INCREMENT,
    productName VARCHAR(20),
    price INT,
    qty INT
);

CREATE TABLE `ORDER` (
    orderID INT AUTO_INCREMENT PRIMARY KEY, 
    userName VARCHAR(20),
    billingINFO CHAR(16),
    shipINFO VARCHAR(255),
    shipStatus VARCHAR(40) DEFAULT 'Processing',
    FOREIGN KEY (userName) REFERENCES USER(userName)
);

CREATE TABLE ORDER_CONTENTS (
    orderID INT,
    productID INT,
    orderQTY INT,
    PRIMARY KEY (orderID,productID),
    FOREIGN KEY (orderID) REFERENCES `ORDER` (orderID),
    FOREIGN KEY (productID) REFERENCES INVENTORY (productID)
);

CREATE TABLE SHOPPING_CART (
    userName VARCHAR(20),
    productID INT,
    orderQTY INT,
    PRIMARY KEY (userName,productID),
    FOREIGN KEY (userName) REFERENCES USER(userName),
    FOREIGN KEY (productID) REFERENCES INVENTORY(productID)
);

CREATE TABLE SHOPPING_CART_TOTAL (
    userName VARCHAR(20) PRIMARY KEY,
    total INT,
    FOREIGN KEY (userName) REFERENCES USER(userName)
);