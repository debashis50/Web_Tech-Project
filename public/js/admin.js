// Task 2 - Admin JS
// Student ID: 23-50856-1
// Features: AJAX order status update + JS form validation for product forms

document.addEventListener('DOMContentLoaded', function () {

    // ─── AJAX: Order Confirm / Reject ────────────────────────────────────────
    // Handles confirm/reject buttons on order list page without page reload

    var orderForms = document.querySelectorAll('.order-status-form');

    orderForms.forEach(function (form) {
        var buttons = form.querySelectorAll('button[name="status"]');
        buttons.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                var order_id = form.querySelector('input[name="order_id"]').value;
                var status   = btn.value;
                var label    = status === 'confirmed' ? 'Confirm' : 'Reject';

                if (!confirm(label + ' order #' + order_id + '?')) return;

                btn.disabled = true;
                btn.textContent = '...';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../public/index.php?action=update_order_status', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var response = xhr.responseText.trim();
                        if (response === 'success') {
                            // Update the status cell in the same row
                            var row = form.closest('tr');
                            var statusCell = row.querySelector('.order-status-cell');
                            if (statusCell) {
                                statusCell.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                            }
                            // Remove action buttons — order is finalized
                            var actionCell = row.querySelector('.order-action-cell');
                            if (actionCell) {
                                actionCell.innerHTML = '-';
                            }
                        } else {
                            alert('Failed to update order status. Please try again.');
                            btn.disabled = false;
                            btn.textContent = label;
                        }
                    } else {
                        alert('Server error. Please try again.');
                        btn.disabled = false;
                        btn.textContent = label;
                    }
                };

                xhr.onerror = function () {
                    alert('Network error. Please try again.');
                    btn.disabled = false;
                    btn.textContent = label;
                };

                xhr.send('order_id=' + encodeURIComponent(order_id) + '&status=' + encodeURIComponent(status));
            });
        });
    });


    // ─── JS Validation: Add Product Form ─────────────────────────────────────

    var addProductForm = document.getElementById('add-product-form');
    if (addProductForm) {
        addProductForm.addEventListener('submit', function (e) {
            var valid = true;

            // Clear old errors
            addProductForm.querySelectorAll('.js-error').forEach(function (el) { el.textContent = ''; });

            // Name
            var name = document.getElementById('prod-name');
            if (name && name.value.trim().length < 2) {
                showError('err-name', 'Product name must be at least 2 characters.');
                valid = false;
            }

            // Price
            var price = document.getElementById('prod-price');
            if (price && (isNaN(parseFloat(price.value)) || parseFloat(price.value) <= 0)) {
                showError('err-price', 'Price must be a positive number.');
                valid = false;
            }

            // Stock
            var stock = document.getElementById('prod-stock');
            if (stock && (stock.value === '' || parseInt(stock.value) < 0 || !Number.isInteger(Number(stock.value)))) {
                showError('err-stock', 'Stock must be a non-negative integer.');
                valid = false;
            }

            // Category
            var cat = document.getElementById('prod-category');
            if (cat && !cat.value) {
                showError('err-category', 'Please enter a category ID.');
                valid = false;
            }

            // Gender
            var gender = document.getElementById('prod-gender');
            if (gender && !gender.value) {
                showError('err-gender', 'Please select a gender.');
                valid = false;
            }

            // Image (required for new product)
            var img = document.getElementById('prod-image');
            if (img && img.files.length === 0) {
                showError('err-image', 'Please upload a product image.');
                valid = false;
            } else if (img && img.files.length > 0) {
                var file = img.files[0];
                var allowed = ['image/jpeg', 'image/png'];
                if (allowed.indexOf(file.type) === -1) {
                    showError('err-image', 'Only JPEG or PNG images are allowed.');
                    valid = false;
                } else if (file.size > 2 * 1024 * 1024) {
                    showError('err-image', 'Image must be under 2MB.');
                    valid = false;
                }
            }

            if (!valid) e.preventDefault();
        });
    }


    // ─── JS Validation: Edit Product Form ────────────────────────────────────

    var editProductForm = document.getElementById('edit-product-form');
    if (editProductForm) {
        editProductForm.addEventListener('submit', function (e) {
            var valid = true;

            editProductForm.querySelectorAll('.js-error').forEach(function (el) { el.textContent = ''; });

            var name = document.getElementById('prod-name');
            if (name && name.value.trim().length < 2) {
                showError('err-name', 'Product name must be at least 2 characters.');
                valid = false;
            }

            var price = document.getElementById('prod-price');
            if (price && (isNaN(parseFloat(price.value)) || parseFloat(price.value) <= 0)) {
                showError('err-price', 'Price must be a positive number.');
                valid = false;
            }

            var stock = document.getElementById('prod-stock');
            if (stock && (stock.value === '' || parseInt(stock.value) < 0)) {
                showError('err-stock', 'Stock must be a non-negative integer.');
                valid = false;
            }

            // Image optional on edit — only validate if a new file is chosen
            var img = document.getElementById('prod-image');
            if (img && img.files.length > 0) {
                var file = img.files[0];
                var allowed = ['image/jpeg', 'image/png'];
                if (allowed.indexOf(file.type) === -1) {
                    showError('err-image', 'Only JPEG or PNG images are allowed.');
                    valid = false;
                } else if (file.size > 2 * 1024 * 1024) {
                    showError('err-image', 'Image must be under 2MB.');
                    valid = false;
                }
            }

            if (!valid) e.preventDefault();
        });
    }


    // ─── Helper ──────────────────────────────────────────────────────────────
    function showError(id, msg) {
        var el = document.getElementById(id);
        if (el) el.textContent = msg;
    }

});
