<!DOCTYPE html>
<html>
<?php
    require "../functions.php";
    
    //cacheNum is a variable holding the string for whatever number cache it is change for each file
    $cacheNum = "cache01";
    
    $password = $_GET['password'];
    //change the hash for every new cache page
    $passIsCorrect = testPassword($password,'$2y$10$uxQtb6qRwmibv0UiiqCVaOin6s3ePnNzNS61RBbD/0PlFcWbEO0OG');
    
    printHead("$cacheNum Found","../");
?>
<body>
    <?php
        //sleep(1) delays the page for one second before testing the password
        //I am no genius but I feel like this will mitigate spam from trying to
        //"brute-force" the correct password
        sleep(1);
        if($passIsCorrect){
            if(isset($_POST['name']) && isset($_POST['date']) && isset($_POST['location'])){
                $name = $_POST['name'];
                $date = $_POST['date'];
                $location = $_POST['location'];
                $comments = $_POST['comments'];
                addTextToFile("../$cacheNum.txt",$name,$date,$location,$comments);
            }else{
                displayInputForm("$cacheNum.php?password=$password");
            }
        }else{
            echo 'incorrect password';
        }
    ?>
</body>
</html>