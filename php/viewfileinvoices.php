<!-- View Invoice From File Page -->
<!-- Invoice numbers are assigned by adding one to the highest valued invoice # -->

<html>
    <head>
        <title>Invoices From Files</title>
        <link rel='stylesheet' type='text/css' href='../css/main.css' />
    </head>

    <body>
        <div id="wrapper-center">

            <div id="header">Invoices Stored In Files</div>
        </div>
        <div id="wrapper-center"
            <h1> Invoices: </h1>
        </div>
            <?PHP
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
                } else if (strlen($file) > 12) {
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
                    <form id="invoice' . $fileNum . 'Select" name="invoiceSelect"
                        method="post" action="viewinvoice"> 
                           <input type="hidden" name="invoiceNum" value="'
                    . $fileNum . '" />
                           <input style="float:left;" 
                           class="select-button" 
                           type="submit" value="View Invoice' . $fileNum . '" />
                   </form> 
                   <form id="invoice' . $fileNum . 'Delete" name="invoiceSelect"
                       method="post" action="deleteinvoice"> 
                           <input type="hidden"  value="' .
                    $fileNum . '" />
                           <input style="float:right;" name="invoiceNumDel"
                           class="select-button" 
                           type="submit" value="Delete Invoice' . $fileNum . '" />
                   </form> 
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
                    <form id="invoice' . $fileNum . 'Select" name="invoiceSelect"
                        method="post" action="viewinvoice"> 
                           <input type="hidden" name="invoiceNum" value="'
                        . $fileNum . '" />
                           <input style="float:left;" class="select-button" 
                           type="submit" value="View Invoice' . $fileNum . '" />
                   </form> 
                   <form id="invoice' . $fileNum . 'Delete" name="invoiceSelect"
                       method="post" action="deleteinvoice"> 
                           <input type="hidden"  name="invoiceNumDel" value="' .
                        $fileNum . '" />
                           <input style="float:right;" class="select-button" 
                           type="submit" value="Delete Invoice' . $fileNum . '" />
                   </form> 
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
                    <form id="invoice' . $fileNum . 'Select" name="invoiceSelect"
                        method="post" action="viewinvoice"> 
                           <input type="hidden" name="invoiceNum" value="'
                        . $fileNum . '" />
                           <input style="float:left;" class="select-button" 
                           type="submit" value="View Invoice' . $fileNum . '" />
                   </form> 
                   <form id="invoice' . $fileNum . 'Delete" name="invoiceSelect"
                       method="post" action="deleteinvoice"> 
                           <input type="hidden"  name="invoiceNumDel" value="' .
                        $fileNum . '" />
                           <input style="float:right;" class="select-button" 
                           type="submit" value="Delete Invoice' . $fileNum . '" />
                   </form> 
                </div>';
                    }
                }
            }
            //If no invoices are present display empty message instead
            if ($numberOfInvoices == 0) {
                echo "<h2> No Invoices Stored In Files </h2>";
            }
            ?>

            <!-- Navigation Button -->
            <div id="wrapper-center" >
                <input class="select-button" style="min-width:200px;" type="button" 
                       onclick="location.href = '../index.html';" 
                       value="Go Back To New Invoice Page" />
            </div>

        </div>

    </body>


</html>