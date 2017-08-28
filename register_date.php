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
//echo "<h1> Register a dog per event. </h1><br>";


$username = "zxxxxxxx";
$password = "xxxxxxxx";

try { // if something goes wrong, an exception is thrown;
    $dsn = "mysql:host=courses; dbname=zxxxxxxx";
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
		//list($memberID,$fname,$lname) = explode("|", $date);        
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
    echo "<option value=".$row["id"]."|".$row["fname"]."|".$row["lname"].">".$row["fname"]." ".$row["lname"]."</option>";
    $row = $allrows[$i];
        }
        $memberinfo = $_POST['member'];
		list($memberID,$fname,$lname) = explode("|", $memberinfo);        
        echo "</select><br><br> Select one dog to be registered on ".$date."<br>";

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
    echo "<option value=".$row2["id"]."|".$row2["name"].">".$row2["name"]."</option>";
    $row2 = $allrows2[$i];
        }
    echo "</select><br>";
    
    //$dogInfo = $_POST['dog'];
    list($dogID,$dogname) = explode("|", $_POST['dog']);

###############################################################################
# determines whether dog has been registered.
###############################################################################  
	echo $dogID;
	echo "<br>".$memberID;
# Defining $sql as the query; filters to see if passenger name exists.
$dupicate = "SELECT COUNT(*) FROM reg_date WHERE dog_id='".$dogID."'and date='".$date."'";
$result3 = $pdo->query($dupicate);
$count = $result3->fetch(PDO::FETCH_BOTH);
$allrows3 = $result3->fetchAll();

$info = "SELECT COUNT(*) FROM reg_date WHERE member_id='".$memberID."'and date='".$date."'";
$newresult = $pdo->query($info);
$newrow = $newresult->fetch(PDO::FETCH_BOTH);
$allrows3 = $result3->fetchAll();

# Determines whether dog has been registered to database.
if ($newrow["COUNT(*)"] <= 3)
{
    if ($count["COUNT(*)"] > 0) 
	    {
        echo "<br>Your dog ".$dogname." has already been registered for ".$date." <br>";
	    }
        else 
	    {
        $sql = "INSERT INTO reg_date (date, dog_id, member_id) VALUES ('".$date."','".$dogID."','".$memberID."')";
        $pdo->query($sql);
        echo "<br>".$dogname." was registerd successfully!<br>";
	    }
}
else
{
echo "<br>You have registered the maximum (3) dogs for the ".$date." event!<br>";
echo "Choose another date.<br>";
}
    echo "<br>Submit to register dogs per date.<br>";

    echo '<input type="Submit" name="Submit" value="Submit"><br>';

    echo "</form><br>";
?>
</body>
</html>