<?php

function fullpageurl() {
    $pageURL = "http://".$_SERVER["SERVER_NAME"];
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= ":".$_SERVER["SERVER_PORT"];
    }
    if (isset($_GET["logout"])) {
    	$pageURL .= $_SERVER["PHP_SELF"];
    }
    else{
    	$pageURL .= $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

?>