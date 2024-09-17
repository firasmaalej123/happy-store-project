
<?php
include 'generatefunction.php';
include 'dbc.php';

if (isset($_GET['param'])) {
    $param = $_GET['param'];
    $filename = $param . '.php';
    header("Location: $filename");
    exit();
} else {
    echo "No parameter provided!";
}
//usage:href=generate.php?param=#