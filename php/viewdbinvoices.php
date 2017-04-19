<!-- View Invoices Page From Database -->
<!-- In the works -->
<html>
    <head>
        <title>Invoices From Database</title>
        <link rel='stylesheet' type='text/css' href='../css/main.css' />
    </head>

    <body>
        <div id="wrapper-center-children" >

            <div id="header">Invoices Stored In Database</div>

            <h1> Invoices: </h1>

            <?php
            //Database login Info
            $server = 'localhost';
            $user = 'eb3465';
            $pwd = '55452112eb';
            $db = 'invoicestorage';

            $conn = mysqli_connect($server, $user, $pwd, $db);
            if (mysqli_connect_errno())
              {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }

            //Determine order to sort invoices by
            $orderBy = $_POST['order-by'];
            if (isset($orderBy)) {
                //SQL select statment to display titles in specified order
                $sqlSelect='SELECT invoice_title FROM invoices ORDER BY '.$orderBy.'';
            } else {
              //Sort by submission_date/creation date by default
                $sqlSelect="SELECT invoice_title FROM invoices ORDER BY submission_date";
            }

            if ($result=mysqli_query($conn,$sqlSelect, MYSQLI_USE_RESULT))
            {
            $rows = mysqli_fetch_all($result, MYSQLI_NUM);
            mysqli_free_result($result);
            }
            $numberOfRows = count($rows);
            for ($i = 0; $i < $numberOfRows; $i++) {
              echo '<div id="thank-you-buttons">
          <form id="' . $rows[$i][0]   . 'Select" name="invoiceSelect"
              method="post" action="viewinvoice">
                 <input type="hidden" name="invoiceTitle" value="'
              . $rows[$i][0] . '" />
                 <input style="float:left; margin: 5px;" class="select-button"
                 type="submit" value="View: ' . $rows[$i][0] . '" />
         </form>
         <form id="' . $rows[$i][0]  . 'Delete" name="invoiceSelect"
             method="post" action="deleteinvoice">
                 <input type="hidden"  name="invoiceTitleDel" value="' .
              $rows[$i][0] . '" />
                 <input style="float:right;  margin: 5px;" class="select-button"
                 type="submit" value="Delete: ' . $rows[$i][0] . '" />
         </form>
      </div>';
            }

            mysqli_close($conn);


             ?>


                <div id="wrapper-center-children">
                <input class="thanks-button" style="min-width:200px;" type="button"
                       onclick="location.href = '../index.html';"
                       value="Go Back To New Invoice Page" />
                </div>
        </div>


    </body>


</html>
