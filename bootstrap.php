<?php
function __autoload($class_name) {
    require_once("src/$class_name.php");
}