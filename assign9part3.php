<!-- Abraham Rodriguez  -->
<!-- ZID: Z1758468 -->
<!-- Due Date: 11/9/2015 -->

<html>
<head><title> Assignment 9 </title></head>
<body>
<!-- The start of php  -->
<?php
echo "<h1>All Flight Itenerary </h1><br>";

echo '<a href="http://students.cs.niu.edu/~z1758468/assign9part1.php"><- Back to flights</a><br>';

$username = "z1758468";
$password = "1983Dec19";

try { // if something goes wrong, an exception is thrown;
    $dsn = "mysql:host=courses; dbname=z1758468";
    $pdo = new PDO($dsn, $username, $password);
    echo "Database Connected Successfully";
    }
catch(PDOexception $e) 
    { // handle that exception
    echo "Connection to database failed: " . $e->getMessage(); 
    }
               
# Defining $sql as the query you’d like to run; here’s one from airflights
$sql = "SELECT flightnum, origination, destination FROM flight";

# Run the query - the results are stored into the $result object on success
$result = $pdo->query($sql);
$row = $result->fetch(PDO::FETCH_BOTH);
$allrows = $result->fetchAll();
 
echo "Select a Flight<br>";
?>
    <form action = "assign9part3.php" method="post">
    <select name = "flight">
<?php

for ($i = 0; $i < $row; $i++)
    {
    echo "<option value=".$row["flightnum"].",".$row["origination"]."> Departing From - ".$row["origination"]." & Arriving at - ".$row["destination"]."</option>";
    $row = $allrows[$i];
        }
    echo "</select>";

    $flight = $_POST['flight'];
    list($Fl,$city,$city2) = explode(",", $_POST['flight']);
    
$sql2 = "SELECT COUNT(passnum), flightnum, dateofflight, seatnum FROM manifest WHERE flightnum = '" . $flight . "'";

# Run the query - the results are stored into the $result object on success
$result2 = $pdo->query($sql2);
$row2 = $result2->fetch(PDO::FETCH_BOTH);
$allrows2 = $result2->fetchAll();

echo "<table><tr><th>Flight #</th><th>Passenger #</th><th>Date of Flight</th><th>Seat #</th></tr><br>";

    for ($i = 0; $i < $row2; $i++)
    {
    echo "<br>Flight number " . $Fl . " departing from ".$city." ".$city2." has a total of ".$row2["COUNT(passnum)"]. " passenger with reserved seats.<br>";

    echo "<tr><td>" . $row2["flightnum"] . "</td><td>" . $row2["COUNT(passnum)"] . "</td><td>" . $row2["dateofflight"]. "</td><td>" .$row2["seatnum"] ."</td></tr>";
    $row2 = $allrows2[$i];
    }
    
    echo "<br>Click submit to see how many passengers are on a flight.<br>";

    echo '<input type="Submit" name="Submit" value="Submit"><br>';

    echo "</form><br>";
?>
</body>
</html>