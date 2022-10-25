<?php
    
    $a = popen('curl '.$argv[1], 'r'); 
    while($b = fgets($a, 2048)) { 
        echo $b; 
        flush(); 
    }
    pclose($a); 

?>