<!-- Delete Invoice Page -->

<html>
    <head>
        <title>Invoices In Files</title>
        <link rel='stylesheet' type='text/css' href='../css/main.css' />
    </head>

    <body>
        <div id="wrapper-center-children">
            <!-- TODO: Implement database invoice deletion -->
            <div id="header">Delete Invoice Page </div>
            <?PHP

            if (isset($_POST['invoiceNumDel'])) {
                //Use unlink to delete invoice file, display error if unable
                $filepath = "./invoice" . $_POST['invoiceNumDel'] . ".txt";
                if (unlink($filepath)) {
                    echo '<h2> Invoice Deleted Successfully </h2>';
                } else {
                    echo '<h2> There was an error  deleting your file </h2>';
                }
                echo '<div>
                    <input class="thanks-button" style="min-width:200px;" type="button"
                           onclick="location.href = \'viewfileinvoices.php\';"
                           value="Go Back to Invoice List" />
                    </br>
                  </div>';
            } elseif (isset($_POST['invoice-number'])) {
              //Server info encapsulated for security
              include("../../.-/.+.php");

              $conn = mysqli_connect($server, $user, $pwd, $db);
              if (mysqli_connect_errno())
                {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                die();
              } else {
                 if (mysqli_query($conn, 'DELETE FROM invoices WHERE invoice_id='.$_POST["invoice-number"].'')) {
                    echo '<h2> Invoice Deleted Successfully </h2>';
                 } else {
                   echo '<h2> There was an error  deleting your file </h2>';
                 }
               }
               echo '<div>
                   <input class="thanks-button" style="min-width:200px;" type="button"
                          onclick="location.href = \'viewdbinvoices.php\';"
                          value="Go Back to Invoice List" />
                   </br>
                 </div>';
            }

            ?>
            <!-- Naviagtion buttons to go back to other pages -->

              <div>
                <input class="thanks-button" style="min-width:150px;" type="button"
                       onclick="location.href = '../index.html';"
                       value="Create New Form" />
            </div>



        </div>

    </body>

</html>
