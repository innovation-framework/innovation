<?php
require 'file.php';

// Include vendor
require APP_ROOT . DIRECTORY_SEPARATOR .'vendor'. DIRECTORY_SEPARATOR . 'autoload.php';

//Bootstrap library dir
/*$filesLibrary = getDirContents(APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'library');


foreach ($filesLibrary as $file) {
    if (isFileType($file)) {
        include_once $file;
    }
}
*/
//Bootstrap http
$filesHttp = getDirContents(APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'http');
foreach ($filesHttp as $file) {
    if (isFileType($file)) {
        include $file;
    }
}


//Bootstrap model dir
$filesModel = getDirContents(APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'model');
foreach ($filesModel as $file) {
    if (isFileType($file)) {
        include $file;
    }
}


//Bootstrap controller dir
$filesController = getDirContents(APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controller');
foreach ($filesController as $file) {
    if (isFileType($file)) {
        include $file;
    }
}