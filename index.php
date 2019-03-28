<?php
session_start();
//if not logged in, send to login and kill session
if(!isset($_SESSION['username'])){
  header("location: login.php");
  die();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Stock System</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
  <!-- Using jQuery for easier AJAX -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
  <script src="functions.js"></script>
  </head>
  <body>
  <!--Menu item with a button to display new item entry form-->
  <div class = "header">
    <button class = "menu" onclick = "toggleVis('newItem')">Add New Item</button>
  </div>

  <!--Form for new data entry-->
  <div class = "itemEntry" id = "newItem" style = "display: none;">
    <form name = "entryForm" id = "entryForm">
      <label><b>Game's Name</b></label>
      <input type = "text" id="nameEntry" placeholder="Enter Name" name="gameName" required>
      <label><b>Game's Cost</b></label>
      <input type = "text" id="costEntry" placeholder="Enter Cost" name="gameCost" required>
      <label><b>Quantity in Stock</b></label>
      <input type = "text" id ="quantEntry" placeholder="Enter Quantity" name="gameQuantity" required>
      <button type = "submit" id = "entrySub">Add New Item</button>
      <span class = "errorMessage" id = "newEntrySubmitFailure"></span>
    </form>
  </div>

  <!--Label for rest of the items-->
	<div class = "stockItem">
    <ul>
      <li>Game Name</li>
      <li>Cost (£)</li>
      <li>Quantity</li>
      <li></li>
      <li></li>
    </ul>
	</div>
  <!---Fetches initial data for display-->
  <?php include "dataLoad.php";?>
  </body>
</html>
