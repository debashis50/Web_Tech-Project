<?php
    require_once('../models/user.php');
    require_once('../models/product.php');
    require_once('../models/order.php');
    require_once('../utils/auth_helper.php');

    require_admin();

    function dashboard() {
        $total_products = get_total_products();
        $total_customers = count(get_all_customers());
        $total_orders = get_total_orders();
        $pending_orders = get_pending_orders_count();
        
        include('../views/admin/dashboard.php');
    }
?>