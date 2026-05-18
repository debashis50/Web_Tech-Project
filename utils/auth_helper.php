<?php

    function is_logged_in() { // checks if user is logged in
        return isset($_SESSION['user_id']);
    }

    function is_admin() { // checks if logged in user is admin
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin';
    }

    function is_customer() { // checks if logged in user is customer
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'customer';
    }

    function require_login() { // redirects to login if not logged in
        if (!is_logged_in()) {
            header('location: /online_clothing_brand/public/index.php?action=login');
            exit();
        }
    }

    function require_admin() { // redirect if not admin
        require_login();
        if (!is_admin()) {
            header('location: /online_clothing_brand/public/index.php?action=home');
            exit();
        }
    }

    function require_customer() { // redirect if not customer
        require_login();
        if (!is_customer()) {
            header('location: /online_clothing_brand/public/index.php?action=home');
            exit();
        }
    }

    function get_current_user_id() { // get logged in users id
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    function get_current_user_name() { // get logged in users name
        return isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
    }
?>