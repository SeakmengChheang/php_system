<?php
    
    function open_db() {
        return mysqli_connect("localhost", "root", "", "system");
    }

    function open_mysqli() {
        return new mysqli("localhost", "root", "", "system");
    }

?>