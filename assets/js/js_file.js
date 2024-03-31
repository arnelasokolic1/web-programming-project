// Function to fetch product data
function fetchProductData(url) {
    return new Promise((resolve, reject) => {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const productData = JSON.parse(xhr.responseText);
                    resolve(productData);
                } else {
                    reject(xhr.statusText);
                }
            }
        };
        xhr.send();
    });
}

// Function to render products
function renderProducts(products, containerId) {
    const productsContainer = document.getElementById(containerId);
    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('product', 'text-center', 'col-lg-3', 'col-md-4', 'col-sm-12');
        productDiv.innerHTML = `
            <img class="img-fluid mb-3" src="../assets/imgs/${product.image}" alt="Product Image">
            <h2>${product.name}</h2>
            <h4 class="p-type">${product.type}</h4>
            <h2 class="p-price">${product.price}</h2>
            <button class="buy-btn">Buy now</button>
        `;
        productDiv.querySelector('.buy-btn').addEventListener('click', function() {
            // Redirect to cart page
            window.location.href = 'tpl/cart.html';
        });
        productsContainer.appendChild(productDiv);
    });
}

// Fetch and render products for PRADA
fetchProductData('../database/prada_products.json')
    .then(pradaProducts => {
        renderProducts(pradaProducts, 'prada-product-container');
    })
    .catch(error => {
        console.error('Error fetching PRADA product data:', error);
    });

// Fetch and render products for BURBERRY
fetchProductData('../database/burberry_products.json')
    .then(burberryProducts => {
        renderProducts(burberryProducts, 'burberry-product-container');
    })
    .catch(error => {
        console.error('Error fetching BURBERRY product data:', error);
    });

// Fetch and render products for CALVIN KLEIN
fetchProductData('../database/calvin_klein_products.json')
    .then(calvinKleinProducts => {
        renderProducts(calvinKleinProducts, 'calvin-klein-product-container');
    })
    .catch(error => {
        console.error('Error fetching CALVIN KLEIN product data:', error);
    });

// Fetch and render products for GIORGIO ARMANI
fetchProductData('../database/armani_products.json')
    .then(armaniProducts => {
        renderProducts(armaniProducts, 'armani-product-container');
    })
    .catch(error => {
        console.error('Error fetching GIORGIO ARMANI product data:', error);
    });
