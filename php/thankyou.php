<!-- Thank You Page -->
<html>
    <head>
        <title>Editable Invoice Thank You Page</title>
        <link rel='stylesheet' type='text/css' href='../css/main.css' />
    </head>

    <body>
<?php

        //If save to file option, run the following:
        if (isset($_POST['total'])) {
            /* Iterates through files in folder, accounts for the ones that
             * aren't invoices and then displays respective status message if successful,
             * unable to open, or unable to write a new invoice to file.
             * Includes naviagtion buttons */

            //Filter non-invoice files by extension
            $files = scandir('.');
            foreach ($files as $file) {
                $fileExt = substr($file, -4, 5);

                if ($fileExt == ".txt") {
                    $invoices[] = $file;
                }
            }
            if (isset($invoices)) {
                //Find highest invoice number
                foreach ($invoices as $file2) {
                    $fileNumbers[] = (int) substr($file2, 7, (strlen($file2) - 3));
                }
                $fileNumber = max($fileNumbers);
            } else {
                $fileNumber = 0;
            }
            $filename = 'invoice' . ++$fileNumber . '.txt';
            //Creates a file with filenumber one greater than highest invoice
            if ($fileHandle = fopen($filename, "w")) {
                if (flock($fileHandle, LOCK_EX)) {
                    $content = $_POST['total'];
                    fwrite($fileHandle, $fileNumber . $content);
                    flock($fileHandle, LOCK_UN);
                } else {
                    echo '<h1> Error Locking Resourses Please Try Again.</h1>';
                    die;
                }

                if (fclose($fileHandle)) {
                    chmod($filename, 0777);
                    echo '
		                  <div id="wrapper-center-children">

                    <div id="header">Confirm</div>

                    <h1> Thank You! </h1>
                    <p> Invoice #' . $fileNumber . ' has successfully
                        been written to a file. </p>
                    <div id="wrapper-center-children">
                        <input class="thanks-button" type="button"
                            onclick="location.href = \'../php/viewfileinvoices.php\';"
                            value="View File Invoice List" />
                         </br>
                    </div>
                    <div>
                        <input class="thanks-button" type="button"
                            onclick="location.href = \'../index.html\';"
                            value="Create New Form" />
                    </div>
                </div>';
                } else {
                    echo '
                    <div id="wrapper-thank-you">
		        <div id="header">Failure To Write To File</div>

                        <h1> Sorry... </h1>
                        <p> Looks like we couldn\'t write
                            to the file... <b> :(
                          </b> </br>
                            Please try again later or contact me at
                            evanbonsignori@yahoo.com
                         </br>
                         </br>
                         I\'ll look at it and get back to you.
                         </br>
                         </br>
                            Thank you for your patience,
                         </br>
                            Evan
                        </p>
                        <div>
                            <input class="thanks-button" type="button"
                                onclick="location.href = \'../php/viewfileinvoices.php\';"
                                value="View File Invoice List" />
                             </br>
                             </div>
                             <div>
                            <input class="thanks-button" type="button"
                                onclick="location.href = \'../index.html\';"
                                value="Create New Form" />
                        </div>
                    </div>';
                }
            } else {
                echo '<div id="wrapper-thank-you">

                    <div id="header">Failure To Open File</div>

                    <h1> Sorry... </h1>
                    <p> Looks like we couldn\'t open the file <b> :(
                        </b> </br>
			Please try again later or contact me at </br>
                        evanbonsignori@yahoo.com and I\'ll fix it.
			</br>  </br>I\'ll look at it and get back to you.
                        </br></br>
			Thank you for your patience, </br>
                        Evan

                    </p>

                    <div>
                        <input class="thanks-button" type="button"
                            onclick="location.href = \'../php/viewfileinvoices.php\';"
                            value="View File Invoice List" />
                         </br>
                    </div>
                    <div>
                        <input class="thanks-button" type="button"
                            onclick="location.href = \'../index.html\';"
                            value="Create New Form" />
                    </div>
                </div>';
            }

         //If save to database option, run the following:
        } elseif (isset($_POST['total-db'])) {
            //Data from $POST method forms
            $invoiceContents = $_POST['total-db'];
            $invoiceName = $_POST['title-db'];
            $invoiceAuthor = $_POST['author-db'];

            //Fail Message
            $failmsg = '<div class="wrapper-center-children">

                    <div id="header">Failure To Save to Database</div>

                    <h1> Sorry... </h1>
                    <p> Looks like we couldn\'t save to the database <b> :(
                        </b> </br>
			Please try again later or contact me at </br>
                        evanbonsignori@yahoo.com and I\'ll fix it.
			</br>  </br>I\'ll look at it and get back to you.
                        </br></br>
			Thank you for your patience, </br>
                        Evan

                    </p>

                    <div class="wrapper-center-children">
                        <input class="thanks-button" type="button"
                            onclick="location.href = \'../php/viewdbinvoices.php\';"
                            value="View Database Invoice List" />
                         </br>
                         </div>
                         <div class="wrapper-center-children">
                        <input class="thanks-button" type="button" style="width: 35%;"
                            onclick="location.href = \'../index.html\';"
                            value="Create New Form" />
                    </div>
                </div>';
            //TODO: Secure MySql login info

            //Server info encapsulated for security
            include("../../.-/.+.php");

            $conn = mysqli_connect($server, $user, $pwd, $db);

            //SQL statements
            $insertdata = 'INSERT INTO invoices '
             . '(invoice_title, invoice_author, submission_date, invoice_contents)'
             . 'VALUES ( "'.$invoiceName.'",  "'.$invoiceAuthor.'", NOW(), "' . mysqli_real_escape_string($conn, $invoiceContents) .'")';

            if (!$conn) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
            if (!mysqli_query($conn, $insertdata)) {
                echo '<p>' . $failmsg . '</p>';
            } else {
                mysqli_close($conn);
                echo '<div id="wrapper-center-children">

                    <div id="header">Confirm</div>

                    <h1> Thank You! </h1>
                    <p> <b style="margin-left:5px; margin-right:5px;"> '
                     . $invoiceName . ' </b> by <b style="margin-left:5px; margin-right:5px;"> '
                     . $invoiceAuthor . ' </b> has successfully
                        been written to the database. </p>
                    <div id="wrapper-center-children">
                        <input class="thanks-button" type="button"
                            onclick="location.href = \'../php/viewdbinvoices.php\';"
                            value="View Database Invoice List" />
                         </br>
                         </div>
                         <div id="wrapper-center-children">
                        <input class="thanks-button" type="button"
                            onclick="location.href = \'../index.html\';"
                            value="Create New Form" />
                    </div>
                </div>';
            }
        }

        ?>

    </body>


</html>
