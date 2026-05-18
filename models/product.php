<?php
    require_once('../config/database.php');

    function get_total_products() {
        $con = get_connection();
        $sql = "SELECT COUNT(*) as total FROM products";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        mysqli_close($con);
        return $row['total'];
    }

    function get_all_products() {
        $con = get_connection();
        $sql = "SELECT * FROM products";
        $result = mysqli_query($con, $sql);
        
        $products = [];
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        
        mysqli_close($con);
        return $products;
    }

    function get_featured_products() {
        $con = get_connection();
        $sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT 6";
        $result = mysqli_query($con, $sql);
        
        $products = [];
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        
        mysqli_close($con);
        return $products;
    }

    function search_products($keyword, $category_id, $gender) {
        $con = get_connection();
        
        $sql = "SELECT products.*, categories.category_name 
                FROM products 
                LEFT JOIN categories ON products.product_category_id = categories.category_id 
                WHERE 1";
        
        if(!empty($keyword)) {
            $sql .= " AND products.product_name LIKE '%$keyword%'";
        }
        
        if(!empty($category_id)) {
            $sql .= " AND products.product_category_id = '$category_id'";
        }
        
        if(!empty($gender)) {
            $sql .= " AND products.product_gender = '$gender'";
        }
        
        $result = mysqli_query($con, $sql);
        
        $products = [];
        while($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        
        mysqli_close($con);
        return $products;
    }

    function get_product_by_id($product_id) {
        $con = get_connection();
        $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
        $result = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($result) == 1) {
            $product = mysqli_fetch_assoc($result);
            mysqli_close($con);
            return $product;
        }
        
        mysqli_close($con);
        return null;
    }

    function add_product($name, $description, $size_chart, $price, $category_id, $image_path, $stock, $gender) {
        $con = get_connection();
        
        $sql = "INSERT INTO products (product_name, product_description, product_size_chart, product_price, product_category_id, product_image_path, product_stock, product_gender) 
                VALUES ('$name', '$description', '$size_chart', '$price', '$category_id', '$image_path', '$stock', '$gender')";
        
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
        return $result;
    }

    function update_product($product_id, $name, $description, $size_chart, $price, $category_id, $image_path, $stock, $gender) {
        $con = get_connection();
        
        $sql = "UPDATE products SET 
                product_name = '$name', 
                product_description = '$description', 
                product_size_chart = '$size_chart', 
                product_price = '$price', 
                product_category_id = '$category_id', 
                product_image_path = '$image_path', 
                product_stock = '$stock', 
                product_gender = '$gender' 
                WHERE product_id = '$product_id'";
        
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
        return $result;
    }

    function delete_product_by_id($product_id) {
        $con = get_connection();
        
        $sql = "DELETE FROM products WHERE product_id = '$product_id'";
        $result = mysqli_query($con, $sql);
        
        mysqli_close($con);
        return $result;
    }

    // Returns all products belonging to a specific category (Task-3)
    function get_products_by_category($category_id) {
        $con = get_connection();
        $sql = "SELECT * FROM products WHERE product_category_id = '$category_id' ORDER BY product_created_at DESC";
        $result = mysqli_query($con, $sql);
 
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
 
        mysqli_close($con);
        return $products;
    }
?>
