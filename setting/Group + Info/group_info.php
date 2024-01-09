<?php
    //connect
    include "../../Extra/connect.php";

    //Select user ID
    $groupp = $_REQUEST["idi"];
    $query = "SELECT * FROM users_info WHERE username ='". $_SESSION["username"]. "'";
    $query_results = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($query_results);
    $userID = $result["userID"];

    //Select all information from group_info and all from group_participants
    $I_groupinfo_query = "SELECT * FROM group_info WHERE userID = ".$userID;
    $I_groupinfo_query_results = mysqli_query($conn, $I_groupinfo_query);
    
    $I_grouppipo_query = "SELECT * FROM group_participants WHERE userID = $userID";
    $I_grouppipo_query_results = mysqli_query($conn, $I_grouppipo_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group info | Yoochat</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="body">
    <header class="header">
        <img src="../../../img/logo.png" alt="LOGO" class="header__logo">
        <div class="header__links">
            <a href="<?php echo "../../chat.php?p_tab=$groupp"; ?>">chat room</a>
            <a href="../../Logout/logout.php">logout</a>
            <a href="<?php echo "../settings.php?idi=$groupp"; ?>">back</a>
        </div>
    </header>
    <table class="mt-small">
        <tr>
            <th>Group Name</th>
            <th>Group ID</th>
            <th>Group Admin</th>
            <th>Date Created</th>
            <th>Date Added</th>
        </tr>
        <tr>
            <td colspan="5">To view all group members of a group, click on the group Admin's name.</td>
        </tr>
        <?php

            while($row = mysqli_fetch_assoc($I_groupinfo_query_results)){
                $G_name = $row["group_name"];
                $G_ID = $row["groupID"];
                $G_Admin = "You";
                $G_bdate = $row["group_bdate"];
                $G_added = "N/A";
                echo "<tr>";
                echo    "<td>$G_name</td>
                        <td>$G_ID</td>
                        <td><a href='group_members.php?idi_G=$G_ID'>$G_Admin</a></td>
                        <td>$G_bdate</td>
                        <td>$G_added</td>";
                echo "</tr>";
            }
            //Find who added me.
            // $query = "SELECT * FROM group_info WHERE groupID=";
            // $query_results = mysqli_query($conn, $query);
            // $record = mysqli_fetch_assoc($query_results);
            while($row = mysqli_fetch_assoc($I_grouppipo_query_results)){

                $G_dadded = $row["time_joined"];
                $G_ID = $row["groupID"];
                //Find who added me.
                $query = "SELECT * FROM group_info WHERE groupID=". $G_ID;
                $query_results = mysqli_query($conn, $query);
                $record = mysqli_fetch_assoc($query_results);

                $G_bdate = $record["group_bdate"];
                $G_name = $record["group_name"];
                $G_Admin = $record["group_creator"];
                

                echo "<tr>";
                echo    "<td>$G_name</td>
                        <td>$G_ID</td>
                        <td><a href='group_members.php?idi_G=$G_ID'>$G_Admin</a></td>
                        <td>$G_bdate</td>
                        <td>$G_dadded</td>";
                echo "</tr>";
            }


        ?>
    </table>
</body>
</html>