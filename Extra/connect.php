<?php

    $servername = "localhost";
    $password = "";
    $S_username = "root";
    $db_name = "group_chat";

    $conn = mysqli_connect($servername, $S_username, $password, $db_name);

    // if($conn){
    //     echo "<p class='success'>Connected to DB</p>";
    // }else{
    //     echo "<p class='error'>Failed to connect to DB</p>";
    // }

    session_start();

?>
<html>
    <style>
        .success{
            padding: 15px;
            color: white;
            font-size: 20px;
            background-color: green;
        }
        .error{
            padding: 15px;
            color: white;
            font-size: 20px;
            background-color: red;
        }
    </style>
</html>