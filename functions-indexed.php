<?php
function validate($field, $index) {
	$_POST[$field][$index] = trim($_POST[$field][$index]);
	if (empty($_POST[$field][$index]) && $GLOBALS["required"][$field]) {
		$GLOBALS["errMsg"][$field][$index] = "Задължително поле";
		return False;
	}
	else {
		if (preg_match($GLOBALS["pattern"][$field], $_POST[$field][$index])) {
			return True;
		}
		else {
			$GLOBALS["errMsg"][$field][$index] = "Невалиден запис";
			return False;
		}
	}
}
function get_input($field, $index) {
	if (isset ($_POST[$field][$index])) {
		return $_POST[$field][$index];
	}
	else if (isset ($_SESSION[$field][$index])) {
		return $_SESSION[$field][$index];
	}
	else {
		return "";
	}	
}
function get_err($field, $index) {
	if (isset($GLOBALS["errMsg"][$field][$index])) {
		return $GLOBALS["errMsg"][$field][$index];
	}
	else {
		return "";
	}
}
?>