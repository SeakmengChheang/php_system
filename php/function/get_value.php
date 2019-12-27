<?php

    function get_value($variable, $method){
        if($method == "POST"){
            $variable = $_POST["$variable"];
        }
        elseif ($method == "GET") {
            $variable = $_GET["$variable"];
        }
        
        $variable = stripslashes($variable);
        $variable = trim($variable);
        return $variable;
    }

?>