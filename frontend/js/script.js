function loadTemplate(page) {
    fetch(`backend/fetch_template.php?template=${page}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById("content").innerHTML = html;
        })
        .catch(error => console.error("Error loading template:", error));
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
                                //addButton.dataset.itemName = item.name; // Store item name in button
                                
                                // Click event for "Add to Basket"
                                addButton.addEventListener("click", function () {
                                    //addToBasket(this.dataset.itemName);
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

});
