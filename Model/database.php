<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sab73'); */

/*When I need to root it to the njit myphpadmin
define('DB_SERVER', 'sql1.njit.edu');
define('DB_USERNAME', 'sab73');
define('DB_PASSWORD', 'Ko9yJPFR');
define('DB_NAME', 'sab73');
and it has to be uploaded onto afs to work */

define('DB_SERVER', 'sql1.njit.edu');
define('DB_USERNAME', 'sab73');
define('DB_PASSWORD', 'Ko9yJPFR');
define('DB_NAME', 'sab73');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>