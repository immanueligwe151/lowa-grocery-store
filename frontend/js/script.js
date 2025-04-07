function loadTemplate(page) {
    fetch(`backend/fetch_template.php?template=${page}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById("content").innerHTML = html;
        })
        .catch(error => console.error("Error loading template:", error));
}

function loadCaptcha() {
    fetch('../backend/generate_captcha.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('captcha-image').src = `../images/captcha-images/${data.image}?v=${Date.now()}`;
        });
}

document.addEventListener("DOMContentLoaded", function () {
    if (document.body.classList.contains("home")) {
        const categoryDropdown = document.getElementById("dropdown-menu");
        const itemDiv = document.getElementById("item-div");

        categoryDropdown.addEventListener("change", function () {
            const selectedCategory = this.value;

            fetch(`./backend/fetch_items.php?category=${encodeURIComponent(selectedCategory)}`)
                .then(response => response.json())
                .then(items => {
                    itemDiv.innerHTML = "";

                    if (items.error) {
                        itemDiv.innerHTML = `<p>Error: ${items.error}</p>`;
                    } else if (items.length === 0) {
                        itemDiv.innerHTML = `<p>No items found.</p>`;
                    } else {
                        const itemGrid = document.createElement("div");
                        itemGrid.classList.add("item-grid");

                        items.forEach(item => {
                            const itemCard = document.createElement("div");
                            itemCard.classList.add("item-card");

                            itemCard.innerHTML = `
                            <img src="${item.image}" alt="${item.name}" class="item-image">
                            <p class="item-name">${item.name}</p>
                            <p class="item-price">£${item.price}</p>`;

                            itemGrid.appendChild(itemCard);

                            if (userLoggedIn) {
                                const addButton = document.createElement("button");
                                addButton.textContent = "Add to Basket";
                                addButton.classList.add("add-to-basket");
                                
                                addButton.addEventListener("click", function () {
                                    itemObject = {
                                        name: item.name,
                                        imageLink: item.image,
                                        price: item.price
                                    };
                                    addToBasket(JSON.stringify(itemObject));
                                });
    
                                itemCard.appendChild(addButton);
                            }    
                        });

                        itemDiv.appendChild(itemGrid);
                    }
                })
                .catch(error => {
                    itemDiv.innerHTML = `<p>Error fetching items.</p>`;
                    console.error("Fetch error:", error);
                });
        });
    }

    if (document.body.classList.contains('login')) {
        fetch('../backend/generate_captcha.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('captcha-image').src = `../images/captcha-images/${data.image}?v=${Date.now()}`;
        });
    }

    if (document.body.classList.contains('my-basket')) {
        loadBasket();
    }

    if (userLoggedIn) {
        updateBasketCount(basketQuantity);
    }

});

function updateBasketCount(count) {
    let basketLinks = document.getElementsByClassName('my-basket-a');
    Array.from(basketLinks).forEach(link => {
        link.textContent = `My Basket(${count})`;
    });
}

function addToBasket(itemObject) {
    console.log(itemObject);
    fetch('./backend/add_to_basket.php', {
        method: 'POST',
        body: itemObject,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        credentials: 'include'
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            updateBasketCount(result.itemCount);  // Update the basket count in the navbar
        } else {
            alert("Failed to add item to basket");
        }
    })
    .catch(error => {
        console.error("Error adding item to basket:"/*, error*/);
    });
}

function loadBasket(){
    const basketDiv = document.getElementById('basket-div');
    const totalDiv = document.getElementById('total-div');
    let totalPrice = 0;
    basketDiv.innerHTML = '';
    totalDiv.innerHTML = '';
    
    if (basket.length > 0) {
        let count = 0;
        basket.forEach(item => {
            const itemDiv = document.createElement('div');
            const productDiv = document.createElement('div');
            const subtotalDiv = document.createElement('div');

            itemDiv.classList.add('item-div');
            productDiv.classList.add('product-div');
            subtotalDiv.classList.add('subtotal-div');

            productDiv.innerHTML = `
                <div> <img class="basket-img" src="${item.imageLink}" alt="${item.name}"> </div>

                <div class="product-details-div">
                    <h4>${item.name}</h4>
                    <h5>${item.price}</h5>
                    <h5>Quantity: ${item.quantity}</h5>
                </div>

                <div>
                    <button class="add-remove-button" onclick="updateItemQuantity(${count}, ${-1});">-</button>
                    <button class="add-remove-button" onclick="updateItemQuantity(${count}, ${1});">+</button>
                </div>
            `;

            let subtotal = item.price * item.quantity;
            totalPrice += subtotal;

            subtotalDiv.innerHTML = `
                <h5>Subtotal = £${subtotal.toFixed(2)}</h5>
            `;

            itemDiv.appendChild(productDiv);
            itemDiv.appendChild(subtotalDiv);
            basketDiv.appendChild(itemDiv);

            count++;
        });

        totalDiv.innerHTML = `
            <h4>Total: £${totalPrice.toFixed(2)}</h4>
            <button class="place-order-btn" onclick="placeOrder();">Place Order</button>
        `;

    } else {
        const noItems = document.createElement('h4');
        noItems.classList.add('no-items');
        noItems.innerText = "No items have been added to the basket";
        basketDiv.appendChild(noItems);

    }
}

function updateItemQuantity(itemIndex, updateQuantity) {
    basket[itemIndex].quantity += updateQuantity;
    if (basket[itemIndex].quantity === 0) {
        basket.splice(itemIndex, 1);
    }

    fetch('../backend/update_basket.php', {
        method: 'POST',
        body: JSON.stringify(basket),
        headers: {
            'Content-Type': 'application/json',
        },
        credentials: 'include'
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            loadBasket();
            updateBasketCount(result.newQuantity)
        } else {
            alert("Failed to update basket.");
        }
    })
    .catch(error => console.error("Error updating basket:", error));
}

function placeOrder(){
    console.log('reaching here');
    const dialog = document.getElementById('dialog');
    dialog.style.display = 'flex';
}

function closeDialog(dialogId, boxId) {
    document.getElementById(dialogId).style.display = 'none';
    let dialogBox = document.getElementById(boxId);
    dialogBox.classList.remove('addon-dialog-content');
    dialogBox.classList.add('sub-menu-dialog-content');
    resetValues();

    if (boxId === 'payment-block') {
        document.getElementById('payment-block').innerHTML = `<span class="close-btn" id="close-dialog-btn" onclick="closeDialog('payment-dialog', 'payment-block');">&times;</span>`;
    }
};
