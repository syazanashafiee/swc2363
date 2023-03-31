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
<form action="memberFound.php" method="post">

<h1>Search Member Record</h1>
<p><label class="label" for="memberName">Member Name:</label>
<input id="memberName" type="text" name="memberName" size="30"
maxlength="50" value="<?php if (isset($_POST['memberName']))
	echo $_POST ['memberName']; ?>"/></p>

<input id = "submit" type="submit" name="submit" value="search"/></p>
</form>
<center>
</body>
</html>