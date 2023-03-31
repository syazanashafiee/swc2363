<html>
<head>
<title>BananaBro Ordering System</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<img src="online.png" width="168" height="95" alt="bananabro"/>
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
	if (!empty($_POST['adminName']))
	{
		$n = mysqli_real_escape_string($connect, $_POST['adminName']);
	}
	else
	{
		$n = FALSE;
		echo '<p class = "error"> You forgot to enter your Name. </p>';
	}
	
	//validate the adminPassword
	if (!empty($_POST['adminPassword']))
	{
		$p = mysqli_real_escape_string($connect, $_POST['adminPassword']);
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
		
	$q = "SELECT adminID, adminPassword, adminName, adminPhoneNo, adminEmail
	FROM admin WHERE (adminName ='$n' AND adminPassword ='$p')";
	
	//run the query and assign it to the variable $result
	$result = mysqli_query ($connect, $q);
	
	//count the number of rows that match the adminName/adminPassword combination
	//if one database row (record) matches the input:
	if (@mysqli_num_rows ($result) ==1)
	{
		//start the session, fetch the record and insert the three values in an array
		session_start();
		$_SESSION = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		
		header('Location:AdminPage.html');
		
		
		
		//Cancel the rest of the script
		exit();
		
		mysqli_free_result($result);
		mysqli_close($connect);
		//no match was made
	}
	else
	{
		echo '<p class="error"> The adminName and adminPassword entered do not match our records
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
<div class="adminLogin">
<br>
<center>

<h1 align ="center"> ADMIN LOGIN</h1><br>

<form action="adminLogin.php" method="post">
<div>
<label for="adminId">ADMIN NAME:</label>
<input type="text" id="adminName" name="adminName" size="15" maxlength="50"
value="<?php if (isset($_POST['adminName'])) echo $_POST ['adminName'];?>">
</div>
<br><br>

<div>
<label for="adminPassword">PASSWORD:</label>
<input type="password" id="adminPassword" name="adminPassword" size="15" maxlength="60"
pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required
value="<?php if (isset($_POST['adminPassword'])) echo $_POST ['adminPassword'];?>">
</div>
<br><br>

<div>
<button type="submit">LOGIN</button>
<button type="reset">RESET</button>
</div>
<br><br>

<div>
<label>Don't have an account?<br>
<a href="adminRegister.php">SIGN UP NOW!</a>
</label>
</div>
</form>
</center>
</div>
</body>
</html>
		
	
	
	