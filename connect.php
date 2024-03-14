<?php
/**................................................................
 * @package efac v 1.0
 * @author Faith Awolu
 * Hillsofts Technology Ltd.
 * (hillsofts@gmail.com)
 * ................................................................
 */

/* Database config 
Please edit the database info to yours
*/
$db_host     = "localhost";
$db_port     = "3308"; // Change this to your MySQL port if it's not the default 3308
$db_user     = "root";
$db_pass     = "";
$db_database = "native";

// Include your ORM library using Composer or Autoloading

// Database connection using PDO
try {
    $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_database";
    $db = new PDO($dsn, $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

class App {   
    public static function message($type, $message, $code='') {
        $message = htmlspecialchars($message); // Sanitize user input
        $code = htmlspecialchars($code); // Sanitize user input
        $alertType = $type == 'error' ? 'danger' : 'success';
        return '<div class="alert alert-'.$alertType.' alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    '.$message.' <a class="alert-link" href="#">'.$code.'</a>.
                </div>';
    }
}

function get($val) {
    return @$_GET[$val];
}
