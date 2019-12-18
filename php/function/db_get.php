<?php

require 'open_close_db.php';

function get_assoc($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql);

    $rtn = mysqli_fetch_all($result, MYSQLI_ASSOC);

    close_db($link);
    
    return $rtn;
}

function get_num($sql)
{
    $link = open_db();

    $result = mysqli_query($link, $sql);

    $rtn = mysqli_fetch_all($result, MYSQLI_NUM);

    close_db($link);

    return $rtn;
}
