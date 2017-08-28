<!-- Abraham Rodriguez  -->
<!-- ZID: Z1758468 -->
<!-- Due Date: 11/13/2015 -->

<html>
<head><title> Assignment 10 page 3 </title></head>
<body>
<!-- The start of php  -->
<?php
echo "<h1> Delete a Flight for Passenger </h1><br>";

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
    <form action = "assign10part3.php" method="post">
    <select name = "passenger">
   
<?php
for ($i = 0; $i < $row; $i++)
    {
    echo "<option value=".$row["passnum"]."|".$row["fname"]."|".$row["lname"].">".$row["fname"]." ".$row["lname"]."</option>";
    $row = $allrows[$i];
        }
        $passenger = $_POST['passenger'];
		list($passnum,$fname,$lname) = explode("|", $passenger);
		
		echo "<br>firstname: ".$fname."<br>";
		echo "lastname: ".$lname."<br>";
		echo "Passnum: ".$passnum."<br>";
        echo "</select><br>";

###############################################################################
# determines whether passenger is already on flight.
###############################################################################  
	
# Defining $sql as the query; filters to see if passenger name exists.
$Delete = "SELECT COUNT(*) FROM manifest WHERE passnum='".$passnum."'";
$row = $pdo->fetch_row($Delete);
$result3 =$pdo->query($Delete);
$passcount = $result3->fetch(PDO::FETCH_BOTH);

# Determines whether passenger already exists or add them to database.
if ($passcount["COUNT(*)"] > 0) 
	{
	$sql = "DELETE FROM manifest WHERE passnum='".$passnum."'";
    $pdo->query($sql);
    echo "<br>Passenger was deleted successfully from manifest!<br>";
    echo "<br>Passenger ".$fname." ".$lname." on flight number ".$row[0]." has been deleted from manifest table.<br>";
	echo $passcount;
	echo $passnum;
	
	} 
else 
	{ 
    echo "<br>Passenger not found on manifest!<br>";
	}
    
    echo "<br>Click submit to delete Passenger from Flight manifest.<br>";
    echo '<input type="Submit" name="Submit" value="Submit"><br>';
    echo "</form><br>";
?>
</body>
</html>