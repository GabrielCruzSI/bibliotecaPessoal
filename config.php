<?php 

session_start();

function autoload($ClassName) {
    include("class/" . $ClassName . ".php");
}

spl_autoload_register("autoload");