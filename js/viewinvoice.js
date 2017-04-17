//View Invoice From String Passed through PHP $_POST
function viewInvoice(everything) {
    var invoiceNumber = everything.substring(0, everything.indexOf('*'));
    var invoiceNumberLength = invoiceNumber.toString().length;
    var current;
    var next;
    var end;
    
    // Get all div elements
    var status = document.getElementById('status');
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
    var rowLen;

    // Check to make sure string recieved through POST is valid
    if (everything.substring(invoiceNumberLength, 14 + invoiceNumberLength) 
            == "**everything**") {
        status.innerHTML = "Invoice Loaded Successfully";

        // Parse Through String to populate form viewing
        current = 15 //Readjust current index
        end = everything.indexOf("**end**", current); //Find End Index
        current = end + 7; //Account for end index marker

        header.innerHTML = "Invoice #" + invoiceNumber;
                ;

        for (i = 0; i < 4; i++) {
            end = everything.indexOf("**end**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                addresses[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        current += 7;

        for (i = 0; i < 3; i++) {
            end = everything.indexOf("**end**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                titles[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        current += 7;

        // Update Correct Number of Rows
        end = everything.indexOf("**end**", current);
        rowLen = everything.substring(current, end);
        var rowsCurrent = 1;
        while (rowsCurrent < rowLen) {
            rowsCurrent++;

            var x = document.getElementById('items').insertRow(rowsCurrent);

            x.setAttribute("class", "item-row");

            var itemRow = (x.insertCell(0));
            itemRow.innerHTML = '<div class="nameitem">NULL</div>';

            var descriptionRow = x.insertCell(1);
            descriptionRow.setAttribute("class", "description");
            descriptionRow.innerHTML = '<div class="namedescription">\n\
                                            NULL</div>';

            var unitRow = x.insertCell(2);
            unitRow.innerHTML = '<div class="cost">NULL</div>';

            var quantityRow = x.insertCell(3);
            quantityRow.innerHTML = '<div class="qty">NULL</div>';

            var priceRow = x.insertCell(4);
            priceRow.innerHTML = '<div class="price">NULL</div>';
        }
        current += 8;

        end = everything.indexOf("**end**", current);
        invoice.innerHTML = "Invoice"; //Manually Set Invoice Out of Laziness
        current = end + 7;

        for (i = 0; i < rowLen; i++) {
            end = everything.indexOf("**end**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                items[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        current += 7;

        for (i = 0; i < rowLen; i++) {
            end = everything.indexOf("**end**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                descriptions[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        current += 7;

        for (i = 0; i < rowLen; i++) {
            end = everything.indexOf("**end**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                costs[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        current += 7;

        for (i = 0; i < rowLen; i++) {
            end = everything.indexOf("**end**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                qtys[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        current += 7;

        for (i = 0; i < rowLen; i++) {
            end = everything.indexOf("**end**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                prices[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        current += 7;

        for (i = 0; i < 3; i++) {
            end = everything.indexOf("**end**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                divTotals[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        current += 7;

        for (i = 0; i < 2; i++) {
            end = everything.indexOf("**fin**", current);
            next = everything.indexOf("**next**", current);
            if (end > next) {
                taTotals[i].innerHTML = everything.substring(current, next);
                current = next + 8;
            }
        }
        
     //Update status if invoice not correctly loaded from $Post data
    } else {
        status.innerHTML = "Error: Invoice Not Loaded Correctly";
        alert("Contact Admin at evanbonsignori@yahoo.com");
}
}

