<?php
    // session_start();
    require_once('../models/user.php');
    require_once('../utils/auth_helper.php');

    require_admin();

    function customer_list() {
        $customers = get_all_customers();
        include('../views/admin/customers/list.php');
    }

    function delete_customer() {
        $user_id = $_GET['id'];
        
        $result = delete_user($user_id);
        
        if($result) {
            $_SESSION['customer_success'] = "Customer deleted successfully!";
        } else {
            $_SESSION['customer_error'] = "Failed to delete customer!";
        }
        
        header('Location: ../public/index.php?action=customer_list');
        exit();
    }
?>