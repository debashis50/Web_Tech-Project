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
    <title>Customer List - Admin</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <h2>Customer list</h2>

            <?php
                if(isset($_SESSION['customer_success'])) {
                    echo "<p>" . $_SESSION['customer_success'] . "</p>";
                    unset($_SESSION['customer_success']);
                }

                if(isset($_SESSION['customer_error'])) {
                    echo "<p>" . $_SESSION['customer_error'] . "</p>";
                    unset($_SESSION['customer_error']);
                }
            ?>

            

            

            <table border="1" cellpadding="10">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                <?php foreach($customers as $customer) { ?>
                <tr>
                    <td><?php echo $customer['user_id']; ?></td>
                    <td><?php echo $customer['user_name']; ?></td>
                    <td><?php echo $customer['user_email']; ?></td>
                    <td><?php echo $customer['user_phone']; ?></td>
                    <td><?php echo $customer['user_address']; ?></td>
                    <td>
                        <a href="../public/index.php?action=delete_customer&id=<?php echo $customer['user_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <br>
            <a href="../public/index.php?action=admin_dashboard">Back to dashboard</a>
        </center>
        
    </div>
    <script src="../public/js/admin.js"></script>
</body>
</html>