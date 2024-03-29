<?php

    //connect
    include "../Extra/connect.php";

    //Select user ID
    $query = "SELECT * FROM users_info WHERE username ='". $_SESSION["username"]. "'";
    $query_results = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($query_results);
    $userID = $result["userID"];

    $groupp = $_REQUEST["idi"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Yoochat</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header class="header">
        <img src="../img/logo.png" alt="LOGO" class="header__logo">
        <div class="header__links">
            <a href="<?php echo "../chat.php?p_tab=$groupp"; ?>">chat room</a>
            <a href="../Logout/logout.php">logout</a>
            <!-- <a href="#">signup</a> -->
        </div>
    </header>
    <section class="section--mains">
        <div class="settings__item settings__edit-username">
            <svg class="avatar-icon">
                <use xlink:href="../img/sprite.svg#icon-user"></use>
            </svg>
            <a href="#" class="text change__name"><span>Change Your Name</span></a>
        </div>
        <div class="settings__item settings__edit-username">
            <img src="../img/profile_image.png" alt="Profile picture">
            <a href="#" class="text change__p-pic"><span>Change Profile Picture</span></a>
        </div>
        <div class="settings__item settings__edit-username">
            <svg class="avatar-icon">
                <use xlink:href="../img/sprite1.svg#icon-users"></use>
            </svg>
            <a href="#" class="text change__g-pic"><span>Change Group image</span></a>
        </div>
        <div class="settings__item settings__edit-username">
            <svg class="avatar-icon">
                <use xlink:href="../img/sprite1.svg#icon-lock"></use>
            </svg>
            <a href="#" class="text change__pass"><span>Change Your Password</span></a>
        </div>
        <div class="settings__item settings__edit-username">
            <svg class="avatar-icon">
                <use xlink:href="../img/sprite1.svg#icon-users"></use>
            </svg>
            <a href="#" class="text change__g-name"><span>Change Group Name</span></a>
        </div>
        <div class="settings__item settings__edit-username">
            <svg class="avatar-icon">
                <use xlink:href="../img/sprite1.svg#icon-info"></use>
            </svg>
            <a href="<?php echo "Group + info/group_info.php?idi=$groupp"; ?>" class="text"><span>Your Groups + Info</span></a>
        </div>
        <div class="settings__item settings__edit-username">
            <svg class="avatar-icon">
                <use xlink:href="../img/sprite.svg#icon-bin"></use>
            </svg>
            <a href="#" class="text remove__member" ><span>Remove group participant</span></a>
        </div>
        <div class="settings__item settings__edit-username">
            <svg class="avatar-icon">
                <use xlink:href="../img/sprite1.svg#icon-user-plus"></use>
            </svg>
            <a href="#" class="text add__member" ><span>Add group participant</span></a>
        </div>
    </section>

    <div class="container-modal container-modal-1" >
        <div class="modal animate-modal" id="modal-1">
            <form class="modal-form" action="<?php echo "Change information/change-username.php?idi=$userID" ;?>" method="post" enctype="multipart/form-data">
                <div class="modal-close">
                    <span class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                <input type="hidden" value="<?php echo ($_REQUEST["idi"] == 0 || !isset($_REQUEST["idi"]))? '': $_REQUEST["idi"]; ?>" name="myID">
                    <label for="uname"><b>Enter new name</b></label>
                    <input type="text" placeholder="New Name..." name="new_name" required class="mt-small mb-small border">  
                    <button type="submit" name="send_new_name" class="btn submit-btn">Okk</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-modal container-modal-2" >
        <div class="modal animate-modal" id="modal-2">
            <form class="modal-form" action="<?php echo "Change information/update_user-profile.php?idi=$userID" ;?>" method="post" enctype="multipart/form-data">
                <div class="modal-close">
                    <span class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                <input type="hidden" value="<?php echo ($_REQUEST["idi"] == 0 || !isset($_REQUEST["idi"]))? '': $_REQUEST["idi"]; ?>" name="myID">
                    <label for="uname"><b>Update your profile picture</b></label>
                    <input type="file" name="new_profile" required class="mt-small mb-small border">
                    <button type="submit" name="send_file" class="btn submit-btn">Ok</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-modal container-modal-3" >
        <div class="modal animate-modal" id="modal-3">
            <form class="modal-form" action="<?php echo "Change information/update_group-profile.php?idi=$userID" ;?>" method="post" enctype="multipart/form-data">
                <div class="modal-close">
                    <span class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <label for="uname"><b>Update your Group profile picture.</b></label>
                    <input type="file" name="new_G_profile"  class="mt-small mb-small border">

                    <label for="psw"><b>Enter Group ID code</b></label>
                    <input type="text" value="<?php echo ($_REQUEST["idi"] == 0 || !isset($_REQUEST["idi"]))? '': $_REQUEST["idi"]; ?>" name="myID" required class="mt-small mb-small border">
                    <button type="submit" name="send_G_file" class="btn submit-btn">Ok</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-modal container-modal-4" >
        <div class="modal animate-modal" id="modal-4">
            <form class="modal-form" action="<?php echo "Change information/change-password.php?idi=$userID" ;?>" method="post" enctype="multipart/form-data">
                <div class="modal-close">
                    <span class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <input type="hidden" value="<?php echo ($_REQUEST["idi"] == 0 || !isset($_REQUEST["idi"]))? '': $_REQUEST["idi"]; ?>" name="myID">
                    <label for="uname"><b>Enter old password</b></label>
                    <input type="password" placeholder="New Name..." name="old_psw" required class="mt-small mb-small border">

                    <label for="uname"><b>Enter new password</b></label>
                    <input type="password" placeholder="Enter pass.." name="new_psw" required class="mt-small mb-small border">

                    <label for="uname"><b>Confirm new password</b></label>
                    <input type="password" placeholder="Confirm pass..." name="cnew_psw" required class="mt-small mb-small border">
                    <button type="submit" name="send_psw" class="btn submit-btn">Ok</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-modal container-modal-5" >
        <div class="modal animate-modal" id="modal-5">
            <form class="modal-form" action="<?php echo "Change information/change-group_name.php?idi=$userID" ;?>" method="post" enctype="multipart/form-data">
                <div class="modal-close">
                    <span class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <label for="uname"><b>Enter Group's New Name</b></label>
                    <input type="text" placeholder="New Name..." name="G_new_name" required class="mt-small mb-small border">

                    <label for="psw"><b>Enter Group ID code</b></label>
                    <input type="text" value="<?php echo ($_REQUEST["idi"] == 0 || !isset($_REQUEST["idi"]))? '': $_REQUEST["idi"]; ?>" name="myID" required class="mt-small mb-small border">
                      
                    <button type="submit" name="send_G_new_name" class="btn submit-btn">Ok</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-modal container-modal-7" >
        <div class="modal animate-modal" id="modal-7">
            <form class="modal-form" action="<?php echo "Add Group Member/add_group_member.php?idi=$groupp" ;?>" method="post" enctype="multipart/form-data">
                <div class="modal-close">
                    <span class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <label for="uname"><b>Enter participant's name</b></label>
                    <input type="text" placeholder="Participants Name..." name="mem_add" required class="mt-small mb-small border">

                    <label for="psw"><b>ID of group to add user in.</b></label>
                    <input type="text" value="<?php echo ($_REQUEST["idi"] == 0)? '': $_REQUEST["idi"]; ?>" name="myID" required class="mt-small mb-small border">

                    <button type="submit" name="G-add-mem" class="btn submit-btn">Ok</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-modal container-modal-6" >
        <div class="modal animate-modal" id="modal-6">
            <form class="modal-form" action="<?php echo "Delete/delete-user.php?idi=$userID" ;?>" method="post" enctype="multipart/form-data">
                <div class="modal-close">
                    <span class="close" title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <label for="uname"><b>Name of participant to remove</b></label>
                    <input type="text" name="p_name" required placeholder="Name to delete from group" class="mt-small mb-large">

                    <label for="psw"><b>Enter Group ID code</b></label>
                    <input type="text" value="<?php echo ($_REQUEST["idi"] == 0 || !isset($_REQUEST["idi"]))? '': $_REQUEST["idi"]; ?>" name="myID" required class="mt-small mb-small border">

                    <button type="submit" name="delete-user" class="btn submit-btn">Ok</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        const modalClose = document.querySelectorAll('.close');
        // const modal = document.getElementById('modal');
        const submitBtn = document.querySelectorAll('.submit-btn');
        const changeName = document.querySelector('.change__name');
        const changePpic = document.querySelector('.change__p-pic');
        const changeGpic = document.querySelector('.change__g-pic')
        const changePass = document.querySelector('.change__pass');
        const changeGname = document.querySelector('.change__g-name');
        const memberAdd = document.querySelector('.add__member');
        const memberRemove = document.querySelector('.remove__member');
        
        const popModal = (number, element) => {
            const modalContainer = document.querySelector(`.container-modal-${number}`);
            const modal = document.getElementById(`modal-${number}`);
            modalClose.forEach(el => {
                el.addEventListener('click', () =>{
                    modalContainer.style.display = 'none';
                    modal.classList.remove('animate-modal');
                });
            });

            submitBtn.forEach(el => {
                el.addEventListener('click', () =>{
                    modalContainer.style.display = 'none';
                    modal.classList.remove('animate-modal');
                })
            });
            window.onclick = function(event){
                // if(!event.path.includes(element) && !event.path.includes(modal)){
                //     modalContainer.style.display = 'none';
                //     modal.classList.remove('animate-modal');
                // }
                if(event.target.classList.contains('container-modal')){
                modalContainer.style.display = 'none';
                modal.classList.remove('animate-modal');
            }
            }

            modalContainer.style.display = 'block';
            modal.classList.add('animate-modal');
        }
        changeName.addEventListener('click', () =>{
            popModal(1, changeName);
        });
        changePpic.addEventListener('click', () =>{
            popModal(2, changePpic);
        });
        changeGpic.addEventListener('click', () =>{
            popModal(3, changeGpic);
        });
        changePass.addEventListener('click', () =>{
            popModal(4, changePass);
        });
        changeGname.addEventListener('click', () =>{
            popModal(5, changeGname);
        });
        memberAdd.addEventListener('click', () =>{
            popModal(7, memberAdd);
        });
        memberRemove.addEventListener('click', () =>{
            popModal(6, memberRemove);
        });

    </script>
</body>
</html>