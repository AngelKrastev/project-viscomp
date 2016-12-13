<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<title>Лични Данни</title>
</head>
<body>
	<?php
		function valid_data($inputName, $pattern, $required = True) {
			$_POST[$inputName] = trim($_POST[$inputName]);
			if (empty($_POST[$inputName]) && $required) {
				$GLOBALS["errMsgs"][$inputName] = "Empty";
				return False;
			}
			else {
				if(preg_match($pattern, $_POST[$inputName])) {
					return True;
				}
				else {
					$GLOBALS["errMsgs"][$inputName] = "Invalid";
					return False;
				}
			}
		}
		function get_data ($inputName) {
			if (isset ($_POST[$inputName])) {
				return $_POST[$inputName];
			}
			else if (isset ($_SESSION[$inputName])) {
				return $_SESSION[$inputName];
			}
			else {
				return "";
			}
		}
		session_start();
		$errMsgs;
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if (valid_data("fName", "/^[a-zA-Z]*$/")
				&& valid_data("mName", "/^[a-zA-Z]*$/", False)
				&& valid_data("fName", "/^[a-zA-Z]*$/")
				&& valid_data("username", "/^\w*$/")
				&& filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
				&& valid_data("phoneNum", "/^\d*$/", False)) {
					$_SESSION["fName"] = $_POST["fName"];
					$_SESSION["mName"] = $_POST["mName"];
					$_SESSION["lName"] = $_POST["lName"];
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["email"] = $_POST["email"];
					$_SESSION["phoneNum"] = $_POST["phoneNum"];
			}
			/*$mName = trim($_POST["mName"]);
			$mNameValid = False;
			if(preg_match("/^[a-zA-Z]*$/", $mName)) {
				$mNameValid = True;
			}
			else {
				$mNameErrMsg = "Невалидно бащино име.(a-z,A-Z)";
			}

			$lName = trim($_POST["lName"]);
			$lNameValid = False;
			if(empty($lName)) {
				$lNameErrMsg = "Задължително поле.";
			}
			else {
				if(preg_match("/^[a-zA-Z]*$/", $lName)) {
					$lNameValid = True;
				}
				else {
					$lNameErrMsg = "Невалидно фамилно име.(a-z,A-Z)";
				}
			}

			$username = trim($_POST["username"]);
			$unameValid = False;
			if(empty($username)) {
				$unameErrMsg = "Задължително поле.";
			}
			else {
				if(preg_match("/^\w*$/", $username)) {
					$unameValid = True;
				}
				else {
					$unameErrMsg = "Невалидно потребителско име.(a-z,A-Z,0-9,_)";
				}
			}
			
			$email = $_POST["email"];
			$emailValid = False;
			if(empty($email)) {
				$emailErrMsg = "Задължително поле.";
			}
			else {
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$emailValid = True;
				}
				else {
					$emailErrMsg = "Невалидна електронна поща.";
				}
			}

			$phoneNum = $_POST["phoneNum"];
			$phNumValid = False;
			if(preg_match("/^\d*$/", $phoneNum)) {
				$phNumValid = True;
			}
			else {
				$phNumErrMsg = "Невалиден телефонен нормер.";
			}

			if($fNameValid and $mNameValid and $lNameValid and $unameValid and $emailValid and $phNumValid) {
				$_SESSION["fName"] = $fName;
				$_SESSION["mName"] = $mName;
				$_SESSION["lName"] = $lName;
				$_SESSION["username"] = $username;
				$_SESSION["email"] = $email;
				$_SESSION["phoneNum"] = $phoneNum;
				header("Location: address.php");
			}*/
		}
		else {
			if(isset($_SESSION["fName"])) {
				$fName = $_SESSION["fName"];
			}
			if(isset($_SESSION["mName"])) {
				$mName = $_SESSION["mName"];
			}
			if(isset($_SESSION["lName"])) {
				$lName = $_SESSION["lName"];
			}
			if(isset($_SESSION["username"])) {
				$username = $_SESSION["username"];
			}
			if(isset($_SESSION["email"])) {
				$email = $_SESSION["email"];	
			}
			if(isset($_SESSION["phoneNum"]))
				$phoneNum = $_SESSION["phoneNum"];
		}
	?>
	<h1>Добавяне на потребител</h1>
	<form method="POST" action="personal-info.php">
		<fieldset>
			<legend>Лични Данни</legend>
			
			<label for="fName">Лично име *:</label>
			<input class="txtField" type="text" name="fName" value=<?php echo get_data("fName"); ?> >
			<?php if(isset($errMsgs["fName"])) { echo $errMsgs["fName"]; } ?> <br>
			
			<label for="mName">Бащино име:</label>
			<input class="txtField" type="text" name="mName" value=<?php echo get_data("mName"); ?> >
			<?php if(isset($errMsgs["fName"])) { echo $errMsgs["fName"]; } ?> <br>
			
			<label for="lName">Фамилно име *:</label>
			<input class="txtField" type="text" name="lName" value=<?php echo get_data("lName"); ?> >
			<?php if(isset($errMsgs["fName"])) { echo $errMsgs["fName"]; } ?> <br>
			
			<label for="username">Потребителско име *:</label>
			<input class="txtField" type="text" name="username" value=<?php echo get_data("username"); ?> >
			<?php if(isset($errMsgs["fName"])) { echo $errMsgs["fName"]; } ?> <br>
			
			<label for="email">Електронна поща *:</label>
			<input class="txtField" type="text" name="email" value=<?php echo get_data("email"); ?> >
			<?php if(isset($errMsgs["fName"])) { echo $errMsgs["fName"]; } ?> <br>
			
			<label for="phoneNum">Телефонен номер:</label>
			<input class="txtField" type="text" name="phoneNum" value=<?php echo get_data("phoneNum") ?> >
			<?php if(isset($errMsgs["fName"])) { echo $errMsgs["fName"]; } ?> <br>
		</fieldset>
		<input class="subButton" type="submit" value="Продължаване">
	</form>
</body>
</html>