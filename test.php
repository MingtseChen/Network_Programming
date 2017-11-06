<!DOCTYPE html>
<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "test";

   // Create connection
   $conn = new mysqli($servername, $username, $password,$dbname);

   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   session_start();
   //init session
   $_SESSION["data"] = "";

   if(isset($_POST['submit']))
   {
        $query = "INSERT INTO `gb` (`id`, `content`) VALUES (NULL, '" . $_POST['text'] . "')";
        $result = $conn->query($query);
   }

   ?>
<html>
   <head>
      <meta charset="utf-8">
      <title>test</title>
   </head>
   <body>
      <form method="post">
         <textarea name="text"></textarea>
         <input type="submit" name="submit" value="submit"/>
      </form>
      <br/>
      <?php
         $query = "SELECT id, content FROM gb";
         $results = $conn->query($query);
         ?>
      <table border="1">
         <?php
            foreach ($results as $result) {
              echo "<tr><td>";
              echo $result['content'];
              echo "</td></tr>";
            }
             ?>
      </table>
   </body>
</html>
