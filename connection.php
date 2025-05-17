<?php 

$conn = mysqli_connect("localhost", "root", "", "crud");

if($conn){
    echo "connected";
}else{
    die("Error".mysqli_connect_error());
}

?>