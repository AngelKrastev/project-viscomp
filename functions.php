<?php
function validate($field) {
	$_POST[$field] = trim($_POST[$field]);
	if (empty($_POST[$field]) && $GLOBALS["required"][$field]) {
		$GLOBALS["errMsg"][$field] = "Задължително поле";
		return False;
	}
	else {
		if (preg_match($GLOBALS["pattern"][$field], $_POST[$field])) {
			return True;
		}
		else {
			$GLOBALS["errMsg"][$field] = "Невалиден запис";
			return False;
			
		}
	}
}
function get_input($field) {
	if (isset ($_POST[$field])) {
		return $_POST[$field];
	}
	else if (isset ($_SESSION[$field])) {
		return $_SESSION[$field];
	}
	else {
		return "";
	}
}

function get_err($field) {
	if (isset($GLOBALS["errMsg"][$field])) {
		return $GLOBALS["errMsg"][$field];
	}
	else {
		return "";
	}
}
?>