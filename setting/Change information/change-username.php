<?php
    //connect to db
    include "../../Extra/connect.php";

    //valide file
    include "../../Valid_input.php";

    if(isset($_POST["send_new_name"])){
        //Collecting variables from settings page.
        $userID = Valide_input($_REQUEST["idi"]);
        $new_name = Valide_input($_POST["new_name"]);
        $G_ID = Valide_input($_POST["myID"]);
        //Check if name already exist amongst users
        $users_info = "SELECT * FROM users_info WHERE username = '$new_name'";
        $users_info_results = mysqli_query($conn, $users_info);
        $count = mysqli_num_rows($users_info_results);

        if($count == 0){
            $update_name_query = "UPDATE users_info SET username = '$new_name' WHERE userID = $userID";
            $update_name_query1= "UPDATE group_info SET group_creator = '$new_name' WHERE userID = $userID";
            $update_name_query_result = mysqli_query($conn, $update_name_query);
            $update_name_query_result1 = mysqli_query($conn, $update_name_query1);
            if($update_name_query_result){

                $from = "../../Profiles/". $_SESSION["username"] ; //Old directory
                $to = "../../Profiles/". $new_name ; //new directory
                // echo "From <a href='$from'>Yes</a> to <a href='$to'>No</a>";
                // $opendir = opendir($from);
                // while($files = readdir($opendir)){
                //     if(($files != ".") && ($files != "..") && ($files != "Thumbs.db")){     
                //     }
                // }
                rename($from, $to);
                $_SESSION["username"] = $new_name;
            }

            echo "<p class='success'>Successfully updated name</p>";

            header("Refresh:1.5; url=../settings.php?idi=$G_ID");
        }else{
            echo "<p class='error'>Name already exist, please use a different name</p>";
            header("Refresh:2.5; url=../settings.php?idi=$G_ID");
        }


    }


?>