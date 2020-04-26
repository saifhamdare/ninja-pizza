<?php
$conn=mysqli_connect('localhost','saif','NinjaPizza@111','ninja pizza');
//check connection
if(!$conn){
    echo 'connection error:'.mysqli_connect_error();
}

?>