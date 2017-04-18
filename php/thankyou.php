<!-- Thank You Page -->
<html>
    <head>
        <title>Editable Invoice Thank You Page</title>
        <link rel='stylesheet' type='text/css' href='../css/main.css' />
    </head>

    <body>
<?PHP
        
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
                    DIE;
                }

                if (fclose($fileHandle)) {
                    chmod($filename, 0777);
                    echo '
		<div id="wrapper-thank-you">
		
                    <div id="header">Confirm</div>
        
                    <h1> Thank You! </h1>
                    <p> Invoice #' . $fileNumber . ' has successfully
                        been written to a file. </p>
                    <div>
                        <input class="thanks-button" type="button" 
                            onclick="location.href = \'../php/viewfileinvoices.php\';" 
                            value="View File Invoice List" />
                         </br>
                        <input class="thanks-button" type="button" style="width: 35%;"
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
                            <input class="thanks-button" type="button" style="width: 35%;"
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
                        <input class="thanks-button" type="button" style="width: 35%;"
                            onclick="location.href = \'../index.html\';" 
                            value="Create New Form" />
                    </div>
                </div>';
            }
            
         //If save to database option, run the following:
        } elseif (isset($_POST['total-db'])) {
            $invoiceContents = $_POST['total-db'];
            //Fail Message
            $failmsg = '<div id="wrapper-thank-you">
		
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
                    
                    <div>
                        <input class="thanks-button" type="button" 
                            onclick="location.href = \'../php/viewdbinvoices.php\';" 
                            value="View Database Invoice List" />
                         </br>
                        <input class="thanks-button" type="button" style="width: 35%;"
                            onclick="location.href = \'../index.html\';" 
                            value="Create New Form" />
                    </div>
                </div>';  
            
            //Server Info
            $server = 'localhost';
            $user = 'eb3465';
            $pwd = '55452112eb';
            
            //SQL statements
            $insertdata = 'INSERT INTO invoice (invoice_contents) VALUES ('.$invoiceContents.');';

            if (!$conn = mysqli_connect($server, $user, $pwd)) {
                echo '<p>' . $failmsg . mysql_error() . '</p>';
            }
            if (!mysql_select_db( 'invoicestorage', $conn )) {
                echo '<p>' . $failmsg . mysql_error() . '</p>';
            }
            if (!mysql_query( 'invoicestorage', $conn )) {
                echo '<p>' . $failmsg . mysql_error() . '</p>';
            }
            if (!mysql_query( $insertdata, $conn )) {
                echo '<p>' . $failmsg . mysql_error() . '</p>';
            } else {  
              echo '<p> SUCCESS </p>';
              mysql_close($conn);
            }
        }

        ?>

    </body>


</html>