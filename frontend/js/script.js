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
                                itemObject = {
                                    name: item.name,
                                    imageLink: item.image,
                                    price: item.price
                                };
                                
                                addButton.addEventListener("click", function () {
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
