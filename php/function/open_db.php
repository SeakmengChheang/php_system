<?php
    
    function open_db() {
        return mysqli_connect("localhost", "root", "", "system");
    }
?>