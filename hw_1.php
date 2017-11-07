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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<body>
<div class="container">
    <h1>Guest Book</h1>
    <br/>
    <form method="post">
        <textarea name="text" class="form-control" rows="5"><?php echo $_SESSION["content"]; ?></textarea>
        <br/>
        <?php
        if ($_SESSION["content"] != "")
            echo "<button type=\"submit\" name=\"Revise\"  class='btn btn-primary'>Revise</button>";
        else
            echo "<button type=\"submit\" name=\"Submit\" class='btn btn-info'>Submit</button>";
        ?>
    </form>
    <br/>
    <?php
    $query = "SELECT id, content FROM gb";
    $results = $conn->query($query);
    $query2 = "SELECT id FROM gb WHERE content='hello world'";
    $id = $conn->query($query2);
    ?>
    <table class="table table-hover">
        <?php
        foreach ($results as $result) {
            echo "<tr><td>";
            echo $result['content'];
            echo "</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>
</body>
</html>