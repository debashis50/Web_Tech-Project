<?php
    require_once('../config/database.php');

    function add_order_items($order_id, $cart_items) {
        $con = get_connection();
        
        foreach($cart_items as $item) {
            $product_id = $item['cart_product_id'];
            $quantity = $item['cart_quantity'];
            $unit_price = $item['product_price'];
            
            $sql = "INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) 
                    VALUES ('$order_id', '$product_id', '$quantity', '$unit_price')";
            mysqli_query($con, $sql);
        }
        
        mysqli_close($con);
        return true;
    }

    function get_order_items_by_order_id($order_id) {
        $con = get_connection();
        $sql = "SELECT order_items.*, products.product_name 
                FROM order_items 
                JOIN products ON order_items.order_item_product_id = products.product_id 
                WHERE order_items.order_item_order_id = '$order_id'";
        $result = mysqli_query($con, $sql);
        
        $items = [];
        while($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }
        
        mysqli_close($con);
        return $items;
    }
?>