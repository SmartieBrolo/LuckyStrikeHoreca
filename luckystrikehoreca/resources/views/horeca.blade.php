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
    <div class="header-center">{{ $user->name }} - Baan {{ $laneId }}</div>
    <div class="header-right"><a onclick="submitOrder()">Naar bestelling(<span id="count">0</span>)</a></div>
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
                <div class="item" 
                    data-item-name="{{ $item->name }}" 
                    data-item-price="{{ number_format($item->price, 2, '.', '') }}"
                    data-item-id="{{ $item->id }}">
                    <div>
                        <span>{{ $item->name }} €{{ sprintf("%.2f", $item->price) }}</span>
                    </div>
                    <div class="quantity-controls">
                        <button onclick="decreaseQuantity('{{ $item->id }}')">-</button>
                        <input type="number" id="{{ $item->id }}" name="{{ $item->name }}" value="0" min="0">
                        <button onclick="increaseQuantity('{{ $item->id }}')">+</button>
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

// Plus button
function increaseQuantity(itemId) {
  const inputField = document.getElementById(itemId);
  inputField.value = parseInt(inputField.value, 10) + 1;
  const item = document.querySelector(`.item[data-item-id="${itemId}"]`);
  const itemName = item.dataset.itemName;
  const itemPrice = parseFloat(item.dataset.itemPrice);
  updateOrderData(itemId, itemName, itemPrice, inputField.value);
}

// Minus button
function decreaseQuantity(itemId) {
  const inputField = document.getElementById(itemId);
  const currentValue = parseInt(inputField.value, 10);
  if (currentValue > 0) {
    inputField.value = currentValue - 1;
    const item = document.getElementByClassName(`item`);
    const itemName = item.dataset.itemName;
    const itemPrice = parseFloat(item.dataset.itemPrice);
    updateOrderData(itemId, itemName, itemPrice, inputField.value);
  }
}

function updateOrderData(itemId, itemName, itemPrice, quantity) {
  // Use the item's ID as the key in orderData
  if (!orderData[itemId]) {
    orderData[itemId] = { id: itemId, item: itemName, price: parseFloat(itemPrice), quantity: 0 };
  }
  orderData[itemId].quantity = parseInt(quantity, 10);
}

// Sent orderJSON to next page
function submitOrder() {
  const orderJSON = JSON.stringify(orderData);
  localStorage.setItem('orderData', orderJSON);
  window.location.href = '/order';
  //   alert('Order Submitted!');
}


// Update count based on quantity
function updateTotalCount() {
  let total = 0;
  const inputs = document.querySelectorAll('.quantity-controls input');

  inputs.forEach(input => {
    total += parseInt(input.value);
  });

  document.getElementById('count').innerText = total;
}

// Wuantity changes and update total count for plus and minus button
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
