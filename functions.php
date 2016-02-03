<?php
    /**This function takes in a string that is the name of the text file stored on the server.
     *It opens that text file for reading, then extracts all of the lines and builds a table out of it
     *Once the table has been built and put into a string var, it returns that string to the calling method
     */
    function getCacheData($textFile){
        $cache = fopen($textFile, "r");
        if($cache){
            //start building the output with an opening table element
            $output = "<table class='token-table'>\n";
            //while not at the end of the file
            $loopCounter = 0;
            while(!feof($cache)) {
                //set $line to the next line in the file
                $line = fgets($cache);

                //if the line is blank then do nothing
                if(!($line == "")){
                    //set $lineExploded to the array returned from exploding $line
                    $line = explode('|',$line);
                    //if $loopCounter==0 add thead
                    if($loopCounter==0){
                        $output .= "<thead>\n";
                    }elseif($loopCounter==1){
                        $output .= "<tbody>\n";
                    }
                    //add a <tr> element to $output
                    $output .= "<tr>\n";
                    //add all the td elements
                    foreach($line as $element){
                        //clear extra spaces around element
                        $element = trim($element);
                        //if this is the fist loop then make the elements table headers
                        if($loopCounter==0){
                            $output .= "<th>$element</th>\n";
                        }
                        else{
                            $output .= "<td>$element</td>\n";
                        }
                    }
                    //$close off the table row element </tr>
                    $output .= "</tr>\n";
                    //close off thead
                    if($loopCounter==0){
                        $output .= "</thead>\n";
                    }
                    //increment loop counter
                    $loopCounter .= 1;
                }
            }
            //close of the table element </table>
            $output .= "</tbody>\n</table>\n";
        }else{ //if the file cannot be opened then return false
            $output = false;
        }
        //close the text file
        fclose($cache);
        return $output;
    }



/*************************************************************************************************************/

    if(isset($_GET['getTokenLocations']) && isset($_GET['tokenName'])){
        if($_GET['getTokenLocations']=="true"){
            $textFile = "tokens/".$_GET['tokenName'].".txt";
            $locations = getTokenLocations($textFile);
            header('Content-Type: application/json');
            echo $locations;
        }
    }

    function getTokenLocations($textFile){
        /*$token = fopen($textFile, "r");
        $output = array();
        if($token){
            $loopCounter = 0;
            while(!feof($token)) {
                //set $line to the next line in the file
                $line = fgets($token);
                if(!($line == "")){
                    $line = explode('|',$line);
                    //TODO FIX THIS FORMAT
                    if(!($line[2] == "n/a") && $loopCounter > 0){
                        // $output .= $line[2]; //add the location to the output
                        $output[] = $line[2];
                    }
                }
                $loopCounter .= 1;
            }
        }else{ //if the file cannot be opened then return false
            $output = false;
        }
        fclose($token);
        $outputString = '{"locations":';
        $outputString .= json_encode($output);
        $outputString .= '}';
        return $outputString;*/

        $token = fopen($textFile, "r");
        $output = array();
        if($token){
            $loopCounter = 0;
            while(!feof($token)) {
                //set $line to the next line in the file
                $line = fgets($token);
                if(!($line == "")){
                    $line = explode('|',$line);
                    //TODO FIX THIS FORMAT
                    if(!($line[2] == "n/a") && $loopCounter > 0){
                        // $output .= $line[2]; //add the location to the output
                        $output[] = array($line[1],str_replace("\n","",$line[4]));
                    }
                }
                $loopCounter .= 1;
            }
        }else{ //if the file cannot be opened then return false
            $output = false;
        }
        fclose($token);
        $outputString = '{"locations":';
        $outputString .= json_encode($output);
        $outputString .= '}';
        return $outputString;
    }


/*************************************************************************************************************/



    /*This function takes a textFile, name, location, and comments and adds them to the text file
     */
    //Self note, change permisions of local file to www-data ownership for this to work
    //sudo chown -R www-data:www-data [$textFile]
    function addTextToFile($textFile,$name,$location,$comments,$tokenNum,$latlng){
        if(file_exists($textFile)){
            date_default_timezone_set('America/Los_Angeles');
            $date = date("n-j-Y H:i:s");
            $cache = fopen($textFile,"a");
            //use str_replace to get rid of all existing '|' '<' '>' symbols
            $name = str_replace("|","-",$name);
            $location = str_replace("|","-",$location);
            $comments = str_replace("|","-",$comments);
            $name = str_replace("<","",$name);
            $location = str_replace("<","",$location);
            $comments = str_replace("<","",$comments);
            $name = str_replace(">","",$name);
            $location = str_replace(">","",$location);
            $comments = str_replace(">","",$comments);
            //build the line to insert into the text file
            $output = $name."|".$date."|".$location."|".$comments."\n";
            fwrite($cache, $output);
            fclose($cache);
            echo "<h3>Success</h3> <p>View the log <a href='tokens/index.php'>here</a>.</p>
            <h3>What is next?</h3>
            <p>In order to keep the token on the move you should place it in a new geocache as soon as you can! The sooner it is available the sooner the next person can log it!</p>
            <p>If the token seems damaged or needs to be replaced for any reason please contact me here: <a href='https://dannavetta.com#scroll4'>dannavetta.com</a></p>
            ";
        }else{
            //$tokenNum = substr($textFile,7,7);
            $myfile = fopen($textFile, "w");
            $newPhpFile = fopen("tokens/$tokenNum.php","w");
            $phpSetup = buildPHPFile($tokenNum);
            fwrite($newPhpFile,$phpSetup);
            fclose($newPhpFile);
            $output = "Name|Date|Location|Comments\n";
            fwrite($myfile, $output);
            fclose($myfile);
            //call this function again with the same data
            addTextToFile($textFile,$name,$location,$comments,$latlng);
        }
    }


