\! echo "Inserting sample data"
-- INVENTORY
INSERT INTO INVENTORY (productName, price, qty) VALUES
  ('Jays',         '284',  '10'),
  ('Neighkey',     '140',  '15'),
  ('Kaunverse',    '125',  '30'),
  ('Aceicks',       '65',   '5'),
  ('Sawconeys',     '40',   '9'),
  ('Pooma',        '200',  '30'),
  ('KNEW BALANTS', '230',  '20'),
  ('Shampiens',    '240',  '15'),
  ('TIMZ',         '210',  '20'),
  ('Feela',        '300',  '10'),
  ('UGH',          '250', '100'),
  ('AWF-Wight',   '3000',  '10'),
  ('Ah-D-Daas',    '400', '300'),
  ('Goochy',      '5000',   '5'),
  ('SOOPREME',    '3500',  '40'),
  ('DRAW-ERS',     '100', '500'),
  ('Birk-Stock',   '200', '400'),
  ('Rea-Bawk',     '199', '250'),
  ('Doctor Martin','400', '400'),
  ('KRAWKS',        '70', '300');
\! echo "* INVENTORY"

-- employees
INSERT INTO USER VALUES
  ('Bohuslava',  true),
  ('Yelyzaveta', true);
\! echo "* USER: Employee"

-- customers 
INSERT INTO USER VALUES
  ('Anatoli', false),
  ('Serhii', false),
  ('Maryana', false),
  ('Viktoriia', false),
  ('Tyberiy', false);
\! echo "* USER: Custumers"

-- orders
INSERT INTO `ORDER` (userName, billingINFO, shipINFO) VALUES
  ('Anatoli',   '4263982640269299',  '2175 Timber Ridge Road'),
  ('Serhii',     '374245455400126',   '208 Pick Street'),
  ('Maryana',   '6250941006528599',  '2941 Black Stallion Road'),
  ('Viktoriia', '5425233430109903',   '110 Hickory Heights Drive'),
  ('Tyberiy',   '2223000048410010',   '997 Burnside Court');
\! echo "* ORDER"

-- order contents
INSERT INTO ORDER_CONTENTS (orderID, productID, orderQTY) VALUES
  ('1',  '8', '1'),
  ('1', '17', '1'),
  ('1', '12', '1'),
  ('2',  '5', '1'),
  ('3',  '8', '2'),
  ('4', '20', '1'),
  ('4',  '1', '2'),
  ('5',  '2', '1');
\! echo "* ORDER_CONTENTS"
