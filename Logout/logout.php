<?php

    //connect
    include "../Extra/connect.php";
    session_destroy();
    header("location:../log/log-in.html");

?>