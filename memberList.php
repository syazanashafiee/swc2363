<html>
<head>
<title>BananaBro Ordering System</title>

</head>

<?php

//call file to connect server eleave
include ("BananaBro-header.php");
?>
<img src="online.png" width="168" height="95" alt="bananabro"/>

<center>
<h2> List of Member</h2>

<?php
//make the query
$q = "SELECT memberID, memberPassword, memberName, memberPhoneNo
FROM membership
ORDER BY memberID";

//run the query and assign it to the variable $result
$result = @mysqli_query ($connect, $q);
if($result)
{
	//Table heading
	echo '<table border ="2">
	<tr>
	<td align ="center"><strong>ID</strong></td>
	<td align ="center"><strong>NAME</strong></td>
	<td align ="center"><strong>PHONE NO.</strong></td>
	<td align ="center"><strong>UPDATE</strong></td>
	<td align ="center"><strong>DELETE</strong></td>
	</tr>';
	
	//Fetch and print all the records
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo'<tr>
		<td>' .$row['memberID'].'</td>
		<td>' .$row['memberName'].'</td>
		<td>' .$row['memberPhoneNo'].'</td>
		
		
		<td align="center"><a href="memberUpdate.php?id='.$row['memberID'].'">Update</a></td>
		<td align="center"><a href="memberDelete.php?id='.$row['memberID'].'">Delete</a></td>
		</tr>';
	}
	//close the table
	echo '</table>';
	
	//free up the resources
	mysqli_free_result($result);
	
//if failed to run
}
else
{
	//error message
	echo '<p class ="error"> The current user could not be retrieved.
	We apologize for any inconvenience.</p>';
	
	//debugging message
	echo '<p>' .mysqli_error ($connect). '<br><br>Query:'.$q.'</p>';
}//end of if ($result)
	//close the database connection
mysqli_close($connect);

?>

<br><br>
<center>
<a href="AdminPage.html"><button class= "adminpage">DONE</button></center>

</div>
</div>
</body>
</html>
		