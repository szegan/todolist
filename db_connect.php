<!----------------------------------------------------------------------------------------------------------------------------------------------
    db_connect.php
------------------------------------------------------------------------------------------------------------------------------------------------
Open a connection to mySQL server 
------------------------------------------------------------------------------------------------------------------------------------------------>

<?php

/**********************************************************************************************************************************************
@Parameters
server   - The MySQL server for the local host
username - mysql.user name of the user that owns the server process is used.
password - In SQL safe mode, this parameter is ignored and empty password is used.tto
database - The name of the database created 

@Return Boolean value -  true or false 
**********************************************************************************************************************************************/

$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "to_do_list";

/**********************************************************************************************************************************************
public PDO::setAttribute(int $attribute, mixed $value): bool
@Parameters 
PDO::ATTR_ERRMODE - Error reporting mode of PDO. Cam take the following value 
PDO::ERRMODE_EXCEPTION - Throw an connection error between PHP and the database server 

@Return Boolean value - true or false 
**********************************************************************************************************************************************/

try {
    $conn = new PDO("mysql:host=$sName; dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Connection failed : ".$e->getMessage();
}