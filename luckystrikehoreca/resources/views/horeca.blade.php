@extends('layouts.header')
@section('content')
<div class="cateringContainter">
<div id="catering-items"></div>

<script>
    const orderData = {};

fetch('/catering-items')
    .then(response => response.json())
    .then(data => {
        const cateringItemsDiv = document.getElementById('catering-items');

        let rowDiv;

        for (const category in data) {
            if (data.hasOwnProperty(category)) {
                // Create a new row div for every three categories
                if (!rowDiv) {
                    rowDiv = document.createElement('div');
                    rowDiv.classList.add('row');
                    cateringItemsDiv.appendChild(rowDiv);
                }

                const items = data[category];

                // Create a category div with a class based on the category name
                const categorySection = document.createElement('div');
                categorySection.classList.add('category');
                categorySection.innerHTML = `<h2>${category}</h2>`;

                items.forEach(item => {
                    const itemDiv = document.createElement('div');
                    itemDiv.classList.add('item');
                    itemDiv.innerHTML = `
                                <div>
                                    <span>${item.name} €${item.price.toFixed(2)}</span>
                                    </div>
                                <div class="quantity-controls">
                                    <button class='minus' onclick="decrementQuantity('${item.name}')">-</button>
                                    <input type="number" id="${item.name}" name="${item.name}" value="0" min="0">
                                    <button onclick="incrementQuantity('${item.name}')">+</button>
                                </div>`;
                    categorySection.appendChild(itemDiv);
                });

                rowDiv.appendChild(categorySection);

                // Check if three categories have been added, then reset rowDiv
                if (rowDiv.children.length === 3) {
                    rowDiv = null;
                }
            }
        }
    })
    .catch(error => console.error('Error fetching catering items:', error));

function incrementQuantity(inputId) {
    const inputField = document.getElementById(inputId);
    inputField.value = parseInt(inputField.value, 10) + 1;
    updateOrderData(inputId, inputField.value);
}

function decrementQuantity(inputId) {
    const inputField = document.getElementById(inputId);
    const currentValue = parseInt(inputField.value, 10);
    if (currentValue > 0) {
        inputField.value = currentValue - 1;
        updateOrderData(inputId, inputField.value);
    }
}

function updateOrderData(itemId, quantity) {
    orderData[itemId] = quantity;
}

function submitOrder() {
    // Do something with the order data, e.g., send it to the server
    console.log('Order Data:', orderData);
    alert('Order Submitted!');
}

</script>
    

@endsection
