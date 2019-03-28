<?php
//creates a string containing html for a new stockItem div
//various tags have unique ids based on their corresponding data row's id
function createNewDiv($id,$name,$cost,$quantity)
{
  $newDiv = "";
  $newDiv.= '<div class = "stockItem" id = "div'.$id.'"> <ul>';
  $newDiv.= '<li>'.$name.'</li>';
  $newDiv.= '<li><input type = "text" class = "rowInput" value = "'.$cost.'"'.'id="cost'.$id.'"></li>';
  $newDiv.= '<li> <button class="minus" onclick="minusValue(';
  $newDiv.= "'quant".$id."')".'">-</button>';
  $newDiv.= '<input type = "text" class = "rowInput" value = "'.$quantity.'"'.'id="quant'.$id.'">';
  $newDiv.= '<button class="plus" onclick="addValue(';
  $newDiv.= "'quant".$id."')".'">+</button></li>';
  $newDiv.= '<li><button class="saveButton" id="'.$id.'">Save Changes</button></li>';
  $newDiv.= '<li><button class ="deleteButton" id="del'.$id.'">X</button></li>';
  $newDiv.= '</ul></div>';

  return $newDiv;
}
?>
