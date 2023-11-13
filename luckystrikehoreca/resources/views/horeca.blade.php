@extends('layouts.header')
@section('content')
<div class="cateringContainter">
    <div id="catering-items">
        @foreach(array_chunk($cateringItems->all(), 3, true) as $chunk)
            <div class="row">
                @foreach($chunk as $category => $items)
                    <div class="category">
                        <h2>{{ $category }}</h2>
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
            </div>
        @endforeach
</div>
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
    console.log('Order Data:', orderData);
    alert('Order Submitted!');
}



</script>
    

@endsection
