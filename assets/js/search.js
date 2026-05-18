function searchProducts() {

    let q = document.getElementById("search").value;
    let category = document.getElementById("category").value;
    let gender = document.getElementById("gender").value;

    fetch(`api/products/search.php?q=${q}&category=${category}&gender=${gender}`)
    .then(response => response.json())
    .then(data => {

        let output = "";

        data.forEach(product => {

            output += `
            <div class="product-card">
                <img src="images/${product.image}" width="150">
                <h3>${product.name}</h3>
                <p>৳ ${product.price}</p>
                <a href="product.php?id=${product.id}">View Details</a>
            </div>
            `;
        });

        document.getElementById("productGrid").innerHTML = output;
    });
}