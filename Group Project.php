<!-- Abraham Rodriguez  -->
<!-- ZID: Z1758468 -->
<!-- Due Date: 12/2/2015 

index.php
addmember.php
adddog.php
register_date.php
register_trial.php
trails.php

-->


<html>
<head><title> Register Dogs </title></head>
<body>
<!-- The start of php  -->
<?php
//echo "<h1> Adding passenger to flight </h1><br>";

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
# Creating a list of dates avialable to a drop down
###############################################################################
  
# Defining $sql as the query; All passengers in database.
$sql = "SELECT * FROM date";

# Run the query - the results are stored into the $result object on success
$result = $pdo->query($sql);
$row = $result->fetch(PDO::FETCH_BOTH);
$allrows = $result->fetchAll();
 
echo "<br>Select avialable register dates.<br>";
?>
    <form action = "register_date.php" method="post">
    <select name = "date">
   
<?php
for ($i = 0; $i < $row; $i++)
    {
    echo "<option value=".$row["date"].">".$row["date"]."</option>";
    $row = $allrows[$i];
        }
        $date = $_POST['date'];
		list($memberID,$fname,$lname) = explode("|", $date);        
        echo "</select><br><br> Select one dog to be register to <br>";

 
 
 
 
 
###############################################################################
# Creating a list of Member/handler to a drop down
###############################################################################
  
# Defining $sql as the query; All passengers in database.
$sql = "SELECT * FROM member";

# Run the query - the results are stored into the $result object on success
$result = $pdo->query($sql);
$row = $result->fetch(PDO::FETCH_BOTH);
$allrows = $result->fetchAll();
 
echo "<br>Select your name from the drop down.<br>";
?>
    <form action = "register_date.php" method="post">
    <select name = "member">
   
<?php
for ($i = 0; $i < $row; $i++)
    {
    echo "<option value=".$row["memberID"]."|".$row["fname"]."|".$row["lname"].">".$row["fname"]." ".$row["lname"]."</option>";
    $row = $allrows[$i];
        }
        $member = $_POST['memberID'];
		list($memberID,$fname,$lname) = explode("|", $member);        
        echo "</select><br><br> Select one dog to be register to <br>";

###############################################################################
# Creating list of dogs registered to a drop down.
###############################################################################		
?>
    <form action = "register_date.php" method="post">
    <select name = "dog">
<?php
		
# Defining $sql as the query; All flights in database.
$sql2 = "SELECT * FROM dog";
# Run the query - the results are stored into the $result object on success
$result2 = $pdo->query($sql2);
$row2 = $result2->fetch(PDO::FETCH_BOTH);
$allrows2 = $result2->fetchAll();

for ($i = 0; $i < $row2; $i++)
    {
    echo "<option value=".$row2["dogID"]."|".$row2["dogname"].">".$row2["dogname"]."</option>";
    $row2 = $allrows2[$i];
        }
    echo "</select><br>";
    
    $dogID = $_POST['dog'];
    list($dogID,$dogname) = explode("|", $_POST['dog']);

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