<!DOCTYPE html>
<html>
<?php
    require "../functions.php";
    
    //cacheNum is a variable holding the string for whatever number cache it is change for each file
    $cacheNum = "cache01";
    
    $password = $_GET['password'];
    //change the hash for every new cache page
    $passIsCorrect = testPassword($password,'$2y$10$JaW.5tOlfGFZEOSqi8Lb.OrJrS2o5xkbFOy9CJDn1eEYZerAJslsq');
    
    printHead("$cacheNum Found","../");
?>
<body>
    <?php
        printHeader("../");
    ?>
    <div class="body">
    <div class="outer-wrapper">
    <div class="content-wrapper">
    <h2>Cache01</h2>
    <p>Congrats on finding and scanning this small QR code. If you would like you can enter your information below and it will be entered into the find log. You can put your name, where you found it (city,cache name), and any comments you want to share. After you enter your information you can click the globe at the top of the screen to view where it has been.</p>
    <?php
        //sleep(1) delays the page for one second before testing the password
        //I am no genius but I feel like this will mitigate spam from trying to
        //"brute-force" the correct password
        sleep(1);
        if($passIsCorrect){
            if(isset($_POST['name']) && isset($_POST['location'])){
                $name = $_POST['name'];
                $location = $_POST['location'];
                $comments = $_POST['comments'];
                addTextToFile("../$cacheNum.txt",$name,$location,$comments);
            }else{
                displayInputForm("$cacheNum.php?password=$password");
            }
        }else{
            echo 'incorrect password';
        }
    ?>
    </div>
    </div>
    </div>
    <?php
        printFooter();
    ?>
    <script src="../scripts/getLocation.js"></script>
</body>
</html>