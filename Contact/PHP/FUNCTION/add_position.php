<?php

    include_once "../../php/function/run_query.php";

    function add_position(&$datas){
        $sql = "SELECT * FROM staff";
        $staffdatas = get_assoc($sql);
        foreach ($datas as &$data){
            if($data["role"] == "staff"){
                foreach($staffdatas as $staffdata){
                    if($staffdata["staffId"] == $data["id"]){
                        $data["position"] = $staffdata["position"];
                        break;
                    }
                }
            }
            else{
                $data["position"] = "-NA-";
            }
        }
    }


?>