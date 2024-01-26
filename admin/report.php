<?php
    include '../config.php';
?>
<html>
	<head>
		<title>Invoice generator</title>
	</head>
	<body>
  Enter Bill No : 
		<form method='get' action='Bill No.php'>
			<input type='text' name='Bill_No' placeholder='Enter Bill No'>
			<input type='submit' value='Generate'>
		</form>
	</body>
</html>