<?php
    // session_start();
    require_once('../models/order.php');
    require_once('../utils/auth_helper.php');
    require_once('../models/order_item.php');

    function order_list() {
        require_admin();
        $orders = get_all_orders();
        include('../views/admin/orders/list.php');
    }

    function update_order_status() { // for AJAX request
        require_admin();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order_id = $_POST['order_id'];
            $status = $_POST['status'];
            
            $result = update_order_status_by_id($order_id, $status);
            
            if($result) {
                echo "success";
            } else {
                echo "failed";
            }
        }
    }

    function purchase_history() {
        require_admin();
        $orders = get_all_orders();
        include('../views/admin/purchase_history/all.php');
    }

    function my_orders() {
        require_customer();
 
        $user_id = get_current_user_id();
 
        // Get all orders for this customer
        $orders = get_orders_by_user_id($user_id);
 
        // For each order, fetch its items
        $order_items_map = [];
        foreach ($orders as $order) {
            $order_items_map[$order['order_id']] = get_order_items_by_order_id($order['order_id']);
        }
 
        include('../views/orders/history.php');
    }
?>