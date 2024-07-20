<?php

$connect = mysqli_connect('localhost', 'temasfull', 'secret123', 'temasfull');

if (mysqli_connect_errno()){
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
