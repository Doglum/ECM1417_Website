//handles the minus button for stock quantity
function minusValue(elementID){
  var box = document.getElementById(elementID);
  var newVal = parseInt(box.value);
  newVal -= 1;
  if (newVal<0){
    return;
  }
  box.value = newVal;
  box.style.color = "red";
}

//handles the add button for stock quantity
function addValue(elementID){
  var box = document.getElementById(elementID);
  var newVal = parseInt(box.value);
  newVal += 1;
  box.value = newVal;
  box.style.color = "red";
}

//sets an invisible form to be displayed, used for new item form
function showForm(elementID){
  var toDisplay = document.getElementById(elementID);
  toDisplay.style.display = "block";
}

//sets a visible form to be hidden, used for row deletion
function hideForm(elementID){
  var toDisplay = document.getElementById(elementID);
  toDisplay.style.display = "none";
}

//toggles visibility
function toggleVis(elementID){
  var toDisplay = document.getElementById(elementID);
  if(!(toDisplay.style.display === "none")){
    hideForm(elementID);
  }
  else {
    showForm(elementID);
  }
}

//ajax for entry form
$(document).ready(function() {
  $("#entrySub").on("click",(function(e) {
    //prevents refresh/page switch
    e.preventDefault();
    //gets values for validation and error msg element
    var gameCost = document.forms["entryForm"]["gameCost"].value;
    var gameQuantity = document.forms["entryForm"]["gameQuantity"].value;
    var errorMessage = document.getElementById("newEntrySubmitFailure");
    var success = true;
    errorMessage.innerHTML = "";
    //checks if the entered values are valid numbers
    if (isNaN(gameCost)){
      errorMessage.innerHTML += "Cost must be a number ";
      return;
    }
    if (isNaN(gameQuantity)){
      errorMessage.innerHTML += "Quantity must be number ";
      return;
    }

    $.ajax( {
      url: "newEntry.php",
      type: "POST",
      dataType: "JSON",
      data: $("form").serialize(),
      dataType: "text",
      success: function(data){
        //gives confirmation msg and adds new div
        alert("Successfully Added");
        var theBody = document.getElementsByTagName("body")[0];
        theBody.insertAdjacentHTML('beforeend',data);

        //resets forms inputs
        document.getElementById("costEntry").value= "";
        document.getElementById("quantEntry").value= "";
        document.getElementById("nameEntry").value= "";

        //following functions assign events to dynamically created elements
        $(".saveButton").on('click', function(e){
          saveClickEvent(e);
        });

        $(".deleteButton").on("click",function(e){
          deleteClickEvent(e);
        });

        $(".rowInput").on("input",function(e){
          inputChangeEvent(e);
        });
      },
      error: function(xhr){
        alert(xhr.status);
      }
    });
  }));

  //function used by save click event handler
  function saveClickEvent(e)
  {
    e.stopPropagation();
    e.stopImmediatePropagation();
    var rowID = e.target.id;
    var rowCostBox = document.getElementById("cost"+rowID)
    var rowCost = rowCostBox.value;
    var rowQuantBox = document.getElementById("quant"+rowID)
    var rowQuant = rowQuantBox.value;

    //validates as number
    if(isNaN(rowCost)){
      alert("Cost must be a number");
      return;
    }
    if(isNaN(rowQuant)){
      alert("Quantity must be a number");
      return;
    }
    //converts to numbers, 2 decimal place float and integer
    rowCost = + parseFloat(rowCost).toFixed(2);
    rowQuant = parseInt(rowQuant);
    //checks non-negative
    if(rowCost<0 || rowQuant<0){
      alert("Cannot enter negative values");
      return;
    }
    //ajax for saving result of a row
    $.ajax({
      type: "POST",
      url: 'editRow.php',
      data: {editCost: rowCost, editQuantity: rowQuant, editID: rowID},
      success: function(data){
        //send confirmation msg and marks boxes as saved
        alert(data);
        rowCostBox.style.color = "black";
        rowQuantBox.style.color = "black";
      },
      error: function(xhr){
        alert(xhr.status);
      }
    });
  }
  //handles saving changes to a row
  $(".saveButton").on('click', function(e){
    saveClickEvent(e);
  });

  //function used by input change event
  function inputChangeEvent(e){
    var changedBox = e.target;
    changedBox.style.color = "red";
  }
  //upon a change in an entry, mark the box red to indicate unsaved change
  $(".rowInput").on("input",function(e){
    inputChangeEvent(e);
  });

  //function used by delete click event handler
  function deleteClickEvent(e){
    e.stopPropagation();
    e.stopImmediatePropagation();
    var delID = e.target.id.split("del")[1]; //gets record's id
    if(confirm("Are you sure you want to delete this record?")){
      $.ajax({
        type: "POST",
        url: "deleteRow.php",
        data: {IDtoDelete: delID},
        success: function(data){
          alert(data);
          hideForm("div"+delID);
        }
      })
    }
  }
  //handles record deletion upon clicking X button
  $(".deleteButton").on("click",function(e){
    deleteClickEvent(e);
  });
});
