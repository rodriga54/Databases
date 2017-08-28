<!-- Abraham Rodriguez  -->
<!-- ZID: Z1758468 -->
<!-- Due Date: 11/9/2015 -->

<html>
<head><title> Assignment 9 </title></head>
<body>
<!-- The start of php  -->
<?php
echo "<h1>Passenger Flight Itenerary </h1><br>";

// link back to main page.
echo '<a href="http://students.cs.niu.edu/~z1758468/assign9part1.php"><- Back to flights</a><br>';
$username = "z1758468";
$password = "1983Dec19";

try { // if something goes wrong, an exception is thrown;
    $dsn = "mysql:host=courses; dbname=z1758468";
    $pdo = new PDO($dsn, $username, $password);
    echo "Database Connected Successfully<br>";
    }
catch(PDOexception $e) 
    { // handle that exception
    echo "Connection to database failed: <br>" . $e->getMessage(); 
    }
               
# Defining $sql as the query you’d like to run; here’s one from airflights
$sql = "SELECT passnum, fname, lname FROM passenger";

# Run the query - the results are stored into the $result object on success
$result = $pdo->query($sql);
$row = $result->fetch(PDO::FETCH_BOTH);
$allrows = $result->fetchAll();

    echo "Select a Passenger<br>";
?>
    <form action = "assign9part2.php" method="post">
    <select name = "passenger">
<?php

// loop to add rows based of of queries.
for ($i = 0; $i < $row; $i++)
    {   
    echo "<option value=".$row["passnum"].">".$row["fname"]." ".$row["lname"]."</option>";
    $row = $allrows[$i];
    }
    echo "</select>";

    $passenger = $_POST['passenger'];
    echo $passenger;
    
$sql2 = "SELECT flightnum, passnum, dateofflight, seatnum FROM manifest WHERE passnum = '" . $passenger . "'";
# Run the query - the results are stored into the $result object on success
$result2 = $pdo->query($sql2);
$row2 = $result2->fetch(PDO::FETCH_BOTH);
$allrows2 = $result2->fetchAll();

    echo "<table><tr><th>Flight #</th><th>Passenger #</th><th>Date of Flight</th><th>Seat #</th></tr><br>";

for ($i = 0; $i < $row2; $i++)
    {
    echo "<tr><td>" . $row2["flightnum"] . "</td><td>" . $row2["passnum"] . "</td><td>" . $row2["dateofflight"]. "</td><td>" .$row2["seatnum"] ."</td></tr> <br>";
    $row2 = $allrows2[$i];
    }
    
// create a submit button
    echo "<br>Click sumbit to find number of Flights passenger selected is on.<br>";
    echo '<input type="Submit" name="Submit" value="Submit">';
    echo "</form><br>";
?>
</body>
</html>