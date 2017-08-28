<!-- Abraham Rodriguez  -->
<!-- ZID: Z1758468 -->
<!-- Due Date: 11/13/2015 -->

<html>
<head><title> Assignment 10 </title></head>
<body>
<!-- The start of php  -->
<?php
echo "<h1> Create New Passenger </h1><br>";

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
?>
<!--    Input boxes to enter passenger name"> -->
    <form action = "assign10part1.php" method="post"><br>
    First name:<br>
    <input type="text" name="firstname"><br>
    Last name:<br>
    <input type="text" name="lastname"><br>
 <?php
 
    echo "<br>Click submit to add passenger to database.<br>";
    echo '<input type="Submit" name="Submit" value="Submit"><br>';
    echo "</form>";
    
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
               
# Defining $sql as the query you’d like to run; here’s one from airflights
$dupicate = "SELECT COUNT(*) FROM passenger WHERE fname='".$fname."' and lname='".$lname."'";

$result =$pdo->query($dupicate);
$count = $result->fetch(PDO::FETCH_BOTH);
$allrows = $result->fetchAll();

if ($count["COUNT(*)"] > 0) 
    {
    echo "Passenger " . $fname . " " . $lname . " already exists in database.";
    } 
    else 
    {
    $sql = "INSERT INTO passenger(fname, lname) VALUES ('".$fname."', '".$lname."')";
    $pdo->query($sql);
    echo "New record created successfully";

    }
?>
</body>
</html>