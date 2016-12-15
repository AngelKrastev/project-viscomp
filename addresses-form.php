<!DOCTYPE html>
<html>
<head>
	<title>form2</title>
</head>
<body>
	<?php
	include 'functions_indexed.php';
	session_start();
	$required = array('address1' => True, 'address2' => False, 'postcode' => True, 'town' => True, 'region' => True, 'country' => False);
	$pattern = array('address1' => '/^[a-zA-Z0-9 ]*$/', 'address2' => '/^[a-zA-Z0-9 ]*$/', 'postcode' => '/^[a-zA-Z0-9]*$/',
					 'town' => '/^[a-zA-Z]*$/', 'region' => '/^[a-zA-Z]*$/', 'country' => '/^[a-zA-Z]*$/');
	$errMsg;
	if (isset($_SESSION["address1"])) {
		$addresses = count($_SESSION["address1"]);
	}
	else {
		$addresses = 1;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$addresses = count($_POST["address1"]);
		$valid = True;
		foreach (array_keys($_POST) as $field) {
			if ($field != "addButton") {
				for ($i = 0; $i < $addresses; $i++) { 
					$valid = validate($field, $i) && $valid;
				}
			}
		}
		if ($valid) {
			foreach ($_POST as $field => $value) {
				if ($field != "addButton") {
					$_SESSION[$field] = $value;
				}
			}
			if (isset($_POST["addButton"])) {
				$addresses++;
			}
			else {
				header("Location: form3.php");
			}
		}
	}
	?>
	<form method="POST" action="form2.php">
		<?php
		for ($i = 0; $i < $addresses; $i++) { 
		?>
			<fieldset>
				<legend>Адрес <?php if($addresses > 1) echo $i + 1; ?></legend>
				<label for="address1">Адрес ред 1 *</label>
				<input type="text" name="address1[]" value=<?php echo get_input("address1", $i) ?> >
				<?php echo get_err("address1", $i) ?><br>
				
				<label for="address2">Адрес ред 2</label>
				<input type="text" name="address2[]" value=<?php echo get_input("address2", $i) ?> >
				<?php echo get_err("address2", $i) ?><br>
				
				<label for="postcode">Пощенски код</label>
				<input type="text" name="postcode[]" value=<?php echo get_input("postcode", $i) ?> >
				<?php echo get_err("postcode", $i) ?><br>
				
				<label for="town">Населено място</label>
				<input type="text" name="town[]" value=<?php echo get_input("town", $i) ?> >
				<?php echo get_err("town", $i) ?><br>
				
				<label for="region">Област</label>
				<input type="text" name="region[]" value=<?php echo get_input("region", $i) ?> >
				<?php echo get_err("region", $i) ?><br>
				
				<label for="country">Държава</label>
				<input type="text" name="country[]" value=<?php echo get_input("country", $i) ?> >
				<?php echo get_err("country", $i) ?><br>
			</fieldset>
		<?php
		}
		?>
		<label>Запис и:</label>
		<input type="submit" name="addButton" value="Допълнителен адрес">
		<input type="submit" value="Продължи">
	</form>
</body>
</html>