<?php
  require("connection.php");
  $editCost = mysqli_real_escape_string($conn,$_REQUEST["editCost"]);
  $editQuantity = mysqli_real_escape_string($conn,$_REQUEST["editQuantity"]);
  $editID = mysqli_real_escape_string($conn,$_REQUEST["editID"]);

  $sql = "UPDATE Stocks
  SET cost = '$editCost', quantity = '$editQuantity'
  WHERE id='$editID';";

  if (mysqli_query($conn,$sql)){
    echo "Updated cost to £".$editCost.", quantity to ".$editQuantity;
  }
?>
