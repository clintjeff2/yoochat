<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="create_group.css">
</head>

</head>
    <body>

    <h2>Modal Login Form</h2>

    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>


    <!-- The below is for the creation of the Create group form. -->
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>

            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Group Name..." name="G-name" required>

                <label for="psw"><b>Created by :</b></label>
                <input type="text" placeholder="My Name..." name="myname" required>

                <label for="G-file"><b>Upload Group Profile image</b></label>
                <input type="file" name="G-file">
                    
                <button type="submit" name="G-create">Ok</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    </script>

</body>

</html>