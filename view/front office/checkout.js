let listCart = [];
let products = []; 

function checkCart() {
    var cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('listCart='));
    if (cookieValue) {
        listCart = JSON.parse(cookieValue.split('=')[1]);
    }
}

function getCartFromURL() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const cartData = urlParams.get('cart');

    if (cartData) {
        listCart = JSON.parse(decodeURIComponent(cartData));
    }
}

checkCart();
getCartFromURL();
initApp(); 

function addCartToHTML() {
    console.log("List Cart:", listCart);
    let listCartHTML = document.querySelector('.returnCart .list');
    listCartHTML.innerHTML = '';

    let totalQuantityHTML = document.querySelector('.totalQuantity');
    let totalPriceHTML = document.querySelector('.totalPrice');
    let totalQuantity = 0;
    let totalPrice = 0;

    if (Array.isArray(listCart) && listCart.length > 0) {
        console.log("List Cart is a non-empty array");
        listCart.forEach(item => {
            if (item && item.product_id && item.quantity) {
                let positionProduct = products.findIndex((value) => value.id == item.product_id);

                if (positionProduct !== -1) {
                    let info = products[positionProduct];
                    let newCart = document.createElement('div');
                    newCart.classList.add('item');
                    newCart.innerHTML = `
                        <div class="image">
                            <img src="${info.image}">
                        </div>
                        <div class="name">
                            ${info.name}
                        </div>
                        <div class="totalPrice">$${info.price * item.quantity}</div>
                        <div class="quantity">
                            <span class="minus"><</span>
                            <span>${item.quantity}</span>
                            <span class="plus">></span>
                        </div>`;
                    listCartHTML.appendChild(newCart);
                    totalQuantity = totalQuantity + item.quantity;
                    totalPrice = totalPrice + (info.price * item.quantity);
                } else {
                    console.error("Product not found for item:", item);
                }
            } else {
                console.error("Invalid item format:", item);
            }
        });
    } else {
        console.log("List Cart is an empty array or has invalid format");
    }
    totalQuantityHTML.innerText = totalQuantity;
    totalPriceHTML.innerText = '$' + totalPrice;
}

function initApp() {
    fetch('fetch_booksJS.php') 
        .then(response => response.json())
        .then(data => {
            products = data;
            addCartToHTML();
        });
}
