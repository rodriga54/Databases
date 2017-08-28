<!-- Abraham Rodriguez  -->
<!-- ZID: Z1758468 -->
<!-- Due Date: 11/13/2015 -->

<html>
<head><title> Assignment 10 page 2 </title></head>
<body>
<!-- The start of php  -->
<?php
echo "<h1> Adding passenger to flight </h1><br>";

echo '<a href="http://students.cs.niu.edu/~z1758468/assign9part1.php"> <- Back to flights</a><br>';

$username = "z1758468";
$password = "1983Dec19";

try { // if something goes wrong, an exception is thrown;
    $dsn = "mysql:host=courses; dbname=z1758468";
    $pdo = new PDO($dsn, $username, $password);
    echo "<font color='red'> Database Connected Successfully!</font><br>";
    }
catch(PDOexception $e) 
    { // handle that exception
    echo "Connection to database failed: " . $e->getMessage()."<br>"; 
    }
 
###############################################################################
# Creating a list of passenger to a drop down
###############################################################################
  
# Defining $sql as the query; All passengers in database.
$sql = "SELECT * FROM passenger";

# Run the query - the results are stored into the $result object on success
$result = $pdo->query($sql);
$row = $result->fetch(PDO::FETCH_BOTH);
$allrows = $result->fetchAll();
 
echo "<br>Select a Passenger<br>";
?>
    <form action = "assign10part2.php" method="post">
    <select name = "passenger">
   
<?php
for ($i = 0; $i < $row; $i++)
    {
    echo "<option value=".$row["passnum"]."|".$row["fname"]."|".$row["lname"].">".$row["fname"]." ".$row["lname"]."</option>";
    $row = $allrows[$i];
        }
        $passenger = $_POST['passenger'];
		list($passnum,$fname,$lname) = explode("|", $passenger);        
        echo "</select><br><br> Select a Flight<br>";

###############################################################################
# Creating list of flights to a drop down.
###############################################################################		
?>
    <form action = "assign10part2.php" method="post">
    <select name = "flight">
<?php
		
# Defining $sql as the query; All flights in database.
$sql2 = "SELECT * FROM flight";
# Run the query - the results are stored into the $result object on success
$result2 = $pdo->query($sql2);
$row2 = $result2->fetch(PDO::FETCH_BOTH);
$allrows2 = $result2->fetchAll();

for ($i = 0; $i < $row2; $i++)
    {
    echo "<option value=".$row2["flightnum"]."|".$row2["origination"]."|".$row2["destination"]."> Departing - ".$row2["origination"]." -> Arriving - ".$row2["destination"]."</option>";
    $row2 = $allrows2[$i];
        }
    echo "</select><br>";
    
    $flight = $_POST['flight'];
    list($flightnum,$From,$To) = explode("|", $_POST['flight']);

###############################################################################
# determines wether passenger is already on flight.
###############################################################################  
	
# Defining $sql as the query; filters to see if passenger name exists.
$dupicate = "SELECT COUNT(*) FROM manifest WHERE passnum='".$passnum."' and flightnum='".$flightnum."'";
$result3 = $pdo->query($dupicate);
$count = $result3->fetch(PDO::FETCH_BOTH);
$allrows3 = $result3->fetchAll();

$info = "SELECT DISTINCT(dateofflight)
 FROM manifest WHERE flightnum='".$flightnum."'";
$newresult = $pdo->query($info);
$newrow = $newresult->fetch(PDO::FETCH_BOTH);
//$allrows3 = $result3->fetchAll();
# Determines wether passenger already exists or add them to database.
    if ($count["COUNT(*)"] > 0) 
	    {
        echo "<br>Passenger ". $fname."  " . $lname." is already on this flight.<br>";
	    }
        else 
	    {
	    
	    echo $flightnum;
	    echo $passnum;
        $sql = "INSERT INTO manifest (flightnum, dateofflight, passnum, seatnum) VALUES ('".$flightnum."','".$newrow["dateofflight"]."','".$passnum."','".$newrow["seatnum"]."')";
        $pdo->query($sql);
        echo "<br>New record created successfully!<br>";
        echo "<br>Passenger ".$fname."  ".$lname." has booked a flight From ".$From." To ".$To.".<br>";
	    }

    echo "<br>Click submit to see how many passengers are on a flight.<br>";

    echo '<input type="Submit" name="Submit" value="Submit"><br>';

    echo "</form><br>";
?>
</body>
</html>