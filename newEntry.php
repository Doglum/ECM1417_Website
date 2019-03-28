<?php
  require("connection.php");
  require("helpers.php");
  $gameName = mysqli_real_escape_string($conn,$_REQUEST["gameName"]);
  $gameCost = mysqli_real_escape_string($conn,$_REQUEST["gameCost"]);
  $gameQuantity = mysqli_real_escape_string($conn,$_REQUEST["gameQuantity"]);

  $sql = "INSERT INTO Stocks (name,cost,quantity)
  VALUES ('$gameName','$gameCost','$gameQuantity')";

  if (mysqli_query($conn,$sql)){
    $id = $conn->insert_id;
    echo createNewDiv($id,$gameName,$gameCost,$gameQuantity);
  }
?>
