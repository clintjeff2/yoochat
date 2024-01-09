<?php
    //connect
    include "../../Extra/connect.php";

    //include valid file
    include "../../Valid_input.php";


    if(isset($_POST["delete-user"])){
        $G_ID = Valide_input($_POST["myID"]);
        $username = Valide_input($_POST["p_name"]);
        $user = Valide_input($_SESSION["username"]);
        $userID = Valide_input($_REQUEST["idi"]);

        //Check if user is Group Admin.
        $check_query = "SELECT * FROM group_info WHERE group_creator = '$user' AND  groupID = $G_ID";
        $check_query_results = mysqli_query($conn, $check_query);
        $count = mysqli_num_rows($check_query_results);

        if($count == 1){
            if($username == $user){
                $query = "DELETE FROM group_info WHERE groupID=$G_ID AND group_creator = '$user'";
                $query_result = mysqli_query($conn, $query);
            }
            $query = "DELETE FROM group_participants WHERE groupID=$G_ID";
            $query_result = mysqli_query($conn, $query);

            //Add Message of "You added bla bla to group"
            $query = "INSERT INTO all_messages(userID, message_date, message_time, message_text, groupID, added_text) VALUES 
            ($userID, '', '', '', $G_ID, 'Removed $username')";
            $query_results = mysqli_query($conn, $query);

            echo "<p class='success'>You removed a group member</p>";
            header("Refresh:1.5; url=../settings.php?idi=". $G_ID);
        }else{
            echo "<p class='error'>You are not the Group Admin of this group</p>";
            header("Refresh:2.5; url=../settings.php?idi=". $G_ID);
        }
        
    }

?>