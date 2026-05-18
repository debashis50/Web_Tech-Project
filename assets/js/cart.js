function addToCart(productId, stock) {

    let quantity = document.getElementById("qty").value;

    quantity = parseInt(quantity);

    if (quantity <= 0) {

        alert("Quantity must be positive");
        return;
    }

    if (quantity > stock) {

        alert("Quantity exceeds stock");
        return;
    }

    fetch('api/cart/add.php', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })

    })

    .then(response => response.json())

    .then(data => {

        console.log(data);

        if (data.status === 'success') {

            alert("Product Added To Cart");

            window.location.href = "cart.php";

        } else {

            alert(data.message);
        }
    })

    .catch(error => {

        console.log(error);

        alert("Add To Cart Error");
    });
}



function increaseQty(cartId, currentQty, stock) {

    let newQty = parseInt(currentQty) + 1;

    if (newQty > stock) {

        alert("Stock limit reached");
        return;
    }

    updateQuantity(cartId, newQty);
}



function decreaseQty(cartId, currentQty) {

    let newQty = parseInt(currentQty) - 1;

    if (newQty < 1) {

        return;
    }

    updateQuantity(cartId, newQty);
}



function updateQuantity(cartId, quantity) {

    fetch('api/cart/update.php', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify({
            cart_id: cartId,
            quantity: quantity
        })

    })

    .then(response => response.json())

    .then(data => {

        console.log(data);

        if (data.status === 'success') {

            location.reload();

        } else {

            alert("Update failed");
        }
    })

    .catch(error => {

        console.log(error);

        alert("Update Error");
    });
}



function removeItem(cartId) {

    fetch('api/cart/delete.php?id=' + cartId, {

        method: 'DELETE'

    })

    .then(response => response.json())

    .then(data => {

        console.log(data);

        if (data.status === 'success') {

            location.reload();

        } else {

            alert("Delete failed");
        }
    })

    .catch(error => {

        console.log(error);

        alert("Delete Error");
    });
}