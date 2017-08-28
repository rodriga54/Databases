 /* Abraham Rodriguez       
    Assignment 5            
    ZID Z1758468            
    Due Date: 10/9/2015     */

/* part 1 */
 \! echo "Use of classicmodels database"
USE classicmodels;

 \! echo "Explain statement "
 \! echo " EXPLAIN returns a row of information for each table used in the SELECT" 
 \! echo " statement. It lists the tables in the output in the order that MySQL"
 \! echo " would read them while processing the statement. MySQL resolves all joins" 
 \! echo " using a nested-loop join method. This means that MySQL reads a row from"
 \! echo " the first table, and then finds a matching row in the second table, the"
 \! echo " third table, and so on. When all tables are processed, MySQL outputs the" 
 \! echo " selected columns and backtracks through the table list until a table is"
 \! echo " found for which there are more matching rows. The next row is read from" 
 \! echo " this table and the process continues with the next table."

/* EXPLAIN Statement */
EXPLAIN SELECT customerName FROM Customers LEFT JOIN Payments ON Customers.customerName=Payments.amount GROUP BY customerName;

 \! echo "Describe statement "
 \! echo " Describes the table in detail: field name, type(character, int, etc.)"
 \! echo " NUll requirements, list the Primary Keys."
 
/* DESCRIBE Statement */
DESCRIBE Customers;
DESCRIBE Payments;

use z1758468;

/* part 2 */

 \! echo "2. creating table called owners"
/* 2 */
CREATE TABLE owner (owner_ID int AUTO_INCREMENT PRIMARY KEY, Oname char(20));

/* 3 */
\! echo "3. Adding 5 values to owner table"

INSERT owner (Oname) VALUE('Russell Wilson');
INSERT owner (Oname) VALUE('Tom Brady');
INSERT owner (Oname) VALUE('Cam Newton');
INSERT owner (Oname) VALUE('Andrew Luck');
INSERT owner (Oname) VALUE('Payton Manning');

/* 4 */
\! echo "4. selecting owner table"
SELECT * FROM owner;

/* 5 */
 \! echo "5. creating table called pet"
CREATE TABLE pet (petID int PRIMARY KEY AUTO_INCREMENT, Pname char(20), owner_ID int, FOREIGN KEY (owner_ID) REFERENCES owner(owner_ID));
/* 6 */
 \! echo "6. Adding 5 values to pet table"
INSERT pet (Pname,owner_ID) VALUE('SeaHawk', '1');
INSERT pet (Pname,owner_ID) VALUE('Patriot', '2');
INSERT pet (Pname,owner_ID) VALUE('Panther', '3');
INSERT pet (Pname,owner_ID) VALUE('Colt', '4');
INSERT pet (Pname,owner_ID) VALUE('Bronco', '5');

/* 7 */
\! echo "7. selecting pet table"
SELECT * FROM pet;

/* 8 */
\! echo "8. Altering pet table to add new column"
ALTER TABLE pet ADD Ptype char(10);

/* 9 */
\! echo "9. Updating Ptype column with values."

UPDATE pet SET Ptype='Dog' WHERE Pname='SeaHawk';
UPDATE pet SET Ptype='Cat' WHERE Pname='Patriot';
UPDATE pet SET Ptype='Bird' WHERE Pname='Panther';
UPDATE pet SET Ptype='Fish' WHERE Pname='Colt';
UPDATE pet SET Ptype='Horse' WHERE Pname='Bronco';

/* 10 */
\! echo "10. Selecting pet table""
SELECT * FROM pet;

/* 11 */
\! echo "11. Creating a new view/table called owners_pets."
CREATE VIEW owners_pets AS SELECT owner.Oname, pet.Pname FROM owner LEFT JOIN pet ON owner.owner_ID=pet.petID ORDER BY owner.Oname;

/* 12 */
\! echo "12. Selecting new view/table. "
SELECT * FROM owners_pets;

/* 1 Drop tables and views */
\! echo "1. Dropping all tables and view created above."

DROP TABLE pet;
DROP VIEW owners_pets;
DROP TABLE owner;