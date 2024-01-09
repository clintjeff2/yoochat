<?php
    //Connecting to database
    include "../Extra/connect.php";
    include "../Valid_input.php";

    //Declaration and initialization of users information
    $username = Valide_input($_POST["S-name"]);
    $email = Valide_input($_POST["S-email"]); 
    $password = Valide_input($_POST["S-password"]);
    $cpassword = Valide_input($_POST["S-cpassword"]);
    $submit = Valide_input($_POST["signup-submit"]);

    //Profile picture information per user
    $file = $_FILES["S-profile"];
    $file_name = basename($file["name"]);
    $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_temp_name = $file["tmp_name"];

    $dir = "../Profiles/$username/images/";
    $mk_dir = mkdir($dir, 0777, true);
    $open = opendir($dir);
    move_uploaded_file($file_temp_name, $dir . $file_name);

    //Setting defile profile picture.
    // $file_name = (!isset($file_name)) ? "default_profile_image.jpeg" : $file_name;
    // echo $file_name;

    $user_insert_query = "INSERT INTO users_info(username, password, email, profile_image) VALUES('$username', '". md5($password) ."', '$email', '$file_name')";

    //check if username and email already exists
    //users
    $get_users_fromDB_query = "SELECT * FROM users_info WHERE username = '$username'";
    $get_users_fromDB_query_results = mysqli_query($conn, $get_users_fromDB_query);
    //email
    $get_email_fromDB_query = "SELECT * FROM users_info WHERE email = '$email'";
    $get_email_fromDB_query_results = mysqli_query($conn, $get_email_fromDB_query);

    $count_email = mysqli_num_rows($get_email_fromDB_query_results); //email count
    $count_username = mysqli_num_rows($get_users_fromDB_query_results); //username count

    
    
    if($email && $username && $password && $cpassword && $submit){
        if(strlen($password) > 4){
            if($password == $cpassword){
                if($count_username == 0){
                    if($count_email == 0){
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $user_insert_query_results = mysqli_query($conn, $user_insert_query);
                            if($user_insert_query_results){
                                echo "<p class='success'>Registered Successfully</p>";
                                
                                header("location:../log/log-in.html");
                            }else{
                                echo "<p class='error'>Error in registering</p>";
                                header("Refresh:3; url=sign-up.html");
                            }
                        }else{
                            echo "<p class='error'>Your email is invalid.</p>";
                            header("Refresh:3; sign-up.html");
                        }
                    }else{
                        echo "<p class='error'>Email already exist. Use different a email address</p>";
                        header("Refresh:3; url=sign-up.html");
                    }
                }else{
                    echo "<p class='error'>A user with your name already exist. Use a different name</p>";
                    header("Refresh:3; url=sign-up.html");
                } 
            
            }else{
                echo "<p class='error'>Passwords don't match. Please make sure they do.</p>";
                header("Refresh:3; url=sign-up.html");
            }
        }else{
            echo "<p class='error'>Password should be more than 4 letters</p>";
            header("Refresh:3; url=sign-up.html");
        }

        
    }else{
        echo "<p class='error'>Please all fields are required, except for the file.</p>";
        header("Refresh:3; url=sign-up.html");
    }
    
?>