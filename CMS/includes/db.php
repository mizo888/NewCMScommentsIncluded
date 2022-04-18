<?php

/* Loop through each value */
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";


foreach ($db as $key => $value){
   define(strtoupper($key), $value);
}



//Database Connection
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if(!$connection){

   die("Connection to db_cms faield" . mysqli_error());
}




// //Database Connection
// $connection = mysqli_connect('localhost', 'root', '', 'cms');
// if(!$connection){
// //    echo "connected";
//     die("Connection to db_cms faield" . mysqli_error());
// }



?>