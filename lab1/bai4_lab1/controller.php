<?php
    include "model.php";

    if(isset($_GET["keyword"])){
        $name = trim($_GET["keyword"]);
        $products = get_product_by_name($name);

        if($products == null){
            $message = "Không tìm thấy sản phẩm";
        }
    }
    else{
        $products = get_all_products();
    }

    include "view.php";

?>