<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Overview</title>
  @vite(['resources/css/horeca.css', 'resources/css/header.css'])
</head>
<body>
  <header class="sticky">
    <div class="header-left"></div>
    <div class="header-center">Donny en Walter - Baan {{$laneId}}</div>
    <div class="header-right"><a href="/order">Naar bestelling(<span id="count">0</span>)</a></div>
  </header>
  
  <main>
<div class="cateringContainer">
    <div id="cateringItems">
        @foreach(array_chunk($cateringItems->all(), 3, true) as $chunk)
            @foreach($chunk as $category => $items)
                <div class="category">
                    @php
                        $categoryObject = json_decode($category);
                    @endphp
                    <h2>{{ $categoryObject->name }}</h2>
                    @foreach($items as $item)
                        <div class="item">
                            <div>
                                <span>{{ $item->name }} €{{ sprintf("%.2f", $item->price) }}</span>
                            </div>
                            <div class="quantity-controls">
                                <button onclick="decreaseQuantity('{{ $item->name }}')">-</button>
                                <input type="number" id="{{ $item->name }}" name="{{ $item->name }}" value="0" min="0">
                                <button onclick="increaseQuantity('{{ $item->name }}')">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endforeach
    </div>
</div>
</main>
<script>
    const orderData = {};


//Plus button
function increaseQuantity(inputId) {
    const inputField = document.getElementById(inputId);
    inputField.value = parseInt(inputField.value, 10) + 1;
    updateOrderData(inputId, inputField.value);
}

//Minus button
function decreaseQuantity(inputId) {
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
    // Do something with the order data, go to next page
    // console.log('Order Data:', orderData);
    alert('Order Submitted!');
}

// Function to update the total count based on item quantities
function updateTotalCount() {
    let total = 0;
    const inputs = document.querySelectorAll('.quantity-controls input');

    inputs.forEach(input => {
        total += parseInt(input.value);
    });

    document.getElementById('count').innerText = total;
}

// Function to handle quantity changes and update total count
function handleQuantityChange() {
    updateTotalCount();
}

// Event listeners to update count when input values change
const quantityInputs = document.querySelectorAll('.quantity-controls input');
quantityInputs.forEach(input => {
    input.addEventListener('input', handleQuantityChange);
});

// Event listeners to update count when plus/minus buttons are clicked
const quantityControls = document.querySelectorAll('.quantity-controls button');
quantityControls.forEach(button => {
    button.addEventListener('click', handleQuantityChange);
});




</script>
    
    

</body>
</html>
