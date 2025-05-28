<?php 
    session_start();
    include 'db_connect.php';
    if ($_POST["prod_array"]) {
        $prodArray = explode(",",$_POST["prod_array"]);
        $products = array();
        // echo $prodArray[0];
        for ($h = 0; $h < count($prodArray); $h++) {
            $prod_values = explode(" ",$prodArray[$h]);
            echo $prod_values[0].",".$prod_values[1];
            
            $products["$prod_values[0]"] = "$prod_values[1]";
        }
        $_SESSION['cart'] = $products;
        header("Location:checkout.php");
        exit();
    }
?>