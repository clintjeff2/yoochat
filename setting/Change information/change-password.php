<?php

    //Connect
    include "../../Extra/connect.php";

    //valide file
    include "../../Valid_input.php";

    if(isset($_POST["send_psw"])){
        $G_ID = Valide_input($_POST["myID"]);
        $old_psw = Valide_input($_POST["old_psw"]);
        $new_psw = Valide_input($_POST["new_psw"]);
        $cnew_psw = Valide_input($_POST["cnew_psw"]);
        $Encrpt_new_psw = md5($new_psw);

        //Get old password from db
        $userID = Valide_input($_REQUEST["idi"]);

        $users_info = "SELECT * FROM users_info WHERE userID = $userID";
        $users_info_results = mysqli_query($conn, $users_info);
        $row = mysqli_fetch_assoc($users_info_results);

        //Check if old passwords matches
        if($row["password"] == md5($old_psw)){
            //Check if new password match with its confirmation
            if($new_psw == $cnew_psw){
                //Change password in db
                $query = "UPDATE users_info SET password = '$Encrpt_new_psw' WHERE userID = $userID";
                $query_results = mysqli_query($conn, $query);

                echo "<p class='success'>Password changed.</p>";
                header("Refresh:1.5; url=../settings.php?idi=$G_ID");
            }else{
                echo "<p class='error'>The new password and the confirmation do not match</p>";
                header("Refresh:3.5; url=../settings.php?idi=$G_ID");
            }
        }else{
            echo "<p class='error'>Old password is incorrect</p>";
            header("Refresh:2.5; url=../settings.php?idi=$G_ID");
        }
    }

?>