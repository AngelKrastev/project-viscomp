<!DOCTYPE html>
<html>
<head>
	<title>form1</title>
</head>
<body>
	<?php
	include 'functions.php';
	session_start();
	$required = array('fName' => True, 'mName' => False, 'lName' => True, 'usrnm' => True, 'email' => True, 'phNum' => False);
	$pattern = array('fName' => '/^[a-zA-Z]*$/', 'mName' => '/^[a-zA-Z]*$/', 'lName' => '/^[a-zA-Z]*$/', 'usrnm' => '/^\w*$/', 'email' =>'/^[a-zA-Z0-9_]+@[a-zA-Z]+\.[a-zA-Z]+$/', 'phNum' => '/^\d*$/');
	$errMsg;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$valid = True;
		foreach (array_keys($_POST) as $field) {
			$valid = validate($field) && $valid;
		}
		if ($valid) {
			foreach ($_POST as $field => $value) {
				$_SESSION[$field] = $value;
			}
			header("Location: form2.php");
		}
	}
	?>
	<form method="POST" action="form1.php">
		<label for="fName">Лично име *</label>
		<input type="text" name="fName" value=<?php echo get_input("fName"); ?> >
		<?php echo get_err("fName"); ?><br>
		
		<label for="mName">Бащино име</label>
		<input type="text" name="mName" value=<?php echo get_input("mName"); ?> >
		<?php echo get_err("mName"); ?><br>
		
		<label for="lName">Фамилно име *</label>
		<input type="text" name="lName" value=<?php echo get_input("lName"); ?> >
		<?php echo get_err("lName"); ?><br>

		<label for="usrnm">Потребителско име *</label>
		<input type="text" name="usrnm" value=<?php echo get_input("usrnm"); ?> >
		<?php echo get_err("usrnm"); ?><br>

		<label for="email">Електронна поща *</label>
		<input type="text" name="email" value=<?php echo get_input("email"); ?> >
		<?php echo get_err("email"); ?><br>
		
		<label for="phNum">Телефон</label>
		<input type="text" name="phNum" value=<?php echo get_input("phNum"); ?> >
		<?php echo get_err("phNum"); ?><br>
		
		<input type="submit">
	</form>
</body>
</html>