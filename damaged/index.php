<?php
    include "../functions.php";
?>
<!DOCTYPE html>
<html>
<?php
    printHead("Damaged Contact Form","../");
?>
<body>
  <?php
      printHeader("../");
   ?>
  <div class="body">
  <div class="outer-wrapper">
  <div class="content-wrapper">
    <h2>Please contact me below to replace the damaged Token</h2>
<?php

    $captcha = false;
    //tests to see if recaptcha button is filled out/checked
    if(isset($_POST['g-recaptcha-response'])){
      $captcha=$_POST['g-recaptcha-response'];
    }

    $captchaResponse = getCaptchaResponse($captcha);


    $name = "";
    $email = "";
    $message = "";
    if(isset($_POST['name'])){
        $name=$_POST['name'];
    }
    if(isset($_POST['email'])){
        $email=$_POST['email'];
    }
    if(isset($_POST['message'])){
        $message=$_POST['message'];
    }
    //first check if all fields are filled out
    if($name!="" && $email!="" && $message!=""){
      //next check if the email is valid format
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        //after that check to see that the captcha is filled out and valid
        if($captchaResponse){
          //finally try to send the email, if it is successful then displaySuccess
          if(mail("danielnavetta@gmail.com","Website Contact: $name",$message." \n\nFrom: $email","From: no.reply@geo-paths.com")){
            echo '<p>Success. I will contact you.</p>';
          }else{
            displayDamagedForm($name,$email,$message);
          }
        }else{
          displayDamagedForm($name,$email,$message);
        }
      }else{
        displayDamagedForm($name,$email,$message);
      }
    }else{
      displayDamagedForm($name,$email,$message);
    }
?>
</div>
</div>
</div>
<?php
    printFooter();
?>
</body>
<script src='https://www.google.com/recaptcha/api.js'></script>
</html>
