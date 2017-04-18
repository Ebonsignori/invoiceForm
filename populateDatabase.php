<?PHP
/* If verification is approved to delete old tables and generate 100
new invoices, delete old tables and generate 100 random invoices */
if (isset($_POST['generate-one-hundred']) && isset($_POST['i-am-sure'])) {
//MySQL login info
$server = 'localhost';
$user = 'eb3465';
$pwd = '55452112eb';

//SQL statements to be queried
$newTable = 'CREATE TABLE invoices(invoice_id INT NOT NULL AUTO_INCREMENT, invoice_title VARCHAR(100) NOT NULL, invoice_author VARCHAR (50) NOT NULL, submission_date DATE, invoice_contents LONGBLOB NOT NULL, PRIMARY KEY (invoice_id) ) ;'

			try {
				$conn = mysqli_connect($server, $user, $pwd);
                mysql_select_db( 'invoicestorage', $conn );
				if (!mysql_query('SELECT 1 FROM `invoices` LIMIT 1',$conn)) {
					mysql_query('DROP TABLE invoices', $conn);
				} 
				mysql_query($newTable, $conn);
   				mysql_close($conn);
            }
                       
             
}
          
/* From Command Prompt             
USE invoicestorage;

CREATE TABLE invoices(invoice_id INT NOT NULL AUTO_INCREMENT, invoice_title VARCHAR(100) NOT NULL, invoice_author VARCHAR (50) NOT NULL, submission_date DATE, PRIMARY KEY (invoice_id) ) ;
*/

?>