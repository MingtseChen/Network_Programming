<!DOCTYPE html>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "test";

	// Create connection

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection

	if ($conn->connect_error)
		{
		die("Connection failed: " . $conn->connect_error);
		}

	session_start();

	// init session

	$_SESSION["content"] = "";

	if (isset($_POST['submit']) && $_POST["text"] != "")
		{
		$_SESSION["content"] = $_POST['text'];

		// $query = "INSERT INTO `gb` (`id`, `content`) VALUES (NULL, '" . $_POST['text'] . "')";
		// $result = $conn->query($query);

		}

	if (isset($_POST['store']) && $_POST["store"] != "")
		{
		$query = "INSERT INTO `gb` (`id`, `content`) VALUES (NULL, '" . $_POST['store'] . "')";
		$result = $conn->query($query);
		}

	?>
<html>
	<head>
		<meta charset="utf-8">
		<title>test</title>
	</head>
	<script
		src="https://code.jquery.com/jquery-2.2.4.js"
		integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
		crossorigin="anonymous"></script>
	<body>
		<form method="post">
			<textarea name="text"><?php
				if ($_SESSION["content"] != "") echo $_SESSION["content"]; ?></textarea>
			<input type="submit" name="submit" value="<?php
				if ($_SESSION["content"] != "") echo "edit";
				  else echo "submit"; ?>"/>
		</form>
		<br/>
		<?php
			$query = "SELECT id, content FROM gb";
			$results = $conn->query($query);
			?>
		<table border="1">
			<?php
				foreach($results as $result)
					{
					echo "<tr><td>";
					echo $result['content'];
					echo "</td></tr>";
					}

				?>
		</table>
	</body>
	<script>
		$(window).unload(function(){
			$.post("hw_1.php", { store: "<?php echo $_SESSION["content"] ?>" } );
		});
	</script>
</html>