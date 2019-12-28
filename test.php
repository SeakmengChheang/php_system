<?php

    include "php/function/run_query.php";

    $sql = "SELECT * FROM user";
    $result = run_query($sql);

    if($result){
        echo "true";
    }
    else{
        echo "false";
    }

?>