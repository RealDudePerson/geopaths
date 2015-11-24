<!DOCTYPE html>
<html>
<?php
    require "functions.php";
    
    $password = $_GET['password'];
    $passIsCorrectArray = testPassword($password);
    $passIsCorrect = $passIsCorrectArray[0];
    //cacheNum is a variable holding the string for whatever number token it is change for each file
    $cacheNum = $passIsCorrectArray[1];
    
    printHead("$cacheNum Found","");
?>
<body>
    <?php
        printHeader("");
    ?>
    <div class="body">
    <div class="outer-wrapper">
    <div class="content-wrapper">
    <h2><?php echo $cacheNum; ?></h2>
    <?php
        //sleep(1) delays the page for one second before testing the password
        //I am no genius but I feel like this will mitigate spam from trying to
        //"brute-force" the correct password
        sleep(1);
        //TODO if pass is incorrect, then maybe display the log table.
        //that way they get something instead of access denied
        if($passIsCorrect){
            if(isset($_POST['name']) && isset($_POST['location'])){
                $name = $_POST['name'];
                $location = $_POST['location'];
                $comments = $_POST['comments'];
                addTextToFile("tokens/$cacheNum.txt",$name,$location,$comments);
                //TODO separate out the mail items
                $temp = mail('dan@dannavetta.com', $cacheNum.' finder notification', "New find on $cacheNum.", "From: geopaths@dannavetta.com");
            }else{
                printFindersText();
                displayInputForm("found.php?password=$password");
            }
        }else{
            echo 'Access Denied.';
        }
    ?>
    </div>
    </div>
    </div>
    <?php
        printFooter();
    ?>
</body>
</html>