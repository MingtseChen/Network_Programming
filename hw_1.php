<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$_SESSION["content"] = "";

if (isset($_POST['Submit']) && $_POST['text'] != "") {
    $_SESSION["content"] = $_POST['text'];
    $query = "INSERT INTO `gb` (`id`, `content`) VALUES (NULL, '" . $_SESSION['content'] . "')";
    if ($conn->query($query) === TRUE) {
        $_SESSION['last_id'] = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (isset($_POST['Revise'])) {
    $_SESSION["content"] = $_POST['text'];
    $query = "UPDATE gb SET content='" . $_POST['text'] . "' WHERE id=" . $_SESSION['last_id'];
    $conn->query($query);
}

?>
<html>
<head>
    <meta charset="utf-8">
    <title>test</title>
</head>
<body>
<form method="post">
    <textarea name="text" style="margin: 0px; width: 70%; height: 181px;"><?php echo $_SESSION["content"]; ?></textarea>
    <?php
    if ($_SESSION["content"] != "")
        echo "<input type=\"submit\" name=\"Revise\" value=\"Revise\"/>";
    else
        echo "<input type=\"submit\" name=\"Submit\" value=\"Submit\"/>";
    ?>
</form>
<br/>
<?php
$query = "SELECT id, content FROM gb";
$results = $conn->query($query);
$query2 = "SELECT id FROM gb WHERE content='hello world'";
$id = $conn->query($query2);
?>
<table border="1" width="70%">
    <?php
    foreach ($results as $result) {
        echo "<tr><td>";
        echo $result['content'];
        echo "</td></tr>";
    }
    $conn->close();
    ?>
</table>
</body>
</html>