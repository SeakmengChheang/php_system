<?php

    include_once "open_db.php";

    function get_value($variable, $method){
        if($method == "POST"){
            $variable = $_POST["$variable"];
        }
        elseif ($method == "GET") {
            $variable = $_GET["$variable"];
        }
        
        $con = open_db();

        $variable = mysqli_real_escape_string($con , $variable);
        $variable = trim($variable);
        $con->close();
        return $variable;
    }

?>