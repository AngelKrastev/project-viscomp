<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Потребител</title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="col-sm-10">
	<?php
	session_start();
	if (isset($_SESSION["user"]) && $_SESSION["user"] === True && 
		isset($_SESSION["addresses"]) && $_SESSION["addresses"] === True && 
		isset($_SESSION["notes"]) && $_SESSION["notes"] === True) {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "phplab_course_project";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$sql = "INSERT INTO users (user_fname, user_mname, user_lname, user_login, user_email, user_phone)
				VALUES ('" . $_SESSION["fName"] . "', '" . $_SESSION["mName"] . "', '" . $_SESSION["lName"] . "',
						'" . $_SESSION["usrnm"] . "', '" . $_SESSION["email"] . "', '" . $_SESSION["phNum"] . "');";
		$conn->query($sql);
		$user_id = $conn->insert_id;
		foreach (array_keys($_SESSION["address1"]) as $index) {
			$sql = "INSERT INTO addresses (address_line_1, address_line_2, address_zip, address_city, address_province, address_country)
					VALUES ('" . $_SESSION["address1"][$index] . "', '" . $_SESSION["address2"][$index] . "', '" . $_SESSION["postcode"][$index] . "',
							'" . $_SESSION["town"][$index] . "', '" . $_SESSION["region"][$index] . "', '" . $_SESSION["country"][$index] . "');";
			$conn->query($sql);
			$sql = "INSERT INTO users_addresses (ua_user_id, ua_address_id)
			VALUES ('" . $user_id . "', '" . $conn->insert_id . "');";
			$conn->query($sql);
		}
		foreach (array_keys($_SESSION["note"]) as $index) {
			$sql = "INSERT INTO notes (note_user_id, note_text)
			VALUES ('" . $user_id . "', '" . $_SESSION["note"][$index] . "');";
			$conn->query($sql);
		}
		$_SESSION = array();
		$sql = "SELECT user_fname, user_mname, user_lname, user_login, user_email, user_phone
				FROM users WHERE user_id = " . $user_id . ";";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			?>
			<div class="col-sm-12">
			<span style="font-size: 30px">Лични данни</span><br>
			<?php
			while ($row = $result->fetch_assoc()) {
				?>
					<span class="col-sm-4">Лично име</span>
					<span class="col-sm-8"><?php echo $row["user_fname"]; ?></span><br>
					<span class="col-sm-4">Бащино име</span>
					<span class="col-sm-8"><?php if (empty($row["user_mname"])) echo "---"; else echo $row["user_mname"]; ?></span><br>
					<span class="col-sm-4">Фамилно име</span>
					<span class="col-sm-8"><?php echo $row["user_lname"]; ?></span><br>
					<span class="col-sm-4">Потребителско име</span>
					<span class="col-sm-8"><?php echo $row["user_login"]; ?></span><br>
					<span class="col-sm-4">Електронна поша</span>
					<span class="col-sm-8"><?php echo $row["user_email"]; ?></span><br>
					<span class="col-sm-4">Телефон</span>
					<span class="col-sm-8"><?php if (empty($row["user_phone"])) echo "---"; else echo $row["user_phone"]; ?></span><br>
				<?php
			}
			?>
			</div>
			<?php
		}
		$sql = "SELECT address_line_1, address_line_2, address_zip, address_city, address_province, address_country
				FROM addresses
				INNER JOIN users_addresses
				ON addresses.address_id = users_addresses.ua_address_id
				WHERE ua_user_id = " . $user_id . ";";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			?>
			<div class="col-sm-12">
			<span style="font-size: 30px">Адреси</span><br>
			<?php
			while ($row = $result->fetch_assoc()) {
				?>
				<div class="col-sm-3"">
					<?php echo $row["address_line_1"]; ?><br>
					<?php if (!empty($row["address_line_2"])) echo $row["address_line_2"]; ?><br>
					<?php echo $row["address_city"]; ?>
					<?php echo $row["address_zip"]; ?><br>
					<?php echo $row["address_province"]; ?><br>
					<?php if (!empty($row["address_country"])) echo $row["address_country"]; ?><br>
				</div>
				<?php
			}
			?>
			</div>
			<?php
		}
		$sql = "SELECT note_text
				FROM notes
				INNER JOIN users
				ON notes.note_user_id = users.user_id
				WHERE users.user_id = " . $user_id . ";";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			?>
			<div class="col-sm-12">
				<span style="font-size: 30px">Бележки</span><br>
			<?php
			while ($row = $result->fetch_assoc()) {
				?>
				<div class="col-sm-12">
					<?php echo $row["note_text"]; ?></span>
					<hr>
				</div>
			<?php
			}
			?>
			</div>
			<?php
		}
		$conn->close();
	}
	else {
		?>
		<span>Попълнените данни или са недостатъчни.</span>
		<?php
	}
	?>
	</div>
</body>
</html>