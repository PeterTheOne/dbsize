<?php

function printArray($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

/*
 * Thanks to Tim Bennett:
 * http://www.drquincy.com/blog/format-file-size/
 */
function formatSize ($data) {
    // bytes
    if ($data < 1024) {
        return $data . " b";
    }

    // kilobytes
    if ($data < 1048576) {
        return round(($data / 1024), 1 ) . " kb";
    }

    // megabytes
    if ($data < 1073741824) {
        return round(($data / 1048576), 1 ) . " mb";
    }

    // megabytes
    if ($data < 1099511627776) {
        return round(($data / 1073741824), 1) . " gb";
    }

    // gibabytes
    return round(($data / 1099511627776), 1) . " tb";
}

?>
