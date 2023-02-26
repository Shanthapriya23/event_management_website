<?php

//$conn = pg_connect("","postgres","priya","mydb");
$conn_string =
    'host=localhost port=5432 dbname=mydb user=postgres password=priya';
$conn = pg_connect($conn_string);
if (!$conn) {
    echo "error:unable to connect to database\n";
}
?>
