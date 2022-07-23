<?php
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['usrname'])) {
header('Location: index.php');
}
?>
<?php include('navbar.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FTP</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
</head>
<body>

<div class="row">
 
 <div class="colm-form">
     <div class="form-container">
         <form action="upload.php" method="post" enctype="multipart/form-data">
         <label id="file-name">File Uploaded</label>
             <p>&nbsp;</p> 
             <input class="btn-login" type="button" onclick="document.getElementById('fileToUpload').click()" value="Choose File">
             <input type="file" name="fileToUpload" id="fileToUpload" style="display:none">
             <input class="btn-login" type="submit" value="Upload File" name="submit">
            </form>
        </div>
    </div>
</div>     
<script>
document.querySelector("#fileToUpload").onchange = function()
{
    document.querySelector("#file-name").textContent = this.files[0].name;
}
</script>

</body>
</html>
