<?php
$pattern = array(
	'fName' => '/^[\p{L}]+$/u', 'mName' => '/^[\p{L}]*$/u', 'lName' => '/^[\p{L}]+$/u', 'usrnm' => '/^[\p{L}\d_]+$/u', 'email' =>'/^[a-zA-Z0-9_]+@[a-zA-Z]+\.[a-zA-Z]+$/', 'phNum' => '/^\d*$/',
	'address1' => '/^[\p{L}\d ]+$/u', 'address2' => '/^[\p{L}\d ]*$/u', 'postcode' => '/^[\d]+$/', 'town' => '/^[\p{L} ]+$/u', 'region' => '/^[\p{L} ]+$/u', 'country' => '/^[\p{L} ]*$/u',
	'note' => "/.+/");
$errMsg;
function validate($field, &$value) {
	$value = trim($value);
	if (preg_match($GLOBALS["pattern"][$field], $value)) {
		return True;
	}
	else {
		if (empty($value)) {
			$GLOBALS["errMsg"][$field] = "Задължително поле";
		}
		else {
			$GLOBALS["errMsg"][$field] = "Невалиден запис";
		}
		return False;
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
function validate_i($field, &$value ,$index) {
	$value = trim($value);
	if (preg_match($GLOBALS["pattern"][$field], $value)) {
		return True;
	}
	else {
		if (empty($value)) {
			$GLOBALS["errMsg"][$field][$index] = "Задължително поле";
		}
		else {
			$GLOBALS["errMsg"][$field][$index] = "Невалиден запис";	
		}
		return False;
	}
}
function get_input_i($field, $index) {
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
function get_err_i($field, $index) {
	if (isset($GLOBALS["errMsg"][$field][$index])) {
		return $GLOBALS["errMsg"][$field][$index];
	}
	else {
		return "";
	}
}
?>