<?php
  require("connection.php");
  $IDtoDelete = mysqli_real_escape_string($conn,$_REQUEST["IDtoDelete"]);
  $sql = "DELETE FROM Stocks WHERE id ='$IDtoDelete'";
  if (mysqli_query($conn,$sql)){
    echo "Successfully deleted";
  }
?>
