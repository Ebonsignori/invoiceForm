//Redirect User To New Window
function thankYou() {
  if (validationAll() == true) {
    var body = getEverything();
    document.getElementById("total").value = body;
    document.getElementById("hiddenform").submit();
  }
}

//Redirects to same thank you page as files, but submits different form
function thankYouDB() {
  if (windowValidation() == true) {
    var body = getEverything();
    document.getElementById('total-db').value = body;
    var title = document.getElementById("db-title-win").value;
    document.getElementById('title-db').value = title;
    var author = document.getElementById("db-author-win").value;
    document.getElementById("author-db").value = author;
    document.getElementById("hiddenform_db").submit();
  }
}

//Checks form validation and opens window to prompt for invoice title/author
function databaseWindow() {
  if (validationAll() == true) {
    openWindow();
  }
}

// TODO: Implement database validation
//Checks Validation of inoice title and author recieved from window prompt
function windowValidation() {
  return true;
}

//Checks Validation of all relevent fields. Returns true if function makes it to
//end without detecting a false entry from an HTML textarea element
function validationAll() {
  //Get Customer Information Tags
  var nameAddress = document.getElementById('nameAddress');
  var streetAddress = document.getElementById('streetAddress');
  var cspAddress = document.getElementById('cspAddress');
  var phoneAddress = document.getElementById('phoneAddress');
  //Get Invoice Information Tags
  var invoiceNum = document.getElementById('invoiceTitle');
  var date = document.getElementById('date');

  if (!nameAddress.value.match(/^[A-Za-z\s]+$/)) {
    alert("Please enter a valid name without numbers or special characters.");
    return false;
  } else if (!streetAddress.value.match(/^[A-Za-z0-9\s]+$/)) {
    alert("Please enter a street address without special characters.");
    return false;
  } else if (!cspAddress.value.match(/^[A-Za-z0-9\s]+$/)) {
    alert("Please enter a City, State, and Postal code without special characters.");
    return false;
  } else if (!phoneAddress.value.match(/^[0-9\s]+$/)) {
    alert("Please enter a phone number using only numbers");
    return false;
  } else if (!invoiceNum.value.match(/^[0-9]+$/)) {
    alert("Please only use numbers for Invoice Number.");
    return false;
  } else if (!date.value.match(/^[,A-Za-z0-9\s]+$/)) {
    alert("Please enter a valid date using letters, numbers, and commas.");
    return false;
  }

  //Get Invoice Table Tags and number of rows
  var itemArr = document.getElementsByClassName('nameitem');
  var description = document.getElementsByClassName('namedescription');
  var costArr = document.getElementsByClassName('cost');
  var qtyArr = document.getElementsByClassName('qty');
  var rowLen = itemArr.length;

  //Iterate through each row and validate each datafield
  for (var i = 0; i < rowLen; i++) {
    //Items can't be empty, default "item name" or contain parsing char '**'
    if (itemArr[i].value == "") {
      alert("Item in row #" + (i + 1) + " must be filled out.");
      return false;
    } else if ((itemArr[i].value) == "Item Name") {
      alert("Please name item in row #" + (i + 1) + ".");
      return false;
    } else if ((itemArr[i].value).indexOf('**') != -1) {
      alert("Invalid Symbol Usage in row #" + (i + 1) +
        "\n. Please Don't use '**'");
      return false;
    }

    //Description can't be empty, default "Description" or contain parsing char '**'
    if (description[i].value == "") {
      alert("Description in row #" + (i + 1) + " must be filled out.");
      return false;
    } else if (description[i].value == "Description") {
      alert("Please add a description in row #" + (i + 1) + ".");
      return false;
    } else if ((description[i].value).indexOf('**') != -1) {
      alert("Invalid Symbol Usage in row #" + (i + 1) +
        "\n. Please Don't use '**'");
      return false;
    }

    //Account for dollar sign in front of numeric data
    if ((costArr[i].value)[0] == "$") {
      fixedCost = (costArr[i].value).substr(1);
    } else {
      fixedCost = parseInt(costArr[i].value);
    }

    //Price must be a number greater than zero and not empty
    if (fixedCost == "") {
      alert("Cost in row #" + (i + 1) + " must be filled out.");
      return false;
    } else if (fixedCost <= 0) {
      alert("Cost in row #" + (i + 1) + " must be greater than zero.");
      return false;
    } else if (isNaN(fixedCost)) {
      alert("Cost in row #" + (i + 1) + " is not a number.");
      return false;
    }

    //Quantity must be a number greater than 0 and not empty
    if (qtyArr[i].value == "") {
      alert("Quantity in row #" + (i + 1) + " must be filled out.");
      return false;
    } else if ((qtyArr[i].value) <= 0) {
      alert("Quantity in row #" + (i + 1) + " must be greater than zero.");
      return false;
    } else if (isNaN(qtyArr[i].value)) {
      alert("Quantity in row #" + (i + 1) + " is not a number.");
      return false;
    }
  }
  return true;
}

//Combines all form data into one string and then sends it to server using a hidden form
function getEverything() {
  var everything = "**everything**"; //everything marks beginning

  var header = document.getElementById('header');
  var addresses = document.getElementsByClassName('address');
  var titles = document.getElementsByClassName('titles');
  var invoice = document.getElementById('invoice');
  var items = document.getElementsByClassName('nameitem');
  var descriptions = document.getElementsByClassName('namedescription');
  var costs = document.getElementsByClassName('cost');
  var qtys = document.getElementsByClassName('qty');
  var prices = document.getElementsByClassName('price');
  var divTotals = document.getElementsByClassName('totals'); //Div uses .innerHTML
  var taTotals = document.getElementsByClassName('sumTable'); //TextArea uses .value
  var rowLen = items.length;
  //'**end**' marks the ending of each group of elements in string
  everything += header.value + "**end**";

  //'**next**' marks the next element in the string
  for (i = 0; i < 4; i++) {
    everything += addresses[i].value + "**next**";
  }
  everything += "**end**";

  everything += titles[0].value + "**next**";
  everything += titles[1].value + "**next**";
  everything += titles[2].innerHTML + "**next**" + "**end**";

  everything += rowLen + "**end**";;

  everything += invoice.innerHTML + "**end**";

  for (i = 0; i < rowLen; i++) {
    everything += items[i].value + "**next**";
  }
  everything += "**end**";

  for (i = 0; i < rowLen; i++) {
    everything += descriptions[i].value + "**next**";
  }
  everything += "**end**";

  for (i = 0; i < rowLen; i++) {
    everything += costs[i].value + "**next**";
  }
  everything += "**end**";

  for (i = 0; i < rowLen; i++) {
    everything += qtys[i].value + "**next**";
  }
  everything += "**end**";

  for (i = 0; i < rowLen; i++) {
    everything += prices[i].innerHTML + "**next**";
  }
  everything += "**end**";

  for (i = 0; i < 3; i++) {
    everything += divTotals[i].innerHTML + "**next**";
  }
  everything += "**end**";

  everything += taTotals[0].value + "**next**";
  everything += taTotals[1].value + "**next**" + "**fin**"; //fin marks end
  //Return encoded string
  return everything;
}
