 /* Abraham Rodriguez       
    Assignment 5            
    ZID Z1758468            
    Due Date: 10/2/2015     */

/* 1 */
select city, count(employeeNumber) from Offices LEFT JOIN Employees ON Offices.officeCode=Employees.officeCode GROUP By City;

/* 2 */
SELECT firstName, lastName, COUNT(customerNumber) FROM Employees inner JOIN Customers ON Employees.employeeNumber=Customers.salesRepEmployeeNumber GROUP BY employeeNumber;

/* 3 */
select reportsTo, firstName,lastName ,employeeNumber FROM Employees;

/* 4 */
SELECT  contactFirstName, contactLastName, sum(amount) FROM Customers, Payments group by contactFirstName limit 25;

/* 5 */
SELECT COUNT(DISTINCT customerNumber, salesRepEmployeeNumber) FROM Customers;

/* 6 */
SELECT city, COUNT(customerNumber) FROM Customers GROUP BY city;

/* 7 */
SELECT customerName, MAX(buyPrice) FROM Customers, Products GROUP BY customerName;

/* 8 */
SELECT customerName FROM Customers LEFT JOIN Payments ON Customers.customerName=Payments.amount GROUP BY customerName;

/* 9 */
SELECT productDescription FROM Products WHERE productVendor='Min Lin Diecast' OR productVendor='Exoto Designs';

/* Extra Credit 1. */
SELECT DISTINCT orderNumber, customerName, productName PODUCT_NAMES FROM OrderDetails, Customers, Products ORDER BY customerName LIMIT 10;

/* Extra Credit 2. */
SELECT orderNumber, Avg(amount) FROM Orders LEFT JOIN Payments ON Orders.customerNumber=Payments.customerNumber GROUP BY orderNumber;