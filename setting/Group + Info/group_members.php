<?php 
    //connect
    include "../../Extra/connect.php";

    $groupID = $_REQUEST["idi_G"];

    $query = "SELECT * FROM group_participants WHERE groupID = $groupID";
    $query_results = mysqli_query($conn, $query);
    $count = mysqli_num_rows($query_results);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group members | Yoochat</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="body">
    <header class="header">
        <img src="../../../img/logo.png" alt="LOGO" class="header__logo">
        <div class="header__links">
            <a href="<?php echo "../../chat.php?p_tab=$groupID" ?>">chat room</a>
            <a href="../../Logout/logout.php">logout</a>
            <a href="<?php echo "group_info.php?idi=$groupID"; ?>">back</a>
        </div>
    </header>
    <table class="mt-small table-list">
        <tr>
            <th>All Group Members (<?php echo $count; ?>)</th>
        </tr>
        <?php
            
            while($results = mysqli_fetch_assoc($query_results)){
                $GM_name = $results["member_name"];
                echo "<tr>";
                echo    "<td>$GM_name</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>