<!DOCTYPE html>
<html>
<head>
	<title>Бележки</title>
</head>
<body>
	<?php
	include 'functions-for-indexed.php';
	include 'header.php';
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
	<div class="col-sm-10">
		<form class="form-horizontal" method="POST" action="notes-form.php">
			<?php for ($i = 0; $i < $notes; $i++) { ?>
				<fieldset>
					<legend>Бележка <?php if ($notes > 1) echo $i + 1; ?></legend>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-4">
							<textarea class="form-control" name="note[]"><?php echo get_input("note", $i); ?></textarea>	
						</div>
						<span class="col-sm-5"><?php echo get_err("note", $i); ?></span>
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