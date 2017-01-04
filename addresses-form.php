<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Адреси</title>
</head>
<body>
	<?php
	include 'header.php';
	include 'functions.php';
	session_start();
	if (isset($_SESSION["address1"])) {
		$addresses = count($_SESSION["address1"]);
	}
	else {
		$addresses = 1;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$addresses = count($_POST["address1"]);
		$valid = True;
		foreach ($_POST as $field => &$value) {
			if ($field != "addButton") {
				for ($i = 0; $i < $addresses; $i++) { 
					$valid = validate_i($field, $value[$i], $i) && $valid;
				}
			}
		}
		unset($value);
		if ($valid) {
			$_SESSION["addresses"] = True;
			foreach ($_POST as $field => &$value) {
				if ($field != "addButton") {
					$_SESSION[$field] = $value;
				}
			}
			unset($value);
			if (isset($_POST["addButton"])) {
				$addresses++;
			}
			else {
				header("Location: notes-form.php");
			}
		}
	}
	?>
	<div class="col-sm-10">
		<form class="form-horizontal" method="POST" action="addresses-form.php">
			<?php
			for ($i = 0; $i < $addresses; $i++) { 
			?>
				<fieldset>
					<legend>Адрес <?php if($addresses > 1) echo $i + 1; ?></legend>
					<div class="form-group">
						<label class="control-label col-sm-3" for="address1">Адрес ред 1 *</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="address1[]" value=<?php echo '"', get_input_i("address1", $i), '"'; ?> >		
						</div>
						<span class="col-sm-5"><?php echo get_err_i("address1", $i) ?></span>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="address2">Адрес ред 2</label>	
						<div class="col-sm-4">
							<input class="form-control" type="text" name="address2[]" value=<?php echo '"', get_input_i("address2", $i), '"'; ?> >		
						</div>
						<span class="col-sm-5"><?php echo get_err_i("address2", $i) ?></span>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="postcode">Пощенски код *</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="postcode[]" value=<?php echo '"', get_input_i("postcode", $i), '"'; ?> >		
						</div>
						<span class="col-sm-5"><?php echo get_err_i("postcode", $i) ?></span>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="town">Населено място *</label>	
						<div class="col-sm-4">
							<input class="form-control" type="text" name="town[]" value=<?php echo '"', get_input_i("town", $i), '"'; ?> >		
						</div>
						<span class="col-sm-5"><?php echo get_err_i("town", $i) ?></span>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="region">Област *</label>
						<div class="col-sm-4">
							<input class="form-control" type="text" name="region[]" value=<?php echo '"', get_input_i("region", $i), '"'; ?> >		
						</div>
						<span class="col-sm-5"><?php echo get_err_i("region", $i) ?></span>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="country">Държава</label>	
						<div class="col-sm-4">
							<input class="form-control" type="text" name="country[]" value=<?php echo '"', get_input_i("country", $i), '"'; ?> >		
						</div>
						<span class="col-sm-5"><?php echo get_err_i("country", $i) ?></span>
					</div>
				</fieldset>
			<?php
			}
			?>
			<div class="form-group">
				<label class="control-label col-sm-3">Запис и:</label>
				<div class="col-sm-4">
					<input class="btn btn-default" type="submit" name="addButton" value="Допълнителен адрес">		
					<input class="btn btn-default" type="submit" value="Продължи">		
				</div>
			</div>
			
			
			
		</form>
	</div>
</body>
</html>