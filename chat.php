<?php
    //connect
    include "Extra/connect.php";
    //valide file
    include "Valid_input.php";
    $Chat_name = $_SESSION["username"];

    $user_info_query = "SELECT * FROM users_info WHERE username = '". $_SESSION["username"] ."'";
    $user_info_query_results = mysqli_query($conn, $user_info_query);
    $row1 = mysqli_fetch_assoc($user_info_query_results);
    $profile_image = $row1["profile_image"];
    $U_ID = $row1["userID"];

    $groupID = (isset($_REQUEST["p_tab"])) ? $_REQUEST["p_tab"]: 0;  
    $group_info_query1 = "SELECT * FROM group_info WHERE groupID=". $groupID;
    $group_info_query1_results = mysqli_query($conn, $group_info_query1);
    $row4 = mysqli_fetch_assoc($group_info_query1_results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat | Yoochat</title>
    <link rel="stylesheet" href="css/style-chat.css">
</head>
<body>
    <?php
        //Script to Create a Group
        date_default_timezone_set("Africa/Douala");
        $date = date("Y-m-d");
        if(isset($_POST["G-create"])){
            $Group_name = Valide_input($_POST["G-name"]);
            $group_creator = Valide_input($_POST["myname"]);
            // $group_file = (empty($_FILES["G-file"]) && $_FILES["G-file"] != "") ? $_FILES["G-file"]: "group_profile_image.jpg";
            $group_file = $_FILES["G-file"];
            $group_file_name = basename($group_file["name"]);
            $group_file_type = pathinfo($group_file_name, PATHINFO_EXTENSION);
            $group_file_tmp = $group_file["tmp_name"];

            $dir = "Groups/$Group_name/Media/Profile/";
            $mkdir = mkdir($dir, 0777, true);

            if(($group_file_type == "jpg") || ($group_file_type == "jpeg") || ($group_file_type == "png") || ($group_file_type == "bmp") || ($group_file_type == "webp")){
                $upload = move_uploaded_file($group_file_tmp, $dir.$group_file_name);
                if($upload){
                    echo "<script>alert('It worked out')</script>";
                    header("Refresh:3; url=chat.php");
                }
            }

            $create_group_query = "INSERT INTO group_info(Group_name, group_bdate, group_creator, group_profile_image, userID) VALUES
                (".'"'.$Group_name. '",'. "'$date', '$group_creator', '$group_file_name',". $row1["userID"]. ")";
                header("Refresh:0; url=chat.php");
            if($Group_name != "" && $group_creator != ""){
                $create_group_query_results = mysqli_query($conn, $create_group_query);
                header("location: chat.php");
            }
        }
    ?>
    <div class="chat--app">
        <header class="header">
            <div class="profile">
                <a href="<?php echo (isset($profile_image) && $profile_image != '') ?  "Profiles/$Chat_name/images/$profile_image": "App_default/Media/Profile/profile_image.png";?>" target="_blank">
                    <img src="<?php echo (isset($profile_image) && $profile_image != '') ?  "Profiles/$Chat_name/images/$profile_image": "App_default/Media/Profile/profile_image.png";?>" alt="PROFILE" class="img-profile">
                </a>
                <span class="name"><?php echo $Chat_name; ?></span>
            </div>
            <div class="group">
                <button class="btn create--group" type="button">
                    <svg class="add">
                        <use xlink:href="img/sprite.svg#icon-plus"></use>
                    </svg>
                </button>
                <span class="group--name">
                    <?php echo (isset($_REQUEST["p_tab"]) && $_REQUEST["p_tab"] != 0) ? $row4["group_name"]: "Group Name"; ?>
                    <!-- Landmark Engineering -->
                </span>
            </div>
            <div class="settings">
                <!-- Make this conditional later on -->
                <?php echo (isset($_REQUEST["p_tab"]) && $_REQUEST["p_tab"] != 0) ? 
                    '<a href="setting/settings.php?idi='. $groupID .'" title="Check your settings" class="check__settings">
                        <button class="btn"  title="check settings">
                                <svg class="settings">
                                    <use xlink:href="img/sprite.svg#icon-cog"></use>
                                </svg>
                        </button>
                    </a>'
                    : ""; 
                ?>
            </div>
        </header>
        <section class="section--main">
            <div class="contact__list">
                <?php
                    //Script to display participants groups(all)

                    $group_list_query = "SELECT * FROM group_info WHERE userID =". $row1["userID"]. " ORDER BY groupID DESC";
                    $group_list_query1 = "SELECT group_info.Group_name, group_info.group_profile_image, group_info.groupID, group_participants.member_name, 
                        group_participants.time_joined, group_participants.groupID FROM group_info, group_participants WHERE 
                        group_info.groupID = group_participants.groupID AND group_participants.userID = $U_ID";
                    $group_list_query1_results = mysqli_query($conn, $group_list_query1);
                    $group_list_query_results = mysqli_query($conn, $group_list_query);

                    //Printing all groups where user is the group Admin.
                    $i = 1;
                    while($row3 = mysqli_fetch_assoc($group_list_query_results)){
                        $group_name = $row3["group_name"]; 
                        $group_file = $row3["group_profile_image"];
                        $groupIDi = $row3["groupID"];

                        $path = ($row3["group_profile_image"] != '') ? "Groups/$group_name/Media/Profile/$group_file": "App_default/Media/Profile/group_profile_image.jpg";

                        echo '<div class="contact__item">';
                        echo    '<a href="'.$path .'" target="_blank"><img src="'. $path. '" alt="Group chat profile" class="img-profile"></a>';
                        echo    '<a href="chat.php?p_tab='. $groupIDi .'"" class="group_name"><div class="contact__item__name">'.$group_name. '</div></a>';
                        echo '</div>';
                    }
                    //later on, use the print_r() on the while loop above and below to see how you can put to defuat guiding text here.

                    //Printing all groups where user is not the group admin.
                    while($row5 = mysqli_fetch_assoc($group_list_query1_results)){
                        $group_name = $row5["Group_name"]; 
                        // $group_file = $row5["group_profile_image"];
                        $groupIDi = $row5["groupID"];
                        

                        $group_file = ($row5["group_profile_image"] != '') ? $row5["group_profile_image"]: "group_profile_image.jpg";
                        // echo "A<span style='background-color:red;'>$group_file</span>B";

                        $path = ($row5["group_profile_image"] != '') ? "Groups/$group_name/Media/Profile/$group_file": "App_default/Media/Profile/group_profile_image.jpg";

                        echo '<div class="contact__item">';
                        echo    '<a href="'. $path .'" target="_blank"><img src="'. $path. '" alt="Group chat profile" class="img-profile"></a>';
                        echo    '<a href="chat.php?p_tab='. $groupIDi .'"" class="group_name"><div class="contact__item__name">'.$group_name. '</div></a>';
                        echo '</div>';
                    }

                ?>
                <!-- <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">The Tag Team</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">LMU Staff</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">Reigns and Rollins</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">The Ouzoos</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">KO & Jericho </div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">The Ouzoos</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">The Tag Team</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">LMU Staff</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">Reigns and Rollins</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">The Ouzoos</div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">KO & Jericho </div>
                    </a>
                </div>
                <div class="contact__item">
                    <a href="../img/profile_image.png" target="_blank">
                        <img src="../img/profile_image.png" alt="Group chat profile" class="img-profile">
                    </a>
                    <a href="index.php?p_tab='. $groupIDi .'" class="group_name">
                        <div class="contact__item__name">The Ouzoos</div>
                    </a>
                </div> -->
            </div>
            <?php
                //Script to send  text message.
                if(isset($_POST["submit"]) && $_POST["submit"] != ""){

                    $Message = "";
                    $Message = Valide_input($_POST["message"]);

                    if(isset($Message) && $Message != ""){
                        //Dealing with dates and time
                        
                        $time = date("h:i a");
                        $date = date("Y-m-d");
                        $userID = $row1["userID"];

                        $send_message_query = "INSERT INTO all_messages(userID, message_date, message_time, message_text, groupID) VALUES 
                        ($userID, '$date', '$time', ".'"'. $Message. '",'. $groupID .")";
                        if(isset($_REQUEST["p_tab"]) && $_REQUEST["p_tab"] != 0){
                            $send_message_query_results = mysqli_query($conn, $send_message_query);
                            // header("location:chat.php?p_tab=$groupID");
                        }
                        //echo "<p class = 'success'>$date</p>";
                    }else{
                        echo "<script> alert('Type a message before sending')</script>";
                    }
                    $_POST["submit"] = "";
                }
            ?>
            <div class="chat--site">
                <div class="chat--place">
                    <?php

                        //Script for displaying text message for a particular group, automatic/dynamic

                        $message_from_db_query = "SELECT * FROM  all_messages WHERE groupID=". $groupID;
                        $message_from_db_query_results = mysqli_query($conn, $message_from_db_query);
                        //Display message for "You created group"
                        $query = "SELECT * FROM group_info WHERE groupID=". $groupID;
                        $query_results = mysqli_query($conn, $query);
                        $results = mysqli_fetch_assoc($query_results);
                        $i = 1;
                        if(isset($_REQUEST["p_tab"]) && $_REQUEST["p_tab"] != 0){
                            if($results["group_creator"] == $Chat_name){
                                echo "<div class='creator__text' style='align-self:center; border-radius:3rem; color:white; padding: 1rem; font-size: 1.2rem; background: linear-gradient(to bottom right, #BA265D, #eb2f64, #FF3366);'>You Created Group</div>";
                            }else{
                                echo "<div class='creator__text' style='align-self:center; border-radius:3rem; color:white; padding: 1rem; font-size: 1.2rem; background: linear-gradient(to bottom right, #BA265D, #eb2f64, #FF3366);'>". $results["group_creator"]. " Created Group</div>";
                            }
                            
                        }else{
                            echo "<div class='creator__text' style='align-self:center; border-radius:3rem; color:white; padding: 1rem; font-size: 1.2rem; background: linear-gradient(to bottom right, #BA265D, #eb2f64, #FF3366);'>Please choose group to have conversations with friends.</div>";
                        }
                        while($row2 = mysqli_fetch_assoc($message_from_db_query_results)){
                            $specific_user_message_query = "SELECT * FROM users_info WHERE userID = ". $row2["userID"];
                            $specific_user_message_query_results = mysqli_query($conn, $specific_user_message_query);

                            //Present username in the group, when displaying messages from the database.
                            $P_username = mysqli_fetch_assoc($specific_user_message_query_results);
                            if($row2["message_text"] != ''){
                                echo ($row1["userID"] == $row2["userID"]) ? '<div class="chat__main__user-message my__message">': '<div class="chat__main__user-message">';
                                echo    '<section class="username-and-time">
                                            <h4>'. $P_username["username"].'</h4>
                                            <div class="message-time">'. $row2["message_time"]."|" .$row2["message_date"] .'</div>
                                        </section> 
                                        <div class="message"><pre style="font-family:verdana;white-space: pre-wrap;letter-spacing: .1rem;">'. $row2["message_text"] .'</pre></div>   
                                    </div>';
                            }else{
                                if(isset($row2["added_text"])){
                                    if($results["group_creator"] == $Chat_name){
                                        echo "<div class='creator__text' style='align-self:center; border-radius:3rem; color:white; padding: 1rem; font-size: 1.2rem; background: linear-gradient(to bottom right, #BA265D, #eb2f64, #FF3366);'>". "You " . $row2["added_text"]."</div>";
                                    }else{
                                        echo "<div class='creator__text' style='align-self:center; border-radius:3rem; color:white; padding: 1rem; font-size: 1.2rem; background: linear-gradient(to bottom right, #BA265D, #eb2f64, #FF3366);'>". $results["group_creator"]. " " .str_replace($Chat_name, "You", $row2["added_text"])."</div>";
                                    }
                                }
                            }       
                        }
                    ?>
                    <!-- <div class="chat__main__user-message my__message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem</div>   
                    </div>
                    <div class="chat__main__user-message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">.</div>   
                    </div>
                    <div class="chat__main__user-message my__message">
                        <section class="username-and-time">
                            <h4>A user</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message my__message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message my__message">
                        <section class="username-and-time">
                            <h4>A user</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message my__message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message my__message">
                        <section class="username-and-time">
                            <h4>A user</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message my__message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message my__message">
                        <section class="username-and-time">
                            <h4>A user</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div>
                    <div class="chat__main__user-message">
                        <section class="username-and-time">
                            <h4>Username</h4>
                            <div class="message-time">9:45 am</div>
                        </section>
                        <div class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad dignissimos totam voluptatibus nostrum.</div>   
                    </div> -->
                </div>
                <div class="message--place"> 
                    <form action="<?php echo 'chat.php?p_tab='. $groupID ;?>" method="post" class="message__form">
                        <textarea type="text" name="message" id="message" class="chat__options__message" placeholder="Message..." rows="3" cols="40"></textarea>
                        <button type="submit" class="btn" title="Send message" name="submit" value="Me">
                            <svg class="send">
                                <use xlink:href="img/sprite.svg#icon-direction"></use>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <div class="container-modal" >
        <div class="modal animate-modal" id="modal">
            <form class="modal-form" action="" method="post" enctype="multipart/form-data">
                <div class="modal-close">
                    <span class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <label for="uname"><b>Enter group name*</b></label>
                    <input type="text" placeholder="Group Name..." name="G-name" required>

                    <label for="psw"><b>Created by* :</b></label>
                    <input type="text" placeholder="Creator..." value="<?php echo $Chat_name; ?>" name="myname" required >

                    <label for="G-file"><b>Upload Group Profile image</b></label>
                    <input type="file" name="G-file" >
                        
                    <button type="submit" name="G-create" class="btn submit-btn">Ok</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        const modalClose = document.querySelector('.close');
        const modal = document.getElementById('modal');
        const submitBtn = document.querySelector('.submit-btn');
        const createGroup = document.querySelector('.create--group');
        const modalContainer = document.querySelector('.container-modal');

        modalClose.addEventListener('click', () =>{
            modalContainer.style.display = 'none';
            modal.classList.remove('animate-modal');
        });
        submitBtn.addEventListener('click', () =>{
            modalContainer.style.display = 'none';
            modal.classList.remove('animate-modal');
        })
        window.onclick = function(event){
            // if(!event.path.includes(createGroup) && !event.path.includes(modal)){
            //     modalContainer.style.display = 'none';
            //     modal.classList.remove('animate-modal');
            // }
            if(event.target.classList.contains('container-modal')){
                modalContainer.style.display = 'none';
                modal.classList.remove('animate-modal');
            }
        }
        createGroup.addEventListener('click', () =>{
            modalContainer.style.display = 'block';
            modal.classList.add('animate-modal');
        })
    </script>
    <script>
        const textView = document.querySelector('.chat--place');
        textView.scrollTo(0, textView.scrollHeight);
    </script>
</body>

</html>