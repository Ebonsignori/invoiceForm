<!-- Populate database with 100 invoices -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<title>Populate Database</title>
	</head>
	<body>
		<div id="wrapper-center-children" style="text-align:center;">
		<div id="header">Populate Database</div>
		<p> Querying Database ... </p>
		<?php
		/* If verification is approved to delete old tables and generate 100
		new invoices, delete old tables and generate 100 random invoices */
		//if (isset($_POST['generate-one-hundred']) && isset($_POST['i-am-sure'])) {
			//SQL statements to be queried
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
			echo '<p> Attempting to create new invoice table... </p>';
			if ($result = mysqli_query($conn, $newTable)) {
				echo '<p> Success! <br /> Created new table </p>';
			} else {
				echo '<p> Failed to create new invoice table. </p>';
				die();
			}

			// Populate table with 100 random invoices
			echo '<p> Attempting to add 100 random invoices... </p>';
			for ($i = 0; $i < 100; $i++) {
				$invoiceName = randomString(10);
				$invoiceAuthor = randomString(25);
				$invoiceContents = randomInvoiceContents($i);

				$insertdata = 'INSERT INTO invoices '
				 . '(invoice_title, invoice_author, submission_date, invoice_contents)'
				 . 'VALUES ( "'.$invoiceName.'",  "'.$invoiceAuthor.'", NOW(), "' .
				  mysqli_real_escape_string($conn, $invoiceContents) .'")';
					if (!$result = mysqli_query($conn, $insertdata)) {
						echo '<p> Failed to add 100 random invoices </p>';
						die();
					}
			}
			if ($result) {
				echo '<p> Success! <br /> Invoices added </p>';
			}

			// Close connection to MySQL
			mysqli_close($conn);

			//Functions to generate random content
			function randomString($length) {
				 $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ';
				 $charactersLength = strlen($characters);
				 $randomString = '';
				 for ($i = 0; $i < $length; $i++) {
						 $randomString .= $characters[rand(0, $charactersLength - 1)];
				 }
				 return $randomString;
			}

			function randomNumber($length) {
				 $characters = '0123456789';
				 $charactersLength = strlen($characters);
				 $randomString = '';
				 for ($i = 0; $i < $length; $i++) {
					 //Make sure first character of number string isn't 0
					 	if (strlen($randomString < 1)) {
						 	$randomString .= $characters[rand(1, $charactersLength - 1)];
					 	} else {
							$randomString .= $characters[rand(0, $charactersLength - 1)];
						}
				 }
				 return (int)$randomString;
			}

			function randomInvoiceContents($i) {
					return randomNumber(1).'**everything**undefined**end**NgfYVSxBoi**next**9MAFp5UdEU**next**IkWuefdYRa**next**4190072433**next****end**7482380948**next**April 19, 2017**next**$77990496381582737408.00**next****end**2**end** INVOICE **end**otWCkiMfFw**znext**mCzjVXTsny**next****end**IbKkHuYvOF**next**XGaEVDycmR**next****end**5887867226**next**7172965337**next****end**2829840000**next**8549988925**next****end**$16661722190823839744.00**next**$61328774190758895616.00**next****end**$77990496381582737408.00**next**$77990496381582737408.00**next**$77990496381582737408.00**next****end**0**next**0**next****fin**';
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
