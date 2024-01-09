<?php
    //connecting to database
    include "../Extra/connect.php";
    
    //include valid file
    include "../Valid_input.php";
    
    //Declaration and innitialization of variables

    $username = Valide_input($_POST["L-name"]);
    $password = Valide_input($_POST["L-password"]);
    $submit = Valide_input($_POST["login-submit"]);

    //Extract  user's information from database
    $extract_query = "SELECT * FROM users_info WHERE username = '$username'";
    $extract_query_results = mysqli_query($conn, $extract_query);

    $count_result = mysqli_num_rows($extract_query_results);

    if($username && $password && $submit){
        if($count_result == 0){
            echo "<p class='error'>Incorrect name. Please enter correct name</p>";
            header("Refresh:2; url=log-in.html");
        }else if($count_result == 1){
            $row = mysqli_fetch_assoc($extract_query_results);
            if(md5($password) == $row["password"]){

                //setting the username as session to use on the main chat page
                $_SESSION["username"] = $row["username"];
                echo $row["username"];

                //echo "<p class='success'>Login Successfull</p>";
                header("location:../chat.php"); //FOR NOW
            }else{
                echo "<p class='error'>Incorrect Password. Please enter correct password</p> ". md5($password);
                header("Refresh:2; url=log-in.html");
            }
        }
    }else{
        echo "<p class='error'>Please all fields are required. Input password and name.</p>";
        header("Refresh:2; url=log-in.html");
    }


    

?>