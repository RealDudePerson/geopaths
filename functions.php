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
    function addTextToFile($textFile,$name,$date,$location,$comments){
        if(is_writable($textFile)){
            $cache = fopen($textFile,"a");
            //use str_replace to get rid of all existing '|' symbols
            $name = str_replace("|","-",$name);
            $date = str_replace("|","-",$date);
            $location = str_replace("|","-",$location);
            $comments = str_replace("|","-",$comments);
            //build the line to insert into the text file
            $output = $name."|".$date."|".$location."|".$comments."\n";
            fwrite($cache, $output);
            fclose($cache);
        }else{
            echo "File Not Writable";
        }
        
    }
?>