<?php

include('creds.php');
global $db;

foreach($db as $key => $value) {

    define(strtoupper($key), $value);

}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($connection) {
    echo "we are connected";
} else {
    echo "nope";
}

?>