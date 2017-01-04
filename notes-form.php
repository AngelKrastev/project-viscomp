<!DOCTYPE html>
<html>
<head>
	<title>Бележки</title>
</head>
<body>
	<?php
	include 'header.php';
	include 'functions.php';
	session_start();
	if (isset($_SESSION["note"])) {
		$notes = count($_SESSION["note"]);
	}
	else {
		$notes = 1;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$notes = count($_POST["note"]);
		$valid = True;
		foreach ($_POST as $field => &$value) {
			if ($field != "addButton") {
				for ($i = 0; $i < $notes; $i++) { 
					$valid = validate_i($field, $value[$i], $i) && $valid;
				}
			}
		}
		unset($value);
		if ($valid) {
			$_SESSION["notes"] = True;
			$_SESSION["note"] = $_POST["note"];
			if (isset($_POST["addButton"])) {
				$notes = count($_POST["note"]) + 1;
			}
			else {
				header("Location: save-and-display.php");
			}
		}	
	}
	?>
	<div class="col-sm-10">
		<form class="form-horizontal" method="POST" action="notes-form.php">
			<?php for ($i = 0; $i < $notes; $i++) { ?>
				<fieldset>
					<legend>Бележка <?php if ($notes > 1) echo $i + 1; ?></legend>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-4">
							<textarea class="form-control" rows="5" name="note[]"><?php echo get_input_i("note", $i); ?></textarea>	
						</div>
						<span class="col-sm-5"><?php echo get_err_i("note", $i); ?></span>
					</div>
				</fieldset>
			<?php } ?>
			<div class="form-group">
				<label class="control-label col-sm-3">Запис и:</label>
				<div class="col-sm-4">
					<input class="btn btn-default" type="submit" name="addButton" value="Допълнителна бележка">
					<input class="btn btn-default" type="submit" value="Край">		
				</div>	
			</div>
		</form>
	</div>
</body>
</html>