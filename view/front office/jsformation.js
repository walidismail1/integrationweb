let listProductHTML = document.querySelector('.listProduct');
let listCartHTML = document.querySelector('.listCart');
let iconCart = document.querySelector('.icon-cart');
let iconCartSpan = document.querySelector('.icon-cart span');
let body = document.querySelector('body');
let closeCart = document.querySelector('.close');
let products = [];
let cart = [];


iconCart.addEventListener('click', () => {
    body.classList.toggle('showCart');
});

closeCart.addEventListener('click', () => {
    body.classList.toggle('showCart');
});
let checkoutButton = document.querySelector('.checkOut');

checkoutButton.addEventListener('click', () => {
    const cartData = encodeURIComponent(JSON.stringify(cart));
    window.location.href = `checkoutformation.php?cart=${cartData}`;
});

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
                <button class="addCart">Add To Cart</button>
                <button class="moreButton" data-productid="${product.id}"><i class="fa fa-info" aria-hidden="true"></i> More</button>`;
            listProductHTML.appendChild(newProduct);
        });
    }
};

listProductHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('addCart')) {
        let id_product = positionClick.parentElement.dataset.id;
        addToCart(id_product);
    } else if (positionClick.classList.contains('addFavori')) {
        let id_product = positionClick.parentElement.dataset.id;
        addToFavori(id_product);
    } else if (positionClick.classList.contains('moreButton')) {
        let id_product = positionClick.dataset.productid;
        window.location.href = `Moreformation.php?product_id=${id_product}`;
    }
});

const addToFavori = (product_id) => {
    let positionThisProductInFavori = favori.findIndex((value) => value.product_id == product_id);
    if (favori.length <= 0) {
        favori = [{
            product_id: product_id
        }];
    } else if (positionThisProductInFavori < 0) {
        favori.push({
            product_id: product_id
        });
    } else {
        favori[positionThisProductInFavori].quantity = favori[positionThisProductInFavori].quantity + 1;
    }
    addFavoriToHTML();
    addFavoriToMemory();
};

const addToCart = (product_id) => {
    let positionThisProductInCart = cart.findIndex((value) => value.product_id == product_id);
    if (cart.length <= 0) {
        cart = [{
            product_id: product_id,
            quantity: 1
        }];
    } else if (positionThisProductInCart < 0) {
        cart.push({
            product_id: product_id,
            quantity: 1
        });
    } else {
        cart[positionThisProductInCart].quantity = cart[positionThisProductInCart].quantity;
    }
    addCartToHTML();
    addCartToMemory();
};

const addCartToMemory = () => {
    localStorage.setItem('cart', JSON.stringify(cart));
};

const addCartToHTML = () => {
    listCartHTML.innerHTML = '';
    let totalQuantity = 0;

    if (cart.length > 0) {
        cart.forEach(item => {
            let positionProduct = products.findIndex((value) => value.id == item.product_id);

            if (positionProduct !== -1) {
                let info = products[positionProduct];

                // Check if the product is still available in the database
                if (info) {
                    totalQuantity = totalQuantity + item.quantity;

                    let newItem = document.createElement('div');
                    newItem.classList.add('item');
                    newItem.dataset.id = item.product_id;

                    listCartHTML.appendChild(newItem);
                    newItem.innerHTML = `
                        <div class="image">
                            <img src="${info.image}">
                        </div>
                        <div class="name">
                            ${info.name}
                        </div>
                        <div class="totalPrice">$${info.price * item.quantity}</div>
                        <div class="quantity">
                            <span class="minus">X</span>
                        </div>`;
                }
            }
        });
    }

    iconCartSpan.innerText = totalQuantity;
};




listCartHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if (positionClick.classList.contains('minus')) {
        let product_id = positionClick.parentElement.parentElement.dataset.id;
        let type = 'minus';
        changeQuantityCart(product_id, type);
    }
});

const changeQuantityCart = (product_id, type) => {
    let positionItemInCart = cart.findIndex((value) => value.product_id == product_id);
    if (positionItemInCart >= 0) {
        let info = cart[positionItemInCart];
        switch (type) {

            default:
                let changeQuantity = cart[positionItemInCart].quantity - 1;
                if (changeQuantity > 0) {
                    cart[positionItemInCart].quantity = changeQuantity;
                } else {
                    cart.splice(positionItemInCart, 1);
                }
                break;
        }
    }
    addCartToHTML();
    addCartToMemory();
};

const initApp = () => {

    fetch('fetch_formationJS.php') 
        .then(response => response.json())
        .then(data => {
            products = data;
            addDataToHTML();

            if (localStorage.getItem('cart')) {
                cart = JSON.parse(localStorage.getItem('cart'));
                addCartToHTML();
            }
        });
};

initApp();