/*************************************************************************************************************/


    /*This function will print the html head
     */
    function printHead($title,$path){
        $htmlHead =
"   <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=yes'>
        <title>$title</title>
        <link rel='stylesheet' type='text/css' href='".$path."css/main.css'>
        <link rel='shortcut icon' href='".$path."favicon.ico'>
        <script src='".$path."scripts/jquery-2.1.4.min.js'></script>
        <script src='".$path."scripts/smooth-scroll.js'></script>
        <script src='".$path."scripts/main.js'></script>
    </head>
    ";
        echo $htmlHead;
    }


/*************************************************************************************************************/



    /*This function will print the header for the site
     */
    function printHeader($path){
    $output = "
<header class='centered-navigation' role='banner'>
  <div class='centered-navigation-wrapper'>
    <a href='".$path."index.php' class='logo'>
      <img src='".$path."icons/Simple_Globe.png' alt='Logo image'>
    </a>
    <h1>Geopaths</h1>
  </div>
</header>
";
    echo $output;
    }


/*************************************************************************************************************/



    /*This function will print the text to display on a token found page
     */
    function printFindersText(){
        $output = "<p>Congrats on finding and scanning this small QR code. If you would like you can enter your information below and it will be entered into the find log. You can put your name and any comments you want to share. After you enter your information and click send you can click the globe at the top of the screen to view where the token has been.</p>
        <p>If you want to share the location of where you found the Geopath token, please allow your browser to share location in the pop up. If you do not allow location, you can still log your name and any comments.</p>";
        echo $output;
    }

    /**This function will print the footer for the site
     */
    function printFooter(){
        $output = "
    <div class='footer'>
        <p>Created by Dan Navetta | <a href='https://github.com/idiotonuni/geopaths'>View on Github</a></p>
    </div>
    ";
    echo $output;
    }


/*************************************************************************************************************/


    /**For this function you need to send the password plaintext compare it to the hashes stored
     *in the pass_hashes file. To get the hashes out of the pass_hashes you must call getHashes()
     *The function returns an array in the format array(BOOL $returnVal, string $tokenName)
     */
    function testPassword($password){
        //get the hash data drom the pass_hashes file
        require_once "pass_hashes.php";
        $hashArray = getHashes();
        $returnVal = false;
        $tokenName = "";
        foreach($hashArray as $key => $hash){
            if(password_verify($password,$hash)){
                $returnVal = true;
                $tokenName = $key;
            }
        }
        return array($returnVal,$tokenName);
    }

/*************************************************************************************************************/

    /** This function builds the php file for a first found token
     */
    function buildPHPFile($tokenNum){
        $php = "
<?php
    include '../functions.php';
?>
<!DOCTYPE html>
<html>
<?php
    printHead('$tokenNum Log','../');
?>

<body>
    <?php
        printHeader('../');
    ?>
    <div class='body'>
    <div class='outer-wrapper'>
    <div class='content-wrapper'>
        <h2>$tokenNum</h2>
        <?php
            \$output = getCacheData('$tokenNum.txt');
            if(!\$output){
                echo 'No file exists';
            }else{
                echo \$output;
            }
        ?>
        <div id='map'></div>
    </div>
    </div>
    </div>
    <script src='../scripts/datatables.min.js'></script>
    <script async defer src='https://maps.googleapis.com/maps/api/js'></script>
    <?php
        printFooter();
    ?>
    <script src='../scripts/getLocationsJson.js'></script>
</body>
</html>
        ";
        return $php;
    }


/*************************************************************************************************************/


    /**This function is used to show the input form on the found page
     */
    function displayInputForm($submitPage){
        $inputForm =
        "<form action='$submitPage' method='post'>
        <label for='name'>Name:</label>
        <input type='text' name='name' id='name' required>
        <label id='locationLabel' for='location' class='hidden'>Location:</label>
        <input type='text' class='hidden' name='location' id='location' value='n/a'>
        <input type='text' class='hidden' name='latlng' id='latlng' value='n/a'>
        <label for='comments'>Comments:</label>
        <input type='text' name='comments' id='comments'>
        <p class='hideWhenLocated'>Waiting for location...if this message does not disapear, refresh to try again.</p>
        <input type='submit' value='Submit' class='submit'>
        </form>
        <script src='scripts/getLocation.js'></script>
        ";
        echo $inputForm;
    }


/*************************************************************************************************************/


    function printLogList(){
        $files = glob("*.php");
        return $files;
    }

?>
