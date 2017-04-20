<!-- View Stored Invoice
HTML code is nearly identical to index.html with textarea tags replaced with
uneditable div tags. Content of div tags are read in from file stored on the server
and sent to this page using php. The content is processed in javaScript and inserted
into each HTML div tage.-->
<!DOCTYPE html>

<head>
    <title>Stored Invoice</title>
    <link rel='stylesheet' type='text/css' href='../css/main.css' />
</head>

<body onload="javascript:onLoad()">
    <!-- Wrapped just like index.html -->
    <div id="wrapper">
        <!--
        If unable to load from file or database, all values will be "NULL"
        -->
        <div id="header">NULL</div>

        <div id="identity">
            <div class="address" >NULL</div>
            </br>
            <div class="address" >NULL</div>
            </br>
            <div class="address" >NULL</div>
            </br>
            <div class="address" >NULL</div>
            </br>
            </br>
        </div>

        <div id="customer">

            <table class="tables">
                <tr>
                    <td class="title">Invoice #</td>
                    <td><div class="titles">NULL</div></td>
                </tr>
                <tr>

                    <td class="title">Date</td>
                    <td><div class="titles" id="date">NULL</div></td>
                </tr>
                <tr>
                    <td class="title">Amount Due</td>
                    <td><div class="titles" id="due1">NULL</div></td>
                </tr>

            </table>

        </div>

        <div id="invoice">Invoice</div>

        <table id="items">

            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Unit Cost</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

            <tr class="item-row">
                <td class="item-name">
                    <div class="nameitem">NULL</div>
                </td>

                <td class="description">
                    <div class="namedescription">NULL</div>
                </td>
                <td><div class="cost" >NULL</div></td>

                <td><div class="qty" >NULL</div></td>

                <td><span class="price">NULL</span></td>
            </tr>
        </table>

        <div id="options">

            <div id="actionbuttons">
                <!-- Buttons delete or redirect to new form-->
                <?php
                // If invoice is from file
                if (isset($_POST['invoiceNum'])) {
                  echo '<form name="invoiceSelect" style="margin-right: 15px;"
                      method="post" action="deleteinvoice" >
                    <input type="hidden"  name="invoiceNumDel"
                           value="'.$_POST['invoiceNum'].'" />
                    <input type="submit" style="width:100%;"
                           value="Delete Invoice #'. $_POST['invoiceNum'] .'" />
                            </form>';
                 // If invoice is from database
                 } elseif (isset($_POST['invoice-number'])) {
                   echo '<form name="invoiceSelect" style="margin-right: 15px;"
                         method="post" action="deleteinvoice">
                       <input type="hidden"  name="invoice-number"
                              value="'.$_POST['invoice-number'].'" />
                       <input type="submit" style="width:100%;"
                       value="Delete Invoice '.$_POST['invoice-name'].'" />
                       </form>';
                 }
                ?>
                <form style="margin-right: 15px;">
                    <input class="thanks-button" style="width: 100%;
                           display: inline-block;" type="button"
                           onclick="location.href = '../index';"
                           value="Create New Form" />
                    <input class="thanks-button" style="width: 100%;
                            display: inline-block;" type="button"
                            onclick="openWindow()"
                            value="View Invoice Info" />
                </form>
            </div>

            <div id="viewdata">
                <a href="viewdbinvoices.php" > View Invoices from Database </a>
                </br>
                <a href="viewfileinvoices.php" > View Invoices from Files </a>
            </div>

        </div>

        <table style="float:right; ">
            <tr>
                <td colspan="2">Tax %</td>
                <td ><div class="sumTable" >NULL</div></td>
            </tr>
            <tr>
                <td colspan="2">SubTotal</td>
                <td><div class ="totals">NULL</div></td>
            </tr>
            <tr>
                <td colspan="2" >Total</td>
                <td><div class ="totals" >NULL</div></td>
            </tr>
            <tr>
                <td colspan="2">Amount Paid</td>
                <td ><div class="sumTable">NULL</div></td>
            </tr>
            <tr>
                <td colspan="2">Balance Due</td>
                <td><div class ="totals" >NULL</div></td>
            </tr>

        </table>
    </div>

    <!-- Information Window -->
    <div id="window" class="window" style="overflow:scroll;">
        <h2 style="text-decoration:underline grey"> Invoice Information </h2>
          <div><h3 id="author" style="text-align: center;"> Author </h3></div>
          <div><h3 id="date-created" style="text-align: center;"> Date Created </h3></div>
          <div><h3 id="status" style="color: red; text-align: center; font-style: italic;">
            Status </h3></div>
          <div><button id="close-win" onclick="closeWindow()"> Close </button></div>
    </div>

    <!--
    Gets contents from file and passes them to javascript for
   parsing/decoding. The viewInvoice function populates each div element.
    -->
    <script>
    // Each variable holds content depending on if invoice is from file or db
        function onLoad() {
            var everything = "<?php
                            if(isset($_POST['invoiceNum'])) {
                           $filename = 'invoice' . $_POST['invoiceNum'] . '.txt';
                           echo file_get_contents($filename);
                         } elseif (isset($_POST['invoice-number'])) {
                           echo $_POST['invoice-contents'];
                         }
                           ?>";
            var invoiceName = "<?php
                                  if (isset($_POST['invoice-number'])) {
                                    echo $_POST['invoice-name'];
                                  } else {
                                    echo '-1';
                                  }
                              ?>";
            var invoiceAuthor = "<?php
                                  if (isset($_POST['invoice-number'])) {
                                    echo $_POST['invoice-author'];
                                  } else {
                                    echo '-1';
                                  }
                              ?>";
            var creationDate = "<?php
                                  if (isset($_POST['invoice-number'])) {
                                    echo $_POST['creation-date'];
                                  } else {
                                    echo '-1';
                                  }
                                  ?>";
            // Function populates page with values from both file and database
            viewInvoice(everything, invoiceName,  invoiceAuthor, creationDate);
        }

    </script>
    <script type='text/javascript' src='../js/viewinvoice.js'></script>
    <script type='text/javascript' src='../js/window.js'></script>
</body>

</html>
