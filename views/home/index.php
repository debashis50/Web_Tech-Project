<?php
    require_once('../utils/auth_helper.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Online Clothing Brand</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <marquee>
                <h1>Online Clothing Brand</h1>
            </marquee>
            
            <p>
                <?php if(is_logged_in()) { ?>
                    Welcome, <?php echo $_SESSION['user_name']; ?> |
                    <a href="../public/index.php?action=profile">Profile</a> |
                    <?php if(is_customer()) { ?>
                        <a href="../public/index.php?action=cart">Cart</a> |
                    <?php } ?>
                    <?php if(is_admin()) { ?>
                        <a href="../public/index.php?action=admin_dashboard">Admin Dashboard</a> |
                    <?php } ?>
                    <a href="../public/index.php?action=logout">Logout</a>
                <?php } else { ?>
                    <a href="../public/index.php?action=login">Login</a> |
                    <a href="../public/index.php?action=register">Register</a>
                <?php } ?>
            </p>
            
            <hr>
            
            <h3>Shop by gender</h3>
            <?php foreach($parent_categories as $parent) { ?>
                <a href="../public/index.php?action=search_products&gender=<?php echo $parent['category_name']; ?>"><?php echo $parent['category_name']; ?></a>
                &nbsp;
            <?php } ?>
            
            <h3>Categories</h3>
            <?php foreach($categories as $category) { ?>
                <?php if($category['parent_category_id'] != null) { ?>
                    <a href="../public/index.php?action=search_products&category_id=<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></a>
                    &nbsp;
                <?php } ?>
            <?php } ?>
            
            <hr>
            
            <h3>Search products</h3>
            <form id="searchForm">
                <input type="text" id="keyword" name="keyword" placeholder="Product name">
                <select id="gender" name="gender">
                    <option value="">All Gender</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                </select>
                <select id="category_id" name="category_id">
                    <option value="">All Category</option>
                    <?php foreach($categories as $category) { ?>
                        <?php if($category['parent_category_id'] != null) { ?>
                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
                <input type="submit" value="Search">
            </form>
            
            <br>
            <div id="searchResults"></div>
            
            <hr>
            
            <h3>Featured products</h3>
            <table border="1" cellpadding="10">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Gender</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
                <?php foreach($featured_products as $product) { ?>
                <tr>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['product_price']; ?></td>
                    <td><?php echo $product['product_gender']; ?></td>
                    <td><?php echo $product['product_stock']; ?></td>
                    <td>
                        <a href="../public/index.php?action=product_details&id=<?php echo $product['product_id']; ?>">Details</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </center>
    </div>
    
    <script src="../public/js/search.js"></script>
</body>
</html>