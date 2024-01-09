<?php

    //connect
    include "../../Extra/connect.php";

    //valide file
    include "../../Valid_input.php";


    if(isset($_POST["send_G_file"])){
        $userID = Valide_input($_REQUEST["idi"]);
        $G_ID = Valide_input($_POST["myID"]);
        $file = $_FILES["new_G_profile"];

        $query = "SELECT * FROM group_info WHERE groupID = $G_ID";
        $query_results = mysqli_query($conn, $query);
        $results = mysqli_fetch_assoc($query_results);

        $file_name = basename($file["name"]);
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_temp = $file["tmp_name"];
        $dir = "../../Groups/". $results["group_name"]. "/Media/Profile/";

        //check if you are the group Admin
        if($results["userID"] == $userID){
            //check if file is of valid type
            if(($file_type == "jpg") || ($file_type == "jpeg") || ($file_type == "png") || ($file_type == "bmp") || ($file["size"] == 0)){
                
                // echo "<a href='$dir'>Yes</a>";
                $opendir = opendir($dir);
                while($files = readdir($opendir)){
                    if($files != "." && $files != ".." && $files != "Thumbs.db"){
                        unlink($dir . $files);
                    }
                }

                $move = move_uploaded_file($file_temp, $dir . $file_name);

                $query = "UPDATE group_info SET group_profile_image = '$file_name' WHERE groupID = $G_ID";
                $query_results = mysqli_query($conn, $query);
                // echo print_r($file);
                echo "<p class='success'>Group Profile updated with success</p>";
                header("Refresh:1.5; url=../settings.php?idi=$G_ID");



            }else{
                echo "<p class='error'>File type not supported. Please choose a jpg, jpeg, png or bmp image</p>";
                header("Refresh:4; url=../settings.php?idi=$G_ID");
            }
        }else{
            echo "<p class='error'>You are not an Admin of this group, tell the Admin to change the Group's name</p>";
            header("Refresh:4; url=../settings.php?idi=$G_ID");
        }



    }


?>