<?php
    require_once('../config/database.php');

    function get_total_orders() {
        $con = get_connection();
        $sql = "SELECT COUNT(*) as total FROM orders";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        mysqli_close($con);
        return $row['total'];
    }

    function get_pending_orders_count() {
        $con = get_connection();
        $sql = "SELECT COUNT(*) as total FROM orders WHERE order_status = 'pending'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        mysqli_close($con);
        return $row['total'];
    }

    function get_all_orders() {
        $con = get_connection();
        $sql = "SELECT o.*, u.user_name FROM orders o 
                JOIN users u ON o.order_user_id = u.user_id 
                ORDER BY o.order_date DESC";
        $result = mysqli_query($con, $sql);
        
        $orders = [];
        while($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        
        mysqli_close($con);
        return $orders;
    }

    function update_order_status_by_id($order_id, $status) {
        $con = get_connection();
        $sql = "UPDATE orders SET order_status = '$status' WHERE order_id = '$order_id'";
        $result = mysqli_query($con, $sql);
        mysqli_close($con);
        return $result;
    }







    // Creates a new order row and returns the new order_id 
    function create_order($user_id, $total_amount) {
        $con = get_connection();
        $sql = "INSERT INTO orders (order_user_id, order_total_amount, order_status) 
                VALUES ('$user_id', '$total_amount', 'pending')";
        $result = mysqli_query($con, $sql);
        
        if ($result) {
            $new_id = mysqli_insert_id($con);
            mysqli_close($con);
            return $new_id;
        }
        
        mysqli_close($con);
        return false;
    }

    // Returns all orders belonging to a specific customer
    function get_orders_by_user_id($user_id) {
        $con = get_connection();
        $sql = "SELECT * FROM orders 
                WHERE order_user_id = '$user_id' 
                ORDER BY order_date DESC";
        $result = mysqli_query($con, $sql);
        
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }
        
        mysqli_close($con);
        return $orders;
    }

    // Returns a single order by order_id 
    function get_order_by_id($order_id) {
        $con = get_connection();
        $sql = "SELECT * FROM orders WHERE order_id = '$order_id'";
        $result = mysqli_query($con, $sql);
        
        if (mysqli_num_rows($result) == 1) {
            $order = mysqli_fetch_assoc($result);
            mysqli_close($con);
            return $order;
        }
        
        mysqli_close($con);
        return null;
    }
?>