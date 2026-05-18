# Task 2 – Admin Panel
**Student ID:** 23-50856-1
**Course:** Web Technologies

## Files Included (Task 2 Part Only)

### Controllers
- `controllers/admin_controller.php` — Dashboard stats
- `controllers/product_controller.php` — Product CRUD
- `controllers/customer_controller.php` — Customer list + delete
- `controllers/order_controller.php` — Order list, status update (AJAX), purchase history

### Models
- `models/product.php` — Product DB functions
- `models/user.php` — User/customer DB functions
- `models/order.php` — Order DB functions
- `models/order_item.php` — Order items DB functions

### Views
- `views/admin/dashboard.php` — Admin dashboard (summary counts)
- `views/admin/products/list.php` — Product list
- `views/admin/products/create.php` — Add product form (with JS validation)
- `views/admin/products/edit.php` — Edit product form (with JS validation)
- `views/admin/products/delete.php` — Delete product
- `views/admin/customers/list.php` — Customer list + delete
- `views/admin/orders/list.php` — Order list with AJAX confirm/reject
- `views/admin/purchase_history/all.php` — All purchase history

### JS / AJAX
- `public/js/admin.js` — AJAX order status update + JS form validation

### Config / Utils
- `config/database.php` — DB connection
- `config/db_config.php` — DB credentials (update before use)
- `utils/auth_helper.php` — Session/role helpers

### SQL
- `sql/db_and_table_create.sql` — Create all tables
- `sql/insert.sql` — Sample data

## Routes (in public/index.php)
| Action | Description |
|--------|-------------|
| `?action=admin_dashboard` | Admin dashboard |
| `?action=product_list` | View all products |
| `?action=create_product` | Show add product form |
| `?action=create_product_submit` | POST: save new product |
| `?action=edit_product&id=X` | Show edit form |
| `?action=edit_product_submit` | POST: update product |
| `?action=delete_product&id=X` | Delete product |
| `?action=customer_list` | View all customers |
| `?action=delete_customer&id=X` | Delete customer |
| `?action=order_list` | View all orders |
| `?action=update_order_status` | POST/AJAX: confirm or reject order |
| `?action=purchase_history` | View all purchase history |

## Setup
1. Import `sql/db_and_table_create.sql` into MySQL
2. Import `sql/insert.sql` for sample data
3. Update `config/db_config.php` with your credentials
4. Place project in Apache/XAMPP htdocs folder
5. Visit: `http://localhost/online_clothing_brand/public/index.php?action=login`
