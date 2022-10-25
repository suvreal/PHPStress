<?php
    
    // Prepare argv env vars
    if(isset($argv)){
        $envVars = $argv;
        $url = ((isset($envVars[1])) ? $envVars[1] : "https://google.com");
        $queryLimitNumber = ((isset($envVars[2])) ? $envVars[2] : 1);
    }else{
        $url = "https://google.com";
        $queryLimitNumber = 1;
    }
    
    // Perform requests in defined count
    for($i=0;$i<$queryLimitNumber;$i++){ 
            
        
        // Initialize & set cURL 
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        // Responses
        $response = curl_exec($curl);
        $responseInfo = curl_getinfo($curl);

        // Other formats
        $responseEncoded = json_encode($response, JSON_PRETTY_PRINT);
        $responseDecoded = json_decode($responseEncoded, true);
        
        // Handle cURL responses
        if(!is_null($responseInfo) && !is_null($response)){
            if(isset($envVars[3])){   
                echo "<pre>";
                echo "<br/>";
                var_dump($responseInfo);
                var_dump($response);
                echo "<br/>";
                echo "</pre>";
            }

            // Main cURL response           
            $returnString = "[$i] **Info: ";
            $returnString .= " - url ".$responseInfo["url"];
            $returnString .= " - http_code ".$responseInfo["http_code"];
            $returnString .= " - total_time_us ".$responseInfo["total_time_us"];
            $returnString .= " - primary_ip ".$responseInfo["primary_ip"];
            $returnString .= " - size_download ".$responseInfo["size_download"];
            $returnString .= " - time ".date("h:i:s");
            echo $returnString."\r\n";

        }else{
            echo "NO RESPONSE";
        }
        curl_close($curl);
    }

?>