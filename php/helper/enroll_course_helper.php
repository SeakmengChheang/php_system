<?php

function concat_ids($res)
{
    $ids = '';
    foreach ($res as $a)
        foreach ($a as $val)
            $ids .= $val . ',';

    $ids = substr($ids, 0, -1);

    return $ids;
}
