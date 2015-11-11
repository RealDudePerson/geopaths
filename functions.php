<?php
    function getCacheData($textFile){
        $cache = fopen($textFile, "r");
        if($cache){
            //start building the output with an opening table element
            $output = "<table>\n<tbody>\n";
            //while not at the end of the file
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
                        $output .= "<td>$element</td>\n";
                    }
                    //$close off the table row element </tr>
                    $output .= "</tr>\n";
                }
                
            }
            //close of the table element </table>
            $output .= "</tbody>\n</table>\n";
            //close the text file
            fclose($cache);
        }else{
            $output = false;
        }
        return $output;
    }
?>