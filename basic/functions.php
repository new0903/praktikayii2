<?php

function debug($arr){
    echo '<pre>' . print_r($arr,true) . '</pre>';
}

function fileExist($pathFile){
    if (!file_exists($pathFile)) {
        return true;
    }
    return false;
}