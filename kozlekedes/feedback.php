<?php 
include_once "header.php";
include "./database/connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $name = $_POST['name'];
  $date = $_POST['date'];
  $comment = $_POST['comment'];

  $sql = "INSERT INTO feedback (name, date, comment)
  VALUES ('$name', '$date', '$comment')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>
<body>
  <main>
    <div class="feedbacktext">
      <h2>Visszajelzés</h2>
        <form action="" method="post">
          <input type="text" name="name" placeholder="Az utca neve">
          <input type="date" name="date"><br><br>
          <textarea name="comment" placeholder="Megjegyzés" rows="10" cols="60"></textarea><br><br>
          <input type="submit" name="submit" value="Beküldés" >
        </form>
        <?php
          $sql = "SELECT id, name, date, comment FROM feedback";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            echo "<table><tr><th>Utca név</th><th>Dátum</th><th>Megjegyzés</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "</td><td>" . $row["name"]. "</td><td>" . $row["date"]. "</td><td>" . $row["comment"]. "</td></tr>";
            }
            echo "</table>";
          } else {
            echo "0 results";
          }
          $conn->close();
        ?>
    </div>

  </main>
<?php
include_once "footer.php";
?>