<?php 
$pcon = new PDO( 
    'mysql:host=localhost;dbname=test_ajax', 
    'root', 
    '', 
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") 
);
?>
