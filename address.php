<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Адреси</title>
</head>
<body>
	<?php
		function valid_data ($inputName, &$data, $index, $pattern, $required = True) {
			$data = trim ($data);
			if (empty ($data) and $required) {
				$GLOBALS["errMsgs"][$inputName][$index] = "Задължително поле.";
				return False;
			}
			else {
				if (preg_match ($pattern, $data)) {
					return True;
				}
				else {
					$GLOBALS["errMsgs"][$inputName][$index] = "Невалиден запис.";
					return False;
				}
			}
		}
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
		if(isset($_SESSION["address1"])) {
			$addresses = count($_SESSION["address1"]);
		}
		else {
			$addresses = 1;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			foreach ($_POST["address1"] as $key => $value) {
				$validData = valid_data("address1", $value, $key, "/^[a-zA-Z0-9 ]*$/") && $validData;
			}
			foreach ($_POST["address2"] as $key => $value) {
				$validData = valid_data("address2", $value, $key, "/^[a-zA-Z0-9 ]*$/", False) && $validData;
			}
			foreach ($_POST["postcode"] as $key => $value) {
				$validData = valid_data("postcode", $value, $key, "/^[a-zA-Z0-9]*$/") && $validData;
			}
			foreach ($_POST["town"] as $key => $value) {
				$validData = valid_data("town", $value, $key, "/^[a-zA-Z ]*$/") && $validData;
			}
			foreach ($_POST["region"] as $key => $value) {
				$validData = valid_data("region", $value, $key, "/^[a-zA-Z ]*$/") && $validData;
			}
			foreach ($_POST["country"] as $key => $value) {
				$validData = valid_data("country", $value, $key, "/^[a-zA-Z ]*$/", False) && $validData;
			}
			if ($validData) {
				$_SESSION["address1"] = $_POST["address1"];
				$_SESSION["address2"] = $_POST["address2"];
				$_SESSION["postcode"] = $_POST["postcode"];
				$_SESSION["town"] = $_POST["town"];
				$_SESSION["region"] = $_POST["region"];
				$_SESSION["country"] = $_POST["country"];
				if (isset($_POST["addButton"])) {
					$addresses = count($_POST["address1"]) + 1;
				}
				else {
					header("Location: note.php");
				}
			}
			else {
				$addresses = count($_POST["address1"]);
			}
		}
	?>
	<h1>Добавяне на потребител</h1>
	<form method="POST" action="address.php">
		<?php
		for($i = 0; $i < $addresses; $i++) {
			if($addresses == 1) {
				$num = "";
			}
			else {
				$num = $i + 1;
			}
		?>
			<fieldset>
				<legend>Адрес<?php echo $num; ?></legend>

				<label for="address1">Адрес ред 1 *:</label>
				<input class="txtField" type="text" name="address1[]" value=<?php echo get_data("address1" , $i); ?> >
				<?php if (isset ($errMsgs["address1"][$i])) { echo $errMsgs["address1"][$i]; } ?><br>

				<label for="address2">Адрес ред 2:</label>
				<input class="txtField" type="text" name="address2[]" value=<?php echo get_data("address2" , $i); ?> >
				<?php if (isset ($errMsgs["address2"][$i])) { echo $errMsgs["address1"][$i]; } ?><br>

				<label for="postcode">Пощенски код *:</label>
				<input class="txtField" type="text" name="postcode[]" value=<?php echo get_data("postcode", $i); ?> >
				<?php if (isset ($errMsgs["postcode"][$i])) { echo $errMsgs["postcode"][$i]; } ?><br>

				<label for="town">Населено място *:</label>
				<input class="txtField" type="text" name="town[]" value=<?php echo get_data("town", $i); ?> >
				<?php if (isset ($errMsgs["town"][$i])) { echo $errMsgs["town"][$i]; } ?><br>

				<label for="region">Област *:</label>
				<input class="txtField" type="text" name="region[]" value=<?php echo get_data("region", $i); ?> >
				<?php if (isset ($errMsgs["region"][$i])) { echo $errMsgs["region"][$i]; } ?><br>

				<label for="country">Държава:</label>
				<input class="txtField" type="text" name="country[]" value=<?php echo get_data("country", $i); ?> >
				<?php if (isset ($errMsgs["country"][$i])) { echo $errMsgs["country"][$i]; } ?><br>
			</fieldset>
		<?php
		}
		?>
		<input class="subButton" type="submit" name="subButton" value="Продължаване">
		<input class="addButton" type="submit" name="addButton" value="Допълнителен адрес">
	</form>
</body>
</html>