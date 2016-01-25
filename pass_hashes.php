<?php
//This function returns an array of hashes to check against the user inputted pass
function getHashes(){
    $hashes = array(
           'Token1' => '$2y$10$JaW.5tOlfGFZEOSqi8Lb.OrJrS2o5xkbFOy9CJDn1eEYZerAJslsq',
           'Token2' => '$2y$10$MhL5KLKWAH9wLw.fpk5mC.bB.4FW/uzkIe7vg4S5UXVObWvHlW1Zq',
           'Token3' => '$2y$10$69CwRl/LOh0F6wug/Wd2f.T8xNBaYfY9RJBCxhQPGv9wUfH4qTdPi',
           'Token4' => '$2y$10$uZAAsu1Q21YDBFDA4.kiD.JeWwJADlzWCO7GAuN4j8WImdPI9L8bS',
           );
    return $hashes;
}
?>