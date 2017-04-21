//Declare Global Variables
var rowCount = 2;

//Set Date
document.getElementById("date").innerHTML = todaysDate();

//Function Formatting Today's Date
function todaysDate() {
    var now = new Date();
    var months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    var date = ((now.getDate() < 10) ? "0" : "") + now.getDate();
    function fourdigits(number) {
        return (number < 1000) ? number + 1900 : number;
    }
    var today = months[now.getMonth()] + " " + date + ", " + (fourdigits(now.getYear()));
    return today;
}

// Adds Row Populated with default innerHTML values 
function addRow() {
    rowCount++;

    var x = document.getElementById('items').insertRow(rowCount);
    x.setAttribute("class", "item-row");

    var itemRow = (x.insertCell(0));
    itemRow.innerHTML = '<div class="delete-parent">\n\
 <textarea class="nameitem" maxlength="60">Item Name</textarea>\n\
 <a class="delete" href="javascript:void(0)" onclick="deleteRow(this);" \n\
title="Remove row">X</a></div>';

    var descriptionRow = x.insertCell(1);
    descriptionRow.setAttribute("class", "description");
    descriptionRow.innerHTML = '<textarea class="namedescription" \n\
style="overflow:auto;" maxlength="500">Description</textarea>';

    var unitRow = x.insertCell(2);
    unitRow.innerHTML = '<textarea onkeyup="updateTotal()" maxlength="15" \n\
class="cost">$0.00</textarea>';

    var quantityRow = x.insertCell(3);
    quantityRow.innerHTML = '<textarea onkeyup="updateTotal()" maxlength="10"\n\
class="qty">0</textarea>';

    var priceRow = x.insertCell(4);
    priceRow.innerHTML = '<span class="price">$0.00</span>';

    updateTotal();
}

// Removes Row By Index
function deleteRow(element) {
    var rowNum = element.parentNode.parentNode.parentNode.rowIndex;
    document.getElementById("items").deleteRow(rowNum);
    rowCount--;
    updateTotal();
}

//Updates Values of total, subtotal, and balance due
function updateTotal() {
    var fixedPaid = 0;
    var fixedCost = 0;
    var subPrice = 0;
    var costs = document.getElementsByClassName("cost");
    var quantities = document.getElementsByClassName("qty");
    var prices = document.getElementsByClassName("price");
    var totalCosts = 0;

    for (var i = 0; i < rowCount; i++) {
        if ((costs[i].value)[0] == "$") {
            fixedCost = (costs[i].value).substr(1);
        } else if (costs[i].value != "") {
            fixedCost = parseInt(costs[i].value);
        } else {
            fixedCost = "notANumber"
        }

        if (isNaN(fixedCost) || isNaN(quantities[i].value) || quantities[i].value <= 0) {
            document.getElementById("due1").innerHTML = "Invalid";
            document.getElementById("due2").innerHTML = "Invalid";
            document.getElementById("subtotal").innerHTML = "Invalid";
            document.getElementById("totalamount").innerHTML = "Invalid";
            prices[i].innerHTML = "Invalid";
            return;
        }
        subPrice = fixedCost * quantities[i].value;
        prices[i].innerHTML = "$" + subPrice.toFixed(2);
        totalCosts += subPrice;
    }

    var tax = (document.getElementById("tax").value) * Math.pow(10, -2);
    var taxedCost = totalCosts + totalCosts * tax;

    var amountPaid = document.getElementById("paid").value;
    if (amountPaid[0] == "$") {
        fixedPaid = (amountPaid).substr(1);
    } else {
        fixedPaid = parseInt(amountPaid);
    }
    document.getElementById("subtotal").innerHTML = "$" + (totalCosts).toFixed(2);
    document.getElementById("totalamount").innerHTML = "$" + (taxedCost).toFixed(2);
    document.getElementById("due1").innerHTML = "$" + (taxedCost - fixedPaid).toFixed(2);
    document.getElementById("due2").innerHTML = "$" + (taxedCost - fixedPaid).toFixed(2);
}

// Clear Current Values
function resetValues() {
    var itemArr = document.getElementsByClassName('nameitem');
    var descriptionArr = document.getElementsByClassName('namedescription');
    var costArr = document.getElementsByClassName('cost');
    var qtyArr = document.getElementsByClassName('qty');
    var priceArr = document.getElementsByClassName('price');
    var rowLen = itemArr.length;

    for (var i = 0; i < rowLen; i++) {
        itemArr[i].value = "Item Name";
        descriptionArr[i].value = "Description";
        costArr[i].value = "$0";
        qtyArr[i].value = "0";
        priceArr[i].innerHTML = "$0";
    }
    updateTotal();
    document.getElementById("tax").value = "0";
    document.getElementById("paid").value = "$0";
}

//Generate Random Values to fill in all required forms
function generateRandom() {
    //Get Customer Information Tags
    var nameAddress = document.getElementById('nameAddress');
    var streetAddress = document.getElementById('streetAddress');
    var cspAddress = document.getElementById('cspAddress');
    var phoneAddress = document.getElementById('phoneAddress');
    var invoiceNum = document.getElementById('invoiceTitle');
     //Get Invoice Table Tags and number of rows
    var itemArr = document.getElementsByClassName('nameitem');
    var description = document.getElementsByClassName('namedescription');
    var costArr = document.getElementsByClassName('cost');
    var qtyArr = document.getElementsByClassName('qty');
    var rowLen = itemArr.length;
    
    //Randomize customer information
    nameAddress.value = randomString();
    streetAddress.value = randomMix();
    cspAddress.value = randomMix();
    phoneAddress.value = randomInt();  
    invoiceNum.value = randomInt();
    
    //Iterate through data rows and randomize
    for (var i = 0; i < rowLen; i++) {
        itemArr[i].value = randomString();
        description[i].value = randomString();
        costArr[i].value = randomInt();
        qtyArr[i].value = randomInt();
    }
    
    //Manually Set Tax and Paid to 0
    document.getElementById('tax').value = 0;
    document.getElementById('paid').value = 0;
    
    updateTotal()
}

//Function to generate random 10 charcter and numbered string
function randomMix()
{
    var text = "";
    var possible = 
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for(var i = 0; i < 10; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

//Function to generate random 15 charcter string
function randomString()
{
    var text = "";
    var possible = 
            "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    for(var i = 0; i < 10; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

//Function to generate random 5 digits
function randomInt()
{
    var text = "";
    var possible = 
            "0123456789";

    for(var i = 0; i < 10; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}