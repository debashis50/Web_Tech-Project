<?php
    // session_start();
    require_once('../utils/auth_helper.php');
    require_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - Admin</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <h2>Product list</h2>

            <?php
            if(isset($_SESSION['product_success'])) {
                echo "<p>" . $_SESSION['product_success'] . "</p>";
                unset($_SESSION['product_success']);
            }

            if(isset($_SESSION['product_error'])) {
                echo "<p>" . $_SESSION['product_error'] . "</p>";
                unset($_SESSION['product_error']);
            }
            ?>

            

            <br><br>

            <table border="1" cellpadding="10">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
                <?php foreach($products as $product) { ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['product_price']; ?></td>
                    <td><?php echo $product['product_stock']; ?></td>
                    <td><?php echo $product['product_gender']; ?></td>
                    <td>
                        <a href="../public/index.php?action=edit_product&id=<?php echo $product['product_id']; ?>">Edit</a> |
                        <a href="../public/index.php?action=delete_product&id=<?php echo $product['product_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>

            <br>
            <a href="../public/index.php?action=create_product">Add new product</a> |
            <a href="../public/index.php?action=admin_dashboard">Back to dashboard</a>
        </center>
        
    </div>
    <script src="../public/js/admin.js"></script>
</body>
</html>