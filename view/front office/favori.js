let listProductHTML = document.querySelector('.listProduct');
let products = [];
let cart = [];

const addDataToHTML = () => {
    if (products.length > 0) {
        products.forEach(product => {
            let newProduct = document.createElement('div');
            newProduct.dataset.id = product.id;
            newProduct.classList.add('item');
            newProduct.innerHTML =
                `<img src="${product.image}" alt="">
                <h2>${product.name}</h2>
                <div class="price">$${product.price}</div>
                <button class="moreButton" data-productid="${product.id}"><i class="fa fa-info" aria-hidden="true"></i> More</button>`;
            listProductHTML.appendChild(newProduct);
        });
    }
};

listProductHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('moreButton')) {
        let id_product = positionClick.dataset.productid;
        window.location.href = `Moreformation.php?product_id=${id_product}`;
    }
});
const initApp = () => {

    fetch('fetch_favoriJS.php') 
        .then(response => response.json())
        .then(data => {
            products = data;
            addDataToHTML();
        });
};

initApp();
