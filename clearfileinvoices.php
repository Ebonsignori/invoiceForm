<!-- Deletes all file invoices -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <title>Clear File Invoices</title>
  </head>
  <body>
    <div id="wrapper-center-children" style="text-align:center;">
		<div id="header">Remove File Invoices</div>

    <?php

    $files = scandir('./php');

    //Iterate through directory
    foreach ($files as $file) {
      $fileExt = substr($file, -4, 5);

      //Parse Proper Filenumber. Only supports up to 999 invoices
      if (strlen($file) > 13) {
          $fileNum = substr($file, 7, 3);
          $filepath = "./php/invoice".$fileNum.".txt";
          continue;
      } else if (strlen($file) > 12) {
          $fileNum = substr($file, 7, 2);
          $filepath = "./php/invoice".$fileNum.".txt";
          continue;
      } else {
          $fileNum = substr($file, 7, 1);
          $filepath = "./php/invoice".$fileNum.".txt";
      }

      //Use unlink to delete invoice file, display error if unable
      if ($fileExt == ".txt") {
        if (unlink($filepath)) {
            echo '<p> Invoice'.$fileNum.' Deleted Successfully... </p>';
        } else {
            echo '<p> There was an error deleting invoice # '. $fileNum . '</p>';
        }
      }
    }
    echo '<p> All invoices are deleted from files.';
    ?>

    <!-- Naviagtion buttons to go back to other pages -->
     <div>
       <input class="thanks-button" style="min-width:150px;" type="button"
              onclick="location.href = './index.html';"
              value="Create New Form" />
   </div>
   <div>
     <input class="thanks-button" style="min-width:150px;" type="button"
            onclick="location.href = './php/viewfileinvoices.php';"
            value="View Invoices From File" />
        </div>
  </body>
</html>
