<?php
    function open_db() {
        return mysqli_connect("localhost", "root", "", "system");
    }

    function close_db($link) {
        $link->close();
    }

?>