<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Overview</title>
  @vite(['resources/css/order.css', 'resources/css/header.css'])
</head>
<body>
  <header class="sticky">
    <div class="headerLeft"><a href="/" id="backButton">Terug</a></div>
    <div class="headerCenter">{{ $user->name }} - Baan {{ $laneId }}</div>
    <div class="headerRight"><button type="submit" form="orderForm" id="orderButton">Verzend bestelling</button></div>
  </header>
  
  <main>
    <h1>Bestelling overzicht</h1>
    <br>
    <form method="POST" action="{{ route('store.order') }}" id="orderForm">
      @csrf
      <table>
        <thead>
          <tr>
            <th>Item</th>
            <th>Prijs (p/s)</th>
            <th>Aantal</th>
            <th class='price'>Totaal prijs</th>
          </tr>
        </thead>
        <tbody id="orderTable">
          @php
            $totalPrice = 0;
            if (session()->has('orderData')) {
              $orderData = session('orderData');
              $decodedOrderData = json_decode($orderData, true);
          @endphp
          @foreach ($decodedOrderData as $item)
            @php
              $totalItemPrice = $item['price'] * $item['quantity'];
              $totalPrice += $totalItemPrice;
              $formattedPrice = number_format($item['price'], 2);
            @endphp
          <tr>
            <td>{{ $item['item'] }}</td>
            <td>€{{ $formattedPrice }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td class="price">€{{ number_format($totalItemPrice, 2) }}</td>
          </tr>
          @endforeach
        @php
        }
        @endphp
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="noBottomLine">Totaal:</td>
            <td class="price noBottomLine" id="totalPrice">@php echo '€' . number_format($totalPrice, 2); @endphp</td>
          </tr>
        </tfoot>
      </table>
    </form>
  </main>
</body>
</html>