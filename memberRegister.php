<html>
<head>
<title>BananaBro Ordering System</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
//call file to connect server eleave

include ("BananaBro-header.php");
?>

<?php
//This query inserts a record in the eLeave table
//has form been submited?
if($_SERVER['REQUEST_METHOD']=='POST')

{
	$error = array (); //initialize an error array
	//check for a adminPassword
if (empty ($_POST ['memberPassword']))
{
	$error [] = 'You forgot to enter the password.';
}
else
{
	$p = mysqli_real_escape_string ($connect, trim ($_POST ['memberPassword']));
}

//check for a adminName
if (empty ($_POST ['memberName']))
{
	$error [] = 'You forgot to enter your name.';
}
else
{
	$n = mysqli_real_escape_string ($connect, trim ($_POST ['memberName']));
}

//check for a adminPhoneNo
if (empty ($_POST ['memberPhoneNo']))
{
	$error [] = 'You forgot to enter your phone number.';
}
else
{
	$ph = mysqli_real_escape_string ($connect, trim ($_POST ['memberPhoneNo']));
}



//register the admin in the database
//make the query:
$q = "INSERT INTO membership (memberID, memberPassword, memberName, memberPhoneNo)
	VALUES ('', '$p', '$n', '$ph')";
	$result = @mysqli_query ($connect, $q); //run the query
	if ($result) //if it runs
	{
		
		echo '<script>alert("Now you are a member!");
				window.location.href="memberLogin.php";</script>';
		
		
		
	}
	
	else{
		//if it didnt run//massage
		echo '<h1>System error<h1>';
		
		//debugging message
		echo '<p>' .mysqli_error($connect). '<br><br>Query: '.$q. '</p>';
	}//end of it (result)
	mysqli_close($connect); //close the databse connection_aborted
	exit();
}

//end of the main submit conditional
?>

<img src="online.png" width="168" height="95" alt="bananabro"/>
<div class="adminLogin">

<center>
<h2> REGISTER NEW MEMBER</h2>
<h4> *required field </h4><br>
<form action="memberRegister.php" method="post">
<div>
<label for="memberPassword">Password:</label>
<input type="password" id="memberPassword" name="memberPassword" size="15" maxlength="60"
pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required
value="<?php if (isset($_POST['memberPassword'])) echo $_POST ['memberPassword'];?>">
</div><br>

<div>
<label for="adminName">Member Name*:</label>
<input type="text" id="memberName" name="memberName" size="14" maxlength="50" required
value="<?php if (isset($_POST['memberName'])) echo $_POST ['memberName'];?>">
</div><br>

<div>
<label for="adminPhoneNo">Phone No*:</label>
<input type="tel" pattern="[0-9]{3}-[0-9]{7}" id="memberPhoneNo" name="memberPhoneNo" size="15" maxlength="20" required
value="<?php if (isset($_POST['memberPhoneNo'])) echo $_POST ['memberPhoneNo'];?>">
</div><br>

<div>
<button type="submit">Register</button>
<button type="reset">Clear All</button>
</div>
<center>
</div>
</form>
</body>
</html>
		