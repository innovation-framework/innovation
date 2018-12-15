<?php
function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = $path;
        } else if($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }

    return $results;
}

function isFileType($path='', $type = 'php') {
    $path = str_replace('.' . $type, '', $path);

    if (file_exists($path . '.' . $type)) {
        return true;
    }
    return false;
}