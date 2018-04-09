<?php

foreach($_SESSION["shoppingCart"] as $cartItems){
    $packageName = $cartItems["package_name"];
    $package_description = $cartItems["package_description"];
    $package_lodgeName = $cartItems["lodge_image"];
    $package_lodgeDesc = $cartItems["lodge_description"];
    $package_startDate = $cartItems["event_start_date"];
    $package_endDate = $cartItems["event_end_date"];
    $package_lodgeImg = $cartItems["lodge_image"];
    
}

?>