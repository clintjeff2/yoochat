<?php

    //connect to db
    include "../../Extra/connect.php";
    date_default_timezone_set("Africa/Douala");
    $time = date("Y-m-d");
    $user = $_SESSION["username"];

    //valide file
    include "../../Valid_input.php";

    if(isset($_POST["G-add-mem"])){
        $G_ID = Valide_input($_POST["myID"]);
        $member_toAdd = Valide_input($_POST["mem_add"]);

         //Get id of person you wish to add
        $user_info_query = "SELECT * FROM users_info WHERE username = '". $member_toAdd ."'";
        $user_info_query_results = mysqli_query($conn, $user_info_query);
        $row = mysqli_fetch_assoc($user_info_query_results);
        $counter = mysqli_num_rows($user_info_query_results);
        if($counter == 1){
            $userID = $row["userID"];
        }else{
            echo "<p class='error'>This person is not a user of this application</p>";
            header("Refresh:2.5; url=../settings.php?idi=". $G_ID);
            exit;
        }
        
        

        //Check if user exist in group already.
        $check_query = "SELECT group_participants.member_name, group_info.group_creator FROM group_participants, group_info WHERE 
            (group_info.group_creator = '$member_toAdd' AND group_info.groupID = $G_ID) OR (group_participants.userID=$userID AND group_participants.groupID=$G_ID)";
        $check_query_results = mysqli_query($conn, $check_query);
        $count = mysqli_num_rows($check_query_results);

        if($count == 0){
            //Check if you are group admin
            $check_query = "SELECT * FROM group_info WHERE group_creator = '$user' AND  groupID = $G_ID";
            $check_query_results = mysqli_query($conn, $check_query);
            $count = mysqli_num_rows($check_query_results);

            //Get group name
            $get_gname_query = "SELECT * FROM group_info WHERE  groupID = $G_ID";
            $get_gname_query_results = mysqli_query($conn, $get_gname_query);
            $row = mysqli_fetch_assoc($get_gname_query_results);
            $G_name = $row["group_name"];
            
            if($count == 1){
                $check_query_results = mysqli_query($conn, $check_query);
                $add_user_query = "INSERT INTO group_participants(groupID, member_name, time_joined, userID) VALUES($G_ID, '$member_toAdd', '$time', $userID)";
                $add_user_query_result = mysqli_query($conn, $add_user_query);
                echo "<p class='success'>Added to group with success</p>";
                //Add Message of "You added bla bla to group"
                $query = "INSERT INTO all_messages(userID, message_date, message_time, message_text, groupID, added_text) VALUES 
                ($userID, '', '', '', $G_ID, 'Added $member_toAdd')";
                $query_results = mysqli_query($conn, $query);

                header("Refresh:1.5; url=../settings.php?idi=". $G_ID);
            }else{
                echo "<p class='error'>You are not the Group Admin of $G_name</p>";
                header("Refresh:2.5; url=../settings.php?idi=". $G_ID);
            }
        }else{
            echo "<p class='error'>Member is creator or already part of the group</p>";
            header("Refresh:2.5; url=../settings.php?idi=". $G_ID);
        }
        
        

    }

?>