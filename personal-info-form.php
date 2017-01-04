<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Лични данни</title>
</head>
<body>
	<?php
	include 'header.php';
	include 'functions.php';
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$valid = True;
		foreach ($_POST as $field => &$value) {
			$valid = validate($field, $value) && $valid;
		}
		unset($value);
		if ($valid) {
			$_SESSION["user"] = True;
			foreach ($_POST as $field => $value) {
				$_SESSION[$field] = $value;
			}
			unset($value);
			header("Location: addresses-form.php");
		}
	}
	?>
	<div class="col-sm-10">
		<form class="form-horizontal" method="POST" action="personal-info-form.php">
			<fieldset>
				<legend>Лични данни</legend>
				<div class="form-group">
					<label class="control-label col-sm-3" for="fName">Лично име *</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="fName" value=<?php echo '"', get_input("fName"), '"'; ?> >
					</div>
					<span class="col-sm-5"><?php echo get_err("fName"); ?></span>		
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="mName">Бащино име</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="mName" value=<?php echo '"', get_input("mName"), '"'; ?> >	
					</div>
					<span class="col-sm-5"><?php echo get_err("mName"); ?></span>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="lName">Фамилно име *</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="lName" value=<?php echo '"', get_input("lName"), '"'; ?> >	
					</div>
					<span class="col-sm-5"><?php echo get_err("lName"); ?></span>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="usrnm">Потребителско име *</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="usrnm" value=<?php echo '"', get_input("usrnm"), '"'; ?> >
					</div>
					<span class="col-sm-5"><?php echo get_err("usrnm"); ?></span>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Електронна поща *</label>
					<div class="col-sm-4">
						<input class="form-control" type="text" name="email" value=<?php echo '"', get_input("email"), '"'; ?> >		
					</div>
					<span class="col-sm-5"><?php echo get_err("email"); ?></span>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="phNum">Телефон</label>	
					<div class="col-sm-4">
						<input class="form-control" type="text" name="phNum" value=<?php echo '"', get_input("phNum"), '"'; ?> >		
					</div>
					<span class="col-sm-5"><?php echo get_err("phNum"); ?></span>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Запис и:</label>
					<div class="col-sm-4">
						<input class="btn btn-default" type="submit" value="Продължи">
					</div>	
				</div>
			</fieldset>
		</form>
	</div>
</body>
</html>