<?php 
/**................................................................
 * @package eblog v 1.0
 * @author Faith Awolu 
 * Hillsofts Technology Ltd.            
 * (hillsofts@gmail.com)
 * ................................................................
 */

include '../connect.php';
session_start();

function clean($str) {
    $str = trim($str);
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    global $conn;
    return mysqli_real_escape_string($conn, $str);
}

//Sanitize the POST values
$login = clean($_POST['username']);
$password = clean($_POST['password']);

//Input Validations
$errmsg_arr = array();
$errflag = false;
if($login == '') {
    $errmsg_arr[] = 'Username missing';
    $errflag = true;
}
if($password == '') {
    $errmsg_arr[] = 'Password missing';
    $errflag = true;
}

//If there are input validations, redirect back to the login form
if($errflag) {
    foreach($errmsg_arr as $msg) {
        echo $msg;
    }
    exit();
}

//Create query
$qry = "SELECT * FROM table_admin WHERE username='$login' AND password='$password'";
$result = mysqli_query($conn, $qry);

//Check whether the query was successful or not
if($result) {
    if(mysqli_num_rows($result) > 0) {
        //Login Successful
        session_regenerate_id(true);
        $member = mysqli_fetch_assoc($result);
        $_SESSION['SESS_MEMBER_ID'] = $member['id'];
        $_SESSION['SESS_FIRST_NAME'] = $member['name'];
        $_SESSION['SESS_LAST_NAME'] = $member['last_name']; // Corrected variable name
        $_SESSION['SESS_PRO_PIC'] = $member['file'];
        session_write_close();
        header("location: index.php");
        exit();
    } else {
        echo '<script language="javascript">';
        echo "alert('Something went wrong, Enter correct details');window.location.href='login.php'";
        echo '</script>';
        exit;
    }
} else {
    die("Query failed");
}
?>
