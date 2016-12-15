<!DOCTYPE html>
<html>
<head>
	<title>form3</title>
</head>
<body>
	<?php
	include 'functions_indexed.php';
	session_start();
	$required = array('note' => True);
	$pattern = array('note' => "//");
	$errMsg;
	if (isset($_SESSION["note"])) {
		$notes = count($_SESSION["note"]);
	}
	else {
		$notes = 1;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$notes = count($_POST["note"]);
		$valid = True;
		foreach (array_keys($_POST) as $field) {
			if ($field != "addButton") {
				for ($i = 0; $i < $notes; $i++) { 
					$valid = $valid && validate($field, $i);
				}
			}
		}
		if ($valid) {
			$_SESSION["note"] = $_POST["note"];
			if (isset($_POST["addButton"])) {
				$notes = count($_POST["note"]) + 1;
			}
			else {
				header("Location: test.php");
			}
		}	
	}
	?>
	<form method="POST" action="form3.php">
		<?php for ($i = 0; $i < $notes; $i++) { ?>
			<label for="note">Бележка <?php if ($notes > 1) echo $i + 1; ?></label>
			<textarea name="note[]"><?php echo get_input("note", $i); ?></textarea>
			<?php echo get_err("note", $i); ?><br>
		<?php } ?>
		<label for="addButton">Запис и:</label>
		<input type="submit" name="addButton" value="Допълнителна бележка">
		<input type="submit" value="Край">
	</form>
</body>
</html>