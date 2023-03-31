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
//This section processes submission from the login form
//Check if the form has been submitted
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//validate the adminName
	if (!empty($_POST['memberName']))
	{
		$n = mysqli_real_escape_string($connect, $_POST['memberName']);
	}
	else
	{
		$n = FALSE;
		echo '<p class = "error"> You forgot to enter your Name. </p>';
	}
	
	//validate the adminPassword
	if (!empty($_POST['memberPassword']))
	{
		$p = mysqli_real_escape_string($connect, $_POST['memberPassword']);
	}
	else
	{
		$p = FALSE;
		echo '<p class = "error"> You forgot to enter your password. </p>';
	}
	
	//if no problems
	if($n && $p)
	{
		//Retrieve the adminID, adminPassword, adminName, adminPhoneNo, adminEmail
		
	$q = "SELECT memberID, memberPassword, memberName, memberPhoneNo
	FROM membership WHERE (memberName ='$n' AND memberPassword ='$p')";
	
	//run the query and assign it to the variable $result
	$result = mysqli_query ($connect, $q);
	
	//count the number of rows that match the memberName/adminPassword combination
	//if one database row (record) matches the input:
	if (@mysqli_num_rows ($result) ==1)
	{
		//start the session, fetch the record and insert the three values in an array
		session_start();
		$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		header('Location:checkout.php');
		
		
		//Cancel the rest of the script
		exit();
		
		mysqli_free_result($result);
		mysqli_close($connect);
		//no match was made
	}
	else
	{
		echo '<p class="error"> The memberName and memberPassword entered do not match our records
		<br> perhaps you need to register, just click the Register button</p>';
	}
	
	//if there was a problems
	}
	else
	{
		echo '<p class ="error"> Please try again.</p>';
	}
	
	mysqli_close($connect);
}
//end of submit conditional
?>

<img src="online.png" width="168" height="95" alt="bananabro"/>
<div class="adminLogin">

<center>
<h2> Are You A Member?<br> If Yes Please Fill In</h2><br>


<form action="memberLogin.php" method="post">
<div>
<label for="memberName">Member Name:</label>
<input type="text" id="memberName" name="memberName" size="18" maxlength="50"
value="<?php if (isset($_POST['memberName'])) echo $_POST ['memberName'];?>">
</div><br>

<div>
<label for="memberPassword">Password:</label>
<input type="password" id="memberPassword" name="memberPassword" size="18" maxlength="60"
pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required
value="<?php if (isset($_POST['memberPassword'])) echo $_POST ['memberPassword'];?>">
</div><br>

<div>
<button type="submit">Login</button>
<button type="reset">Reset</button>
</div><br>

<div>
<label>SIGN UP NOW TO BE A MEMBER!
<a href="memberRegister.php">Sign up</a>
</label>
</div>
<center>
</div>

</form>
</body>
</html>
		
	
	
	