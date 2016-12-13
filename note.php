<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Бележки</title>
</head>
<body>
	<?php
		function get_data ($inputName, $index) {
			if (isset ($_POST[$inputName][$index])) {
				return $_POST[$inputName][$index];
			}
			else if (isset ($_SESSION[$inputName][$index])) {
				return $_SESSION[$inputName][$index];
			}
			else {
				return "";
			}
		}
		session_start();
		$validData = True; $errMsgs;
		if (isset($_SESSION["note"])) {
			$notes = count($_SESSION["note"]);
		}
		else {
			$notes = 1;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			foreach ($_POST["note"] as $key => $value) {
				if (empty($value)) {
					$validData = False;
					$errMsgs[$key] = "Задължително поле.";
				}
			}
			if ($validData) {
				$_SESSION["note"] = $_POST["note"];
				if (isset($_POST["addButton"])) {
					$notes = count($_POST["note"]) + 1;
				}
				else {
					header("Location: test.php");
				}
			}
			else {
				$notes = count($_POST["note"]);
			}
		}
	?>
	<h1>Добавяне на потребител</h1>
	<form method="POST" action="note.php">
		<?php
		for ($i = 0; $i < $notes; $i++) { 
			if ($notes == 1) {
				$num = "";
			}
			else {
				$num = $i + 1;
			}
		?>
			<label for="note">Бележка <?php echo $num; ?></label><br>
			<textarea name="note[]"><?php echo get_data("note", $i); ?></textarea>
			<?php if (isset($errMsgs[$i])) { echo $errMsgs[$i]; } ?><br>
		<?php
		}
		?>
		<input class="subButton" type="submit" name="subButton" value="Край">
		<input class="addButton" type="submit" name="addButton" value="Допълнителена бележка">
	</form>
</body>
</html>