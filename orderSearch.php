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
<form action="orderFound.php" method="post">

<h1>Search Buyer Record</h1>
<p><label class="label" for="name">Buyer Name:</label>
<input id="name" type="text" name="name" size="30"
maxlength="50" value="<?php if (isset($_POST['name']))
	echo $_POST ['name']; ?>"/></p>

<input id = "submit" type="submit" name="submit" value="search"/></p>
</form>
<center>
</body>
</html>