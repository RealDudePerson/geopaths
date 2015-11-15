<!DOCTYPE html>
<html>
<?php
    require "../functions.php";
    $password = $_GET['password'];
    //change the hash for every new cache page
    $passIsCorrect = testPassword($password,'$2y$10$uxQtb6qRwmibv0UiiqCVaOin6s3ePnNzNS61RBbD/0PlFcWbEO0OG');
    //change the title for every new cache page
    printHead("Cache01 Found","../");
?>
<body>
    <?php
        if($passIsCorrect){
            if(isset($_POST['name']) && isset($_POST['date']) && isset($_POST['location'])){
                $name = $_POST['name'];
                $date = $_POST['date'];
                $location = $_POST['location'];
                $comments = $_POST['date'];
                addTextToFile("cache01.txt",$name,$date,$location,$comments);
            }else{
                displayInputForm("cache01.php?password=$password",$password);
            }
        }else{
            echo 'incorrect password';
        }
    ?>
</body>
</html>