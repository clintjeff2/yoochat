<?php
    //connect
    include "../../Extra/connect.php";

    //valide file
    include "../../Valid_input.php";

    if(isset($_POST["send_G_new_name"])){
        $new_G_name = Valide_input($_POST["G_new_name"]);
        $G_ID = Valide_input($_POST["myID"]);

        //Select group information for particular ID
        $query = "SELECT * FROM group_info WHERE groupID = $G_ID";
        $query_results = mysqli_query($conn, $query);
        $query_results = mysqli_fetch_assoc($query_results);

        //Check if user is the creator of the group
        if($query_results["group_creator"] == $_SESSION["username"]){
            $query = "UPDATE group_info SET Group_name = '$new_G_name' WHERE groupID = $G_ID";
            $query_results = mysqli_query($conn, $query);

            echo "<p class='success'>Group name updated!!</p>";
            header("Refresh:1.5; url=../settings.php?idi=$G_ID");

        }else{
            echo "<p class='error'>You are not an Admin of this group, tell the Admin to change the Group's name</p>";
            header("Refresh:4; url=../settings.php?idi=$G_ID");
        }
        
    }




?>