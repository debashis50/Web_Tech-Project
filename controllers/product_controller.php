<?php
    // session_start();
    require_once('../models/product.php');
    require_once('../utils/auth_helper.php');

    require_admin();

    function product_list() {
        $products = get_all_products();
        include('../views/admin/products/list.php');
    }

    function show_create_product() {
        include('../views/admin/products/create.php');
    }

    function create_product() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $size_chart = $_POST['size_chart'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $stock = $_POST['stock'];
            $gender = $_POST['gender'];
            
            // Image upload handling
            $image_path = '';
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "../public/uploads/products/";
                $image_path = $target_dir . time() . "_" . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
            }
            
            if(empty($name) || empty($price) || empty($stock)) {
                $_SESSION['product_error'] = "Required fields missing!";
                header('Location: ../public/index.php?action=create_product');
                exit();
            }
            
            $result = add_product($name, $description, $size_chart, $price, $category_id, $image_path, $stock, $gender);
            
            if($result) {
                $_SESSION['product_success'] = "Product added successfully!";
                header('Location: ../public/index.php?action=product_list');
                exit();
            } else {
                $_SESSION['product_error'] = "Failed to add product!";
                header('Location: ../public/index.php?action=create_product');
                exit();
            }
        }
    }

    function show_edit_product() {
        $product_id = $_GET['id'];
        $product = get_product_by_id($product_id);
        include('../views/admin/products/edit.php');
    }

    function edit_product() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $size_chart = $_POST['size_chart'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $stock = $_POST['stock'];
            $gender = $_POST['gender'];
            
            $product = get_product_by_id($product_id);
            $image_path = $product['product_image_path'];
            
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "../public/uploads/products/";
                $image_path = $target_dir . time() . "_" . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
            }
            
            $result = update_product($product_id, $name, $description, $size_chart, $price, $category_id, $image_path, $stock, $gender);
            
            if($result) {
                $_SESSION['product_success'] = "Product updated successfully!";
                header('Location: ../public/index.php?action=product_list');
                exit();
            } else {
                $_SESSION['product_error'] = "Failed to update product!";
                header('Location: ../public/index.php?action=edit_product&id=' . $product_id);
                exit();
            }
        }
    }

    function delete_product() {
        $product_id = $_GET['id'];
        $result = delete_product_by_id($product_id);
        
        if($result) {
            $_SESSION['product_success'] = "Product deleted successfully!";
        } else {
            $_SESSION['product_error'] = "Failed to delete product!";
        }
        
        header('Location: ../public/index.php?action=product_list');
        exit();
    }
?>