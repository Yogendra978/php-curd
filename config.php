<?php
include 'define.php';

$conn = mysqli_connect(HOST_NAME,HOST_USERNAME,HOST_PASSWORD,HOST_DB);
if(!$conn){
    echo mysqli_error();
}
