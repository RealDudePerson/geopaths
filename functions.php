<?php
    /**This function takes in a string that is the name of the text file stored on the server.
     *It opens that text file for reading, then extracts all of the lines and builds a table out of it
     *Once the table has been built and put into a string var, it returns that string to the calling method
     */
    function getCacheData($textFile){
        $cache = fopen($textFile, "r");
        if($cache){
            //start building the output with an opening table element
            $output = "<table>\n<tbody>\n";
            //while not at the end of the file
            $loopCounter = 0;
            while(!feof($cache)) {
                //set $line to the next line in the file
                $line = fgets($cache);
                
                //if the line is blank then do nothing
                if(!($line == "")){
                    //set $lineExploded to the array returned from exploding $line
                    $line = explode('|',$line);
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
    
    //Self note, change permisions of local file to www-data ownership for this to work
    //sudo chown -R www-data:www-data [$textFile]
    function addTextToFile($textFile,$name,$location,$comments){
        //if(is_writable($textFile)){
        //the is_writable test seems to be returning false every time
        //will change this back when i can figure out why it is not working
        //TODO
        if(true){
            date_default_timezone_set('America/Los_Angeles');
            $date = date("j-n-Y H:i:s");
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
            echo "Success";
        }else{
            echo "File Not Writable";
        }
    }
    
    //This will print the html head
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
    
    //This will print the header for the site
    function printHeader($path){
        $output = "
    <div class='header-filler'></div>
    <div class='header'>
        <h1>QR Token Tracker</h1>
        <ul>
            <li><a href='".$path."index.php'>Home</a></li>
        </ul>
    </div>
    ";
    $otherHeader = "
<header class='centered-navigation' role='banner'>
  <div class='centered-navigation-wrapper'>
    <a href='".$path."index.php' class='logo'>
      <img src='".$path."icons/Simple_Globe.png' alt='Logo image'>
    </a>
    <h1>Geopaths</h1>
  </div>
</header>
";
    //echo $output;
    echo $otherHeader;
    }
    
    //This will print the text to display on a token found page
    function printFindersText(){
        $output = "<p>Congrats on finding and scanning this small QR code. If you would like you can enter your information below and it will be entered into the find log. You can put your name and any comments you want to share. After you enter your information and click send you can click the globe at the top of the screen to view where the token has been.</p>
        <p>If you want to share the location of where you found the Geopath token, please allow your browser to share location in the pop up. If you do not allow location, you can still log your name and any comments.</p>";
        echo $output;
    }   
    
    //This will print the footer for the site
    function printFooter(){
        $output = "
    <div class='footer'>
        <p>Created by Dan Navetta | <a href='https://github.com/idiotonuni/geopaths'>View on Github</a></p>
    </div>
    ";
    echo $output;
    }
    
    /**For this function you need to send the password plaintext and the hash to compare it to
     *If they password matches, then the function returns true, else returns false
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
    
    /**This function is used to show the input form on finding pages
     */
    function displayInputForm($submitPage){
        $inputForm =
        "<form action='$submitPage' method='post'>
        <label for='name'>Name:</label>
        <input type='text' name='name' id='name' required>
        <label id='locationLabel' for='location' class='hidden'>Location:</label>
        <input type='text' name='location' id='location' value='n/a' class='hidden'>
        <label for='comments'>Comments:</label>
        <input type='text' name='comments' id='comments'>
        <p class='hideWhenLocated'>Your location will not be recorded. If you want to add a location please refresh and allow location.</p>
        <input type='submit' value='Submit'>
        </form>
        <script src='../scripts/getLocation.js'></script>
        ";
        echo $inputForm;
    }
?>