<?php
    include "../functions.php";
?>
<!DOCTYPE html>
<html>
<?php
    printHead("Token Log Index","../");
?>

<body>
    <?php
        printHeader("../");
    ?>
    <div class="body">
    <div class="outer-wrapper">
    <div class="content-wrapper">
        <h2>Log Find List</h2>
        <?php
            $logs = printLogList();
            //count will always be at least one because of index.php
            if(count($logs)>1){
                echo "<ul>";
                foreach($logs as $token){
                    $tokenName = str_replace(".php","",$token);
                    if($token!="index.php")
                        echo "<li><a href='$token'>$tokenName</a></li>";
                }
                echo "</ul>";
            }else{
                echo "<p>Nobody has found anyhing yet! Check back again soon to see where things have been!</p>";
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