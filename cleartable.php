<!-- Removes old table and replaces with new clear one -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<title>Clear Table</title>
	</head>
	<body>
		<div id="wrapper-center-children" style="text-align:center;">
		<div id="header">Reset Database</div>
		<p> Querying Database ... </p>
		<?php
		/* Remove old table and create new */
			$newTable = 'CREATE TABLE invoices (invoice_id INT NOT NULL AUTO_INCREMENT,
				invoice_title VARCHAR(100) NOT NULL, invoice_author VARCHAR (50) NOT NULL,
				submission_date DATE, invoice_contents LONGBLOB NOT NULL,
				PRIMARY KEY (invoice_id) ) ;';
		  $dropTable = 'DROP TABLE invoices';

			//Server info encapsulated for security
			include("../.-/.+.php");

			// Connect to Server
			$conn = mysqli_connect($server, $user, $pwd, $db);
			if (!$conn)
			{
				echo "<p> Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
				die();
			} else {
				echo '<p> Success! <br /> Connected to database </p>';
			}

			// Remove Old Invoice table
      echo '<p> Attempting to remove old invoice table... </p>';
			$result = mysqli_query($conn, "show tables like 'invoices';");
			if ($result->num_rows > 0) {
			    if (mysqli_query($conn, $dropTable)) {
						echo '<p> Success! <br /> Table dropped </p>';
					} else {
						echo '<p> Failed to drop "invoices" table </p>';
						die();
					}
			}
			//Create new invoice table
			echo '<p> Attempting to create blank invoice table... </p>';
			if ($result = mysqli_query($conn, $newTable)) {
				echo '<p> Success! <br /> Created blank table </p>';
			} else {
				echo '<p> Failed to create new invoice table. </p>';
				die();
			}
     ?>
		 <!-- Naviagtion buttons to go back to other pages -->
 			<div>
 				<input class="thanks-button" style="min-width:150px;" type="button"
 							 onclick="location.href = './index.html';"
 							 value="Create New Form" />
 		</div>
 		<div>
 			<input class="thanks-button" style="min-width:150px;" type="button"
 						 onclick="location.href = './php/viewdbinvoices.php';"
 						 value="View Files From Database" />
 				 </div>

		 </div>


   </body>
</html>
