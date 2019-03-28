<?php
require("connection.php");
require("helpers.php");

$sql = "SELECT * FROM Stocks";
$stocksResult = $conn->query($sql);
$table = array(); //push the tables data in here
if ($stocksResult->num_rows > 0) {
  // output data of each row
  while($row = $stocksResult->fetch_assoc()) {
    //appends row to table
    $table[] = array($row["ID"],$row["name"],$row["cost"],$row["quantity"]);
  }
}
$output = "";
for ($i = 0; $i < sizeof($table); $i++){
  $output.=createNewDiv($table[$i][0],$table[$i][1],$table[$i][2],$table[$i][3]);
}
echo $output;


?>
