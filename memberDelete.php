<html>
<head>
<title>BananaBro Ordering System</title>
</head>
<body>
<?php
//call file to connect server eleave
include ("BananaBro-header.php");
?>
<img src="online.png" width="168" height="95" alt="bananabro"/>
<center>
<h2> Delete Member Record</h2>

<?php
//look for a valid user id, either through GET or POST
if ((isset ($_GET['id'])) && (is_numeric($_GET['id'])))
{
	$id = $_GET['id'];
}
else if ((isset ($_POST['id'])) && (is_numeric($_POST['id'])))
{
	$id = $_POST['id'];
}
else
{
	echo '<p class ="eroor"> This page has been accessed in error.</p>';
	exit();
}

if ($_SERVER['REQUEST_METHOD']== 'POST')
{
	if ($_POST['sure']=='Yes') //Delete the record
	{
		//make the query
		$q = "DELETE FROM membership WHERE memberID = $id LIMIT 1";
		$result = @mysqli_query ($connect, $q); //run the query
		
		if (mysqli_affected_rows($connect) == 1)//if there was a problem
		//display message
			{
				echo '<script>alert("The user has been deleted");
				window.location.href="memberList.php";</script>';
			}
			else
				{
					//display error message
				echo '<p class ="error"> The record could not be deleted.<br>
				probably because it does not exist or due to system error.</p>';
				
				echo '<p>'.mysqli_error($connect). '<br/> Query:'.$q.'</p>';
				//debugging message
			}
		}
			else
			{
				echo '<script>alert("The member has NOT been deleted");
                windoww.location.href="memberList.php";</script>';
			}				
			
		}
		else
		{
			//display the form
			//Retrieve the member's data
			
			$q = "SELECT memberName FROM membership WHERE memberID = $id";
			$result = @mysqli_query ($connect, $q); //run the query
			
			if (mysqli_num_rows($result) ==1)
			{
				//get admin information
				$row = mysqli_fetch_array ($result, MYSQLI_NUM);
				echo "<h3>Are you sure want to permanently delete $row[0]? </h3>";
				echo '<form action = "memberDelete.php" method ="post">
				<input id = "submit-no" type="submit" name="sure" value="Yes">
				<input id = "submit-no" type="submit" name="sure" value="No">
				<input type ="hidden" name="id" value="'.$id.'">
				</form>';
			}
			
			else
			{ //if it didnt run
		//message
		echo '<p class ="error" This.page has been acessed in error<p>';
		echo '<p> &nbsp; </p>';
			} //end of it (result)
		}
		
		mysqli_close($connect); //close the database connection_aborted
		?>
		</body>
		</html>