INSERT INTO INVENTORY (productName, price, qty) VALUES ('Jays', '284', '10');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Neighkey', '140', '15');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Kaunverse', '125', '30');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Aceicks',  '65', '5');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Sawconeys', '40', '9');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Pooma', '200', '30');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('KNEW BALANTS', '230', '20');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Shampiens', '240', '15');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('TIMZ', '210', '20');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Feela', '300', '10');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('UGH', '250', '100');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('AWF-Wight', '3000', '10');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Ah-D-Daas', '400', '300');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Goochy', '5000', '5');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('SOOPREME', '3500', '40');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('DRAW-ERS', '100', '500');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Birk-Stock', '200', '400');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Rea-Bawk', '199', '250');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('Doctor Martin', '400', '400');

INSERT INTO INVENTORY (productName, price, qty) VALUES ('KRAWKS', '70', '300');

-- employees
INSERT INTO USERZ VALUES ('Bohuslava', true);
INSERT INTO USERZ VALUES ('Yelyzaveta', true);

-- customers 
INSERT INTO USERZ VALUES ('Anatoli', false);
INSERT INTO USERZ VALUES ('Serhii', false);
INSERT INTO USERZ VALUES ('Maryana', false);
INSERT INTO USERZ VALUES ('Viktoriia', false);
INSERT INTO USERZ VALUES ('Tyberiy', false);

-- orders
INSERT INTO ORDERZ (userName, billingINFO, shipINFO) VALUES ('Anatoli', '4263982640269299', '2175 Timber Ridge Road');
INSERT INTO ORDERZ (userName, billingINFO, shipINFO) VALUES ('Serhii', '374245455400126', '208 Pick Street');
INSERT INTO ORDERZ (userName, billingINFO, shipINFO) VALUES ('Maryana', '6250941006528599', '2941 Black Stallion Road');
INSERT INTO ORDERZ (userName, billingINFO, shipINFO) VALUES ('Viktoriia', '5425233430109903', '110 Hickory Heights Drive');
INSERT INTO ORDERZ (userName, billingINFO, shipINFO) VALUES ('Tyberiy', '2223000048410010', '997 Burnside Court');

-- order contents
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES ('1', '8', '1');
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES ('1', '17', '1');
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES ('1', '12', '1');
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES ('2', '5', '1');
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES ('3', '8', '2');
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES ('4', '20', '1');
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES ('4', '1', '2');
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES ('5', '2', '1');
