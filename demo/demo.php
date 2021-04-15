<?php
//add library to file
include '../PHPCRUDLib.php';
use PHPGrammers\PHPCRUDLib as PHPCRUDLib;
//define table name
$table = 'products';
//create library object and pass the table name to it
$PHPCRUDLib = new PHPCRUDLib($table);

/* ******Time to have fun :)******* */

//select records in table
$result = $PHPCRUDLib->allRecords();

//saving new record into table
$PHPCRUDLib->name ='Pepsi Cola';
$PHPCRUDLib->user_id =1;
$PHPCRUDLib->created_at =date('Y-m-d H:i:s');
$PHPCRUDLib->save();

//update records using id
$PHPCRUDLib->name ='Malta Guiness';
$id = 5;
$PHPCRUDLib->update($id);

//delete one record using id
$id = 3;
$PHPCRUDLib->delete($id);
