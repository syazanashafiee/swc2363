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
<h2> Edit Member Record</h2>

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
	echo '<p class ="eror"> This page has been accessed in error.</p>';
	exit();
}

if ($_SERVER['REQUEST_METHOD']== 'POST')
{
	$error = array (); //initialize an error array
	
	//look for a memberName
	if(empty ($_POST ['memberName']))
	{
		$error [] = 'You forgot to enter your name.';
	}
	else
	{
		$n = mysqli_real_escape_string ($connect, trim ($_POST ['memberName']));
	}
	
	//look for a memberPhoneNo
	if(empty ($_POST ['memberPhoneNo']))
	{
		$error [] = 'You forgot to enter your phone number.';
	}
	else
	{
		$ph = mysqli_real_escape_string ($connect, trim ($_POST ['memberPhoneNo']));
	}
	
	
	//if no problem occured
	if (empty($error))
	{
		$q = "SELECT memberID FROM membership WHERE memberName = '$n' AND memberID != $id";
		
		$result= @mysqli_query ($connect,$q); //run the query
		
		if (mysqli_num_rows($result) ==0)
		{
			$q= "UPDATE membership SET memberName ='$n', memberPhoneNo ='$ph'
			 WHERE memberID ='$id' LIMIT 1";
			
			$result = @mysqli_query ($connect,$q); //run the query
			
			if (mysqli_affected_rows($connect) == 1)
			{
				echo '<script>alert("The user has been edited");
				window.location.href="memberList.php";</script>';
			}
			else
			{
				echo '<p class ="error"> The user has not been edited due to the system error.
				We apologize for any inconvenience.</p>';
				echo '<p>'.mysqli_error($connect). '<br/> query:'.$q.'</p>';
			}
		}
			else
			{
				echo '<p class ="error"> The id had been registered <p/>';
			}
		}
		else
		{
			echo '<p class ="error">The following error (s) occured: <br/>';
			foreach ($error as $msg)
			{
				echo "-msg<br>\n";
			}
			echo '<p><p>Please try again.<p>';
		}
	}
	
	$q ="SELECT memberName, memberPhoneNo
	From membership WHERE memberID = $id";
	
	$result = @mysqli_query ($connect, $q); //run the query
	
	if (mysqli_num_rows($result) ==1)
	{
		//get member information
		$row =mysqli_fetch_array($result, MYSQLI_NUM);
		
		//create the form
			echo '<form action ="memberUpdate.php" method ="post">
			<p><label class ="label" for="memberName">Member Name*:</label>
			<input type="text" id="memberName" name="memberName" size ="30"
			maxlength="50" value="'.$row[0].'"></p>
			
			<p><br><label class ="label" for="memberPhoneNo">Phone No.*:</label>
			<input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="memberPhoneNo" 
			name="memberPhoneNo" size ="15" maxlength="20" value="'.$row[1].'"></p>
		
			
			<br><p><input id ="submit" type="submit" name="submit" value="Update"></p>
			<br><input type="hidden" name="id" value="'.$id.'"/>
			</form>';
	}
	else
	{ //if it didnt run
//message
echo '<p class="error". This page has been acessed in error<p>';
	}//end of it (result)
	mysqli_close($connect); //close the database connection_aborted
	
	?>
	</body>
	</html>
	
			