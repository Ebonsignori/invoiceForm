<!-- View Invoice From File Page -->
<!-- Invoice numbers are assigned by adding one to the highest valued invoice # -->

<html>
    <head>
        <title>Invoices From Files</title>
        <link rel='stylesheet' type='text/css' href='../css/main.css' />
    </head>

    <body>
        <div id="wrapper-center-children">

            <div id="header">Invoices Stored In Files</div>

            <h1> Invoices: </h1>

            <?php
            //Scan through directory to find all invoice files
            $numberOfInvoices = 0;
            $files = scandir('.');

            //Iterate through directory
            foreach ($files as $file) {
                $fileExt = substr($file, -4, 5);

                //Parse Proper Filenumber. Only supports up to 999 invoices
                if (strlen($file) > 13) {
                    $threeDigitFiles[] = $file;
                    continue;
                } elseif (strlen($file) > 12) {
                    $twoDigitFiles[] = $file;
                    continue;
                } else {
                    $fileNum = substr($file, 7, 1);
                }

                //If they are an invoice file (.txt) display them as buttons
                if ($fileExt == ".txt") {
                    $numberOfInvoices++;
                    echo
                    '<div id="thank-you-buttons">
                    <span>
                    <form id="invoice' . $fileNum . 'Select" name="invoiceSelect"
                        method="post" action="viewinvoice.php">
                           <input type="hidden" name="invoiceNum" value="'
                    . $fileNum . '" />
                           <input style="float:left; margin: 5px;"
                           class="select-button"
                           type="submit" value="View Invoice' . $fileNum . '" />
                   </form>
                   _
                   <form id="invoice' . $fileNum . 'Delete" name="invoiceSelect"
                       method="post" action="deleteinvoice.php">
                       <input type="hidden"  name="invoiceNumDel"
                              value="'. $fileNum .'" />
                      <input id="delete-bt" name="del"
                           class="select-button" style="float:right; margin: 5px;"
                           type="submit" value="Delete Invoice' . $fileNum . '" />
                   </form>
                   </span>
                </div>';
                }
            }
            if (isset($twoDigitFiles)) {
                //Display Two Digit Invoices
                foreach ($twoDigitFiles as $file) {
                    $fileExt = substr($file, -4, 5);
                    $fileNum = substr($file, 7, 2);

                    //If they are an invoice file (.txt) display them as buttons
                    if ($fileExt == ".txt") {
                        $numberOfInvoices++;
                        echo
                        '<div id="thank-you-buttons">
                        <span>
                    <form id="invoice' . $fileNum . 'Select" name="invoiceSelect"
                        method="post" action="viewinvoice.php">
                           <input type="hidden" name="invoiceNum" value="'
                        . $fileNum . '" />
                           <input style="float:left; margin: 5px;" class="select-button"
                           type="submit" value="View Invoice' . $fileNum . '" />
                   </form>
                   _
                   <form id="invoice' . $fileNum . 'Delete" name="invoiceSelect"
                       method="post" action="deleteinvoice.php">
                           <input type="hidden"  name="invoiceNumDel" value="' .
                        $fileNum . '" />
                           <input id="delete-bt" class="select-button" style="float:right; margin: 5px;"
                           type="submit" value="Delete Invoice' . $fileNum . '" />
                   </form>
                   </span>
                </div>';
                    }
                }
            }

            //Display Three Digit Invoices
            if (isset($threeDigitFiles)) {
                foreach ($threeDigitFiles as $file) {
                    $fileExt = substr($file, -4, 5);
                    $fileNum = substr($file, 7, 3);

                    //If they are an invoice file (.txt) display them as buttons
                    if ($fileExt == ".txt") {
                        $numberOfInvoices++;
                        echo
                        '<div id="thank-you-buttons">
                        <span>
                    <form id="invoice' . $fileNum . 'Select" name="invoiceSelect"
                        method="post" action="viewinvoice.php">
                           <input type="hidden" name="invoiceNum" value="'
                        . $fileNum . '" />
                           <input style="float:left; margin: 5px;" class="select-button"
                           type="submit" value="View Invoice' . $fileNum . '" />
                   </form>
                   _
                   <form name="invoiceSelect" method="post" action="deleteinvoice.php">
                           <input type="hidden"  name="invoiceNumDel" value="' .
                        $fileNum . '" />
                           <input  id="delete-bt"  style="float:left; margin: 5px;"
                            class="select-button" type="submit" value="Delete Invoice'
                            . $fileNum . '" />
                   </form>
                   </span>
                </div>';
                    }
                }
            }
            //If no invoices are present display empty message instead
            if ($numberOfInvoices == 0) {
                echo '<div id="wrapper-center-children"> <h2> No Invoices
                Stored In Files </h2> </div>';
            }
            ?>

            <!-- Navigation Button -->
            <div id="wrapper-center-children">
            <input class="yes-bt" style="min-width:200px; border-color:black;"
            type="button"
                   onclick="openWindow2()"
                   value="Clear File Invoices" />
            </div>

            <div id="wrapper-center" >
                <input class="select-button" style="min-width:200px;" type="button"
                       onclick="location.href = '../index.html';"
                       value="Go Back To New Invoice Page" />
            </div>

            <!-- Confirmation Window for Database Deletion-->
            <div id="window-populateDB" class="window" style="height:150px; display:none;">
                <h2 style="color: red; margin-top: -10px;"> WARNING </h2>
                  <p> Confirming will remove all of you current file invoices. </p>
                    <p> Proceed with deletion? </p>
                    <div>
                  <button onclick="location.href = '../clearfileinvoices.php'" class="yes-bt">
                     Yes </button>
                  <button id="close-win-populateDB" class="no-bt" onclick="closeWindow2()">
                    No </button>
                  </div>
            </div>

            <script type="text/javascript" src="../js/window.js"></script>

        </div>

    </body>


</html>
