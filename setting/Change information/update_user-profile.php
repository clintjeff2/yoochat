<?php

    //connect
    include "../../Extra/connect.php";

    //valide file
    include "../../Valid_input.php";

    if(isset($_POST["send_file"])){

        $userID = Valide_input($_REQUEST["idi"]);
        $file = $_FILES["new_profile"];
        $G_ID = Valide_input($_POST["myID"]);
        $file_name = basename($file["name"]);
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_temp = $file["tmp_name"];

        //check the file extension
        if(($file_type == "jpg") || ($file_type == "jpeg") || ($file_type == "png") || ($file_type == "bmp")){
            //Delete old profile picture
            $dir = "../../Profiles/". $_SESSION["username"]. "/images/";
            $opendir = opendir($dir);
            // $readdir = readdir($opendir);
            while($files = readdir($opendir)){
                if($files != ".." && $files != "." && $files != "Thumbs.db"){
                    unlink($dir . $files);
                }
                
            }
            //upload new file
            $move = move_uploaded_file($file_temp, $dir . $file_name);

            if($move){
                //update database profile
                $query = "UPDATE users_info SET profile_image = '$file_name' WHERE userID = $userID";
                $query_results = mysqli_query($conn, $query);
                echo "<p class='success'>Profile updated with success</p>";
                header("Refresh:1.5; url=../settings.php?idi=$G_ID");
            }else{
                echo "<p class='error'>Profile not updated.</p>";
                header("Refresh:2; url=../settings.php?idi=$G_ID");
            }
            

        }else{
            echo "<p class='error'>File type not supported. Please choose a jpg, jpeg, png or bmp image</p>";
            header("Refresh:4; url=../settings.php?idi=$G_ID");
        }

    }

?>